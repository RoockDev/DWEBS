<?php

require_once('./database.php');
require_once('../Models/partida.php');

class PartidaDAO{
    public static function getAll(){
        
        try {
          $conexion = Database::connect();
          $partidas = [];
          $query = "SELECT * FROM partidas";
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
            $query = "INSERT INTO partida (id,idUsuario,tablero,estado) VALUES(?,?,?,?)";
            $stmt = mysqli_prepare($conexion,$query);
            $val1 =$partida->getId();
            $val2 = $partida->getIdUsuario();
            $val3 = $partida->getTablero();
            $val4 = $partida->getEstado();
             mysqli_stmt_bind_param($stmt, 'iiss', $val1, $val2, $val3, $val4);
            mysqli_stmt_execute($stmt);

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
                $partida = new Partida(
                    $fila['id'],
                    $fila['idUsuario'],
                    $fila['tablero'],
                    $fila['estado']
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