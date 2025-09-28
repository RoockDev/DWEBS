<?php
require_once('./config/mail.php');
require_once('./DataBase/partidas_dao.php');
require_once('./Models/partida.php');
require_once('./Models/usuario.php');

class controllerPartidas{

    private $usuarioAutenticado;

    public function __construct($usuario)
    {
       $this->usuarioAutenticado = $usuario; 
    }

    //GET /player -> historial de partidas del jugador
    public function getHistory(){
        try {
            //obtenemos todas las partidas de la base de datos
            $partidas = PartidaDAO::getAll();

            //ahora filtramos solo las partidas del usuario autenticado
            $misPartidas = [];
            foreach($partidas as $partida){
                if ($partida->getIdUsuario() == $this->usuarioAutenticado->getId()) {
                    $misPartidas[] = [
                        'id' => $partida->getId(),
                        'estado' => $partida->getEstado(),
                        'intentosTotales' => $partida->getIntentosTotales(),
                        'tablero' => $partida->getTablero()

                    ];
                }
            }

            header('HTTP/1.1 200');
            echo json_encode(['partidas' => $misPartidas]);
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'error al obtener el historial'.$e->getMessage()]);
        }
    }

    //GET /player/if -> ver los datos de una partida esepecifica
    public function getGame($id){
        try {
            $partida = PartidaDAO::getPartidaById($id);

            if(!$partida){
                header('HTTP/1.1 404');
                echo json_encode(['error' => 'partida no encontrada']);
            }else{
                //verificamos que la partida pertenece al usuario autenticado
                if ($partida->getIdUsuario() != $this->usuarioAutenticado->getId()) {
                    header('HTTP/1.1 403');
                    echo json_encode(['error' => 'Acceso Denegado, esta partida no te pertenece']);
                }else{
                    header('HTTP/1.1 200');
                    echo json_encode([
                        'id' => $partida->getId(),
                        'estado' => $partida ->getEstado(),
                        'intentosTotales' => $partida ->getIntentosTotales(),
                        'tablero' => $partida->getTablero()
                    ]);
                }
            }
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'error al obtener la partida']);
        }
    }

    //GET /player/accion/id -> hacer la accion de la partida, en nuestro caso el manotozao a la mosca
    public function doAction($id){
        try {
            $partida = PartidaDAO::getPartidaById($id);

            if (!$partida) {
                header('HTTP/1.1 404');
                echo json_encode(['error' => 'partida no encontrada']);
            }else{
                if ($partida->getIdUsuario() != $this->usuarioAutenticado->getId()) {
                    header('HTTP/1.1 403');
                    echo json_encode(['error' => 'Acceso Denegado, esta partida no te pertenece']);
                }else{
                    //leemos la posicion del manotazo
                    $datos = json_decode(file_get_contents('php://input'),true);

                    if (!isset($datos['posicion'])) {
                        header('HTTP/1.1 400');
                        echo json_encode(['error' => 'Falta la posicion de la mosca']);
                    }else{
                        $posicion = $datos['posicion'];

                        //hacemos el manotazo
                        $resultado = $partida->darManotazo($posicion);

                        //actualizamos con la partida con update para asi guardarla
                        PartidaDAO::updatePartida($partida);

                        header('HTTP/1.1 200');
                        echo json_encode([
                            'resultado' => $resultado,
                            'partida actualizada' => [
                                'id' => $partida->getId(),
                                'estado' => $partida->getEstado(),
                                'intentosTotales' => $partida->getIntentosTotales(),
                                'tablero' => $partida->getIntentosTotales(),
                            ]
                        ]);
                    }
                }
            }
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'Error al hacer la accion'.$e->getMessage()]);
        }
    }

    //POST /player -> crear nueva partida
    public function newGame(){
        try {
            //creamos una nueva partida para el usuario autenticado
            $nuevaPartida = new Partida($this->usuarioAutenticado->getId());
            $nuevaPartida->inicializarTablero();
            $nuevaPartida->colocarMosca();

            //gaurdamos en la base de datos
            PartidaDAO::insertPartida($nuevaPartida);
            header('HTTP/1.1 200');
            echo json_encode([
                'mensaje' => 'nueva partida creada',
                'id' => $nuevaPartida->getId(),
                'tablero' => $nuevaPartida->getTablero(),
                'estado' => $nuevaPartida->getEstado()
            ]);
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'error al crear la partida']);
        }
    }

    // POST /player/recoverPass
    public function recoverPass(){
        try {
            //verificamos que el usuario tenga un email
            $email = $this->usuarioAutenticado->getEmail();
            if (!$email) {
                header('HTTP/1.1 400');
                echo json_encode(['error' => 'el usuario no tiene un correo electronico asociado']);
            }else{
                //generamos una nueva contraseña md%
                $nuevaClave = substr(md5(rand()),0,8); //esto crea una contraseña aleatoria en md5 y la corta en8 caracteres only

                //actualizamos la contraseña del usuario
                $this->usuarioAutenticado->setClave($nuevaClave);

                //actualizamos el usuario en la base de datos para que asi se le guarde la contraseña nueva
                $exito = UsuarioDAO::update($this->usuarioAutenticado);

                if (!$exito) {
                    header('HTTP/1,1 500');
                    echo json_encode(['error' => 'no se pudo actualizar la contraseña']);

                }else{
                    //enviamos el correo
                    $asunto = 'Recuperacion de contraseña';
                    $mensaje = "Hola tu contraseña nueva es $nuevaClave";

                    if (enviarCorreo($email,$asunto,$mensaje)) {
                        header('HTTP/1.1 200');
                        echo json_encode(['mensaje' => 'se ha enviado un correo electronico con la nueva contraseña']);
                    }else{
                        header('HTTP/1.1 500');
                        echo json_encode(['error' => 'no se pudo enviar el correo con la nueva contraseña']);
                    }
                }
            }
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'hubo problemas al recuperar la contraseña']);
        }
    }




}