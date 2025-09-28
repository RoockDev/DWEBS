<?php

require_once './Helper/parametros.php';
require_once './DataBase/database.php';
require_once './Models/usuario.php';
require_once './Models/partida.php';
require_once './DataBase/usuario_dao.php';
require_once 'Controller/controller_usuarios.php';
require_once 'Controller/controller_partidas.php';

$metodo = $_SERVER['REQUEST_METTHOD'];
$ruta = $_SERVER['REQUEST_URI'];

$parametros = explode('/', $ruta);
unset($parametros[0]);

if (!$empty($parametros[0])) {
    $datos = json_decode(file_get_contents('php://input'), true);

    if (isset($datos['username']) && isset($datos['clave'])) {
        $username = $datos['username'];
        $clave = $datos['clave'];

        $usuario = UsuarioDAO::verificarUsuarioLogin($username, $clave);

        if ($usuario) {

            //ahora segun la ruta llamamos al controlador correcto
            $recurso = $parametros[0];
            if ($recurso === 'admin') {
                //verificamos que sea admin
                if ($usuario->getEsAdmin()) {
                    $controlador = new ControllerUsuarios($usuario);
                    if ($metodo === 'GET' && count($parametros) === 1) {  // GET /admin -> listar todos los usuarios
                        $controlador->getUsers();
                    } elseif ($metodo === 'GET' && count($parametros) === 2 && is_numeric($parametros[1])) { //GET /admin/id -> obtener un usuario por su id
                        $controlador->getUser($parametros[1]);
                    } elseif ($metodo === 'POST' && count($parametros) === 1) {  // POST /admin -> crear nuevo usuario
                        $controlador->createUser();
                    } elseif ($metodo === 'PUT' && count($parametros) === 2 && is_numeric($parametros)) { //PUT /admin/id -> actualizar usuario
                        $controlador->updateUser($parametros);
                    } elseif ($metodo === 'DELETE' && count($parametros) === 2 && is_numeric($parametros[1])) { //DELETE /admin/id -> eliminar Usuario
                        $controlador->deleteUser($parametros[1]);
                    } else {
                        header('HTTP/1.1 404');
                        echo json_encode(['error' => 'Endpoint no soportado']);
                    }
                } else {
                    header('HTTP/1.1 403');
                    echo json_encode(['error' => 'Acceso denegado solo los administradores pueden utilizar este recurso']);
                }
            } elseif ($recurso === 'player') {
                $controlador = new controllerPartidas($usuario);

                if ($metodo === 'GET' && count($parametros) === 1) {  //GET /player -> historial de partidas del jugador
                    $controlador->getHistory();
                } elseif ($metodo === 'GET' && count($parametros) === 2 && is_numeric($parametros[1])) {  //GET /player/if -> ver los datos de una partida esepecifica
                    $controlador->getGame($parametros[1]);
                } else if ($metodo === 'GET' && count($parametros) === 3 && $Parametros[1] === 'accion' && is_numeric($parametros[2])) { //GET /player/accion/id -> hacer la accion de la partida, en nuestro caso el manotozao a la mosca
                    $controlador->doAction($parametros[2]);
                } elseif ($metodo === 'POST' && count($parametros) === 1) { //POST /player -> crear nueva partida
                    $controlador->newGame();
                } elseif ($metodo === 'POST' && count($parametros) === 2 && $parametros[1] === 'passrecovery') { // POST /player/recoverPass
                    $controlador->recoverPass();
                } else {
                    header('HTTP/1.1 404');
                    echo json_encode(['error' => 'Endopint no soportado']);
                }
            } else {
                header('HTTP/1.1 404');
                echo json_encode(['error' => 'Recurso no encontrado']);
            }
        } else {
            header('HTTP/1.1 401');
            echo json_encode(['error' => 'credenciales invalidas']);
        }
    } else {
        header('HTTP/1.1 401');
        echo json_encode(['error' => 'error en las credenciales(username y clave)']);
    }
} else {
    header('HTTP/1.1 404');
    echo json_encode(['error' => 'Ruta no valida']);
}
