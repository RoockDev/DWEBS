<?php

//controlador solo para el admin

require_once './DataBase/usuario_dao.php';
require_once './Models/usuario.php';

class ControllerUsuarios
{
    private $usuarioAutenticado;

    public function __construct($usuario)
    {
        if (!$this->usuarioAutenticado->getEsAdmin()) {
            header('HTTP/1.1 403');
            echo json_encode(['error' => 'Acceso denegado, solo los administradores pueden acceder usar estos endpoints']);
        }
    }
      // GET /admin -> listar todos los usuarios
    public function getUsers()
    {

        try {
            $usuarios = UsuarioDAO::getAll();

            $listaDeUsuarios = [];

            foreach ($usuarios as $usuario) {
                $listaDeUsuarios[] = [
                    'id' => $usuario->getId(),
                    'dni' => $usuario->getDni(),
                    'nombre' => $usuario->getNombre(),
                    'tfno' => $usuario->getTfno(),
                    'es_admin' => (bool) $usuario->getEsAdmin(), //(bool) lo ponemos aqui para que en el json salga true o false, no salga 1 o 0
                    'partidas_jugadas' => $usuario->getPartidasJugadas(),
                    'partidas_ganadas' => $usuario->getPartidasGanadas()
                ];
            }

            header('HTTP/1.1 200');
            echo json_encode($listaDeUsuarios);
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'Error al obtener los usuarios' . $e->getMessage()]);
        }
    }

    //GET /admin/id -> obtener un usuario por su id
    public function getUser($id)
    {

        try {
            $usuario = UsuarioDAO::getById($id);

            if (!$usuario) {
                header('HTTP/1.1 404');
                echo json_encode(['error' => 'usuario no encontrado']);
            } else {
                header('HTTP/1.1 200');
                echo json_encode([
                    'id' => $usuario->getId(),
                    'dni' => $usuario->getDni(),
                    'nombre' => $usuario->getNombre(),
                    'tfno' => $usuario->getTfno(),
                    'es_admin' => (bool) $usuario->getEsAdmin(),
                    'partidas_jugadas' => $usuario->getPartidasJugadas(),
                    'partidas_ganadas' => $usuario->getPartidasGanadas()

                ]);
            }
        } catch (Exception $e) {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'Error al obtener usuario' . $e->getMessage()]);
        }
    }

// POST /admin -> crear nuevo usuario
public function createUser(){
    try {
        $datos = json_decode(file_get_contents('php//input'),true) ;

        if (!isset($datos['dni']) || !isset($datos['nombre']) || !isset($datos['clave'])) {
            header('HTTP/1.1 400');
            echo json_encode(['Error' => 'Faltan campos obligatorios: dni,nombre,clave']);
        }else{
            $nuevoUsuario = new Usuario(
                $datos['dni'],
                $datos['nombre'],
                $datos['clave'],
                $datos['tfno'] ?? null, // si no se introduce nada es null
                $datos['es_admin'] ?? 0, // si no se introduce nada es false
            );
        }

        $exito = UsuarioDAO::insert($nuevoUsuario);

        if ($exito) {
            header('HTTP/1.1 201');
            echo json_encode([
                'mensaje' => 'Usuario creado correctamente',
                'id' => $nuevoUsuario->getId(),
                'dni' => $nuevoUsuario->getDni(),
                'nombre' => $nuevoUsuario->getNombre()
            ]);
        }else {
            header('HTTP/1.1 500');
            echo json_encode(['error' => 'No se pudo crear el usuario']);
        }

    } catch (Exception $e) {
        header('HTTP/1.1 500');
        echo json_encode(['error' => 'no se pudo crear el usuario'].$e->getMessage());
        
    }
}


//PUT /admin/id -> actualizar usuario
public function updateUser($id){
    try {
        $datos = json_decode(file_get_contents('php//input'),true);

        $usuario = UsuarioDAO::getById($id);

        if (!$usuario) {
            header('HTTP/1.1 404');
            echo json_encode(['error' => 'Usuario no encontrado']);
        }else{
            if (isset($datos['nombre'])) {
                # code...
            }
        }

    } catch (\Throwable $th) {
        //throw $th;
    }
}




























}
