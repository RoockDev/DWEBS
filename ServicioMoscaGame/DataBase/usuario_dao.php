<?php

include_once ('./database.php');
include_once('../Models/usuario.php');

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


    public static function getById($id){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ? ");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuario = null;
        if ($fila = $resultado->fetch_assoc() ) {
            $usuario = new Usuario($fila['dni'],$fila['nombre'],'',$fila['tfno'],$fila['es_admin']);

            $usuario->setId($fila['id']);
            $usuario->setPartidasJugadas($fila['partidas_jugadas']);
            $usuario->setPartidasGanadas($fila['partidas_ganadas']);
        }

        $stmt->close();
        $conexion->close();

        return $usuario;

    }

    public static function insert($usuario){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("INSERT INTO usuarios (dni,nombre,clave,tfno,es_admin) VALUES ( ?,?,?,?,?)");
        $dni = $usuario->getBydni();
        $nombre = $usuario->getNombre();
        $clave = $usuario->getClave();
        $tfno = $usuario->getTfno();
        $es_admin = $usuario->getEsAdmin();
        
        $stmt->bind_param('ssssi', $dni,$nombre,$clave,$tfno,$es_admin);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $ok;
    }

    public static function update($usuario){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("UPDATE usuario SET nombre = ?, clave = ?, tfno = ? WHERE dni = ? ");
        $dni = $usuario->getDni();
        $nombre = $usuario->getNombre();
        $clave = $usuario->getClave();
        $tfno = $usuario->getTfno();

        $stmt->bind_param('ssss', $nombre,$clave,$tfno,$dni);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $ok;
    }

    public static function delete($id){
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ? ");
        $stmt->bind_param('i',$id);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $ok;
    }

    //verificamos clave aqui? para el login? o esto iria en el controlador

    public static function verificarUsuarioLogin($id,$clave){ //esto esta bien asi?
        try {
            $usuario = self::getById($id);
            if ($usuario && $usuario->verificarClave($clave)) {
                return $usuario;
            }
        } catch (Exception $e) {
            throw new Exception("Error Processing Request".$e );
            
        }
    }
}