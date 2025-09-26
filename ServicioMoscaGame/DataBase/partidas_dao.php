<?php

require_once('./database.php');
require_once('../Models/partida.php');

class PartidaDAO{
    public static function getAll(){
        
        try {
          $conexion = Database::connect();
          $partidas = [];
          $query = "SELECT * FROM partida";
          $stmt = mysqli_prepare($conexion,$query);
          mysqli_stmt_execute($stmt);
          $resultado = mysqli_stmt_get_result($stmt);


           while ($fila = mysqli_fetch_assoc($resultado)) {
                $partida = new Partida(
                    $fila['id'],
                    $fila['idUsuario'],
                    $fila['tablero'],
                    $fila['estado'],
                    $fila['intentosTotales']
                );

                $partidas[] = $partida;
            }
        } catch (Exception $e ) {
            throw new Exception("Error al obtener todas las partidas", 1);
            
        }finally{
            $conexion->close();
        }

        return $partidas;
    }

    public static function insertPartida($partida){
        try {
            $conexion = Database::connect();
            $query = "INSERT INTO partida (idUsuario,tablero,estado,intentosTotales) VALUES(?,?,?,?)";
            $stmt = mysqli_prepare($conexion,$query);
            $val1 =$partida->getIdUsuario();
            $val2 = $partida->getTableroAsString(); //aqui lo convertimos a string
            $val3 = $partida->getestado();
            $val4 = $partida->intentosTotales();
             mysqli_stmt_bind_param($stmt, 'isii', $val1, $val2, $val3, $val4);
            mysqli_stmt_execute($stmt);

            /**
             * como el id es incremental en la base de datos
             * aqui lo obtenemos y lo asignamos a la partida
             */

            $partida ->setId(mysqli_insert_id($conexion));

        } catch (Exception $e) {
            throw new Exception("Error al insertar una partida".$e->getMessage());
            
        }finally {
            $conexion->close();
        }
    }

    public function getPartidaById($id)
    {
        try {
            $conexion = Database::connect();
            $query = "SELECT * FROM partida WHERE id = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if ($fila = mysqli_fetch_assoc($resultado)) {
                //pasamos el string del tablero al constructor
                $partida = new Partida(
                    $fila['id'],
                    $fila['idUsuario'],
                    $fila['tablero'], //esto es un string el constructor lo convierte a array
                    $fila['estado'],
                    $fila['intentosTotales']
                );

                
            }

            return $partida;
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        } finally {
            $conexion->close();
        }
    }


    public function deletePartida($partida){ 
        try {
            $conexion = Database::connect();
            $query = "DELETE FROM partida WHERE id = ?";
            $stmt = mysqli_prepare($conexion,$query);
            $id = $partida->getId();
            mysqli_stmt_bind_param($stmt,"i",$id);
            mysqli_stmt_execute($stmt);
        } catch (Exception $e) {
            throw new Exception("Error al eliminar partida".$e->getMessage());
            
        }finally{
            $conexion->close();
        }

    }




    




}