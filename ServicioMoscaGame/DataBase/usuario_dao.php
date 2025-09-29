<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../Models/usuario.php';

class UsuarioDAO {

    public static function getAll(){
        $conexion = Database::connect();
        $usuarios = [];
        $query = "SELECT * FROM usuarios";
        $resultado = $conexion->query($query);

        while($fila = $resultado->fetch_assoc()){
            $usuario = new Usuario($fila['dni'],$fila['nombre'],'',$fila['tfno'],$fila['es_admin']);
            $usuario->setId($fila['id']);
            $usuario->setPartidasJugadas($fila['partidas_jugadas']);
            $usuario->setPartidasGanadas($fila['partidas_ganadas']);
            $usuarios[] = $usuario;
        }

        $conexion->close();
        return $usuarios;
    }


    public static function getById($dni){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE dni = ? ");
        $stmt->bind_param('s',$dni);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuario = null;
        if ($fila = $resultado->fetch_assoc() ) {
            $usuario = new Usuario($fila['dni'],$fila['nombre'],'',$fila['email'],$fila['tfno'],$fila['es_admin']);

            $usuario->setDni($fila['dni']);
            $usuario->setPartidasJugadas($fila['partidas_jugadas']);
            $usuario->setPartidasGanadas($fila['partidas_ganadas']);
        }

        $stmt->close();
        $conexion->close();

        return $usuario;

    }

    public static function insert($usuario){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("INSERT INTO usuarios (dni,nombre,email,clave,tfno,es_admin) VALUES ( ?,?,?,?,?,?)");
        $dni = $usuario->getDni();
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $clave = $usuario->getClave();
        $tfno = $usuario->getTfno();
        $es_admin = $usuario->getEsAdmin();
        
        $stmt->bind_param('ssssii', $dni, $nombre, $email, $clave, $tfno, $es_admin);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $ok;
    }

    public static function update($usuario){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, clave = ?, tfno = ? WHERE id = ?");
        $id = $usuario->getDni();
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $clave = $usuario->getClave();
        $tfno = $usuario->getTfno();

        $stmt->bind_param('sssss', $nombre, $email, $clave, $tfno, $dni);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $ok;
    }

    public static function delete($dni){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE dni = ? ");
        $stmt->bind_param('s',$dni);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $ok;
    }

    

    
       public static function verificarUsuarioLogin($dni,$clave){ //esto esta bien asi?
        try {
            $usuario = self::getById($dni);
            if ($usuario && $usuario->verificarClave($clave)) {
                return $usuario;
            }
        } catch (Exception $e) {
            throw new Exception("Error Processing Request".$e );
            
        }
    }
      
      
    

   
}