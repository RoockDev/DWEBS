<?php

   require_once('./conexion.php');
   require_once('./usuario.php');
   require_once('./usuariosDAOphp');

   echo $_SERVER["REQUEST_URI"];
   echo $_SERVER["REQUEST_METHOD"];

$parametros = explode("/",$_SERVER["REQUEST_URI"]);
unset($parametros[0]);


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $usuarioDAO = new UsuarioDAO();
    switch ($parametros[1]) {
        case 'getByDni':
            
            if (isset($parametros[2])) {
                $dni = $parametros[2];
                try {
                    $usuario = $usuarioDAO->getUserByDni($dni);
                    $datos = [
                        "dni" => $usuario->getDni(),  
                        "nombre" => $usuario->getNombre(),
                        "clave" => $usuario->getClave(),
                        "tfno" => $usuario->getTfno()
                    ];

                    header("HTTP/1.1 200 ok");
                    echo json_encode($datos);
                } catch (Exception $e) {
                    header("HTTP/1.1 500 Internal Server Error");
                    throw new Exception("500 Internal Server Error".$e->getMessage());
                    
                }
            }
            break;
        
        
        case 'getAllUsers':  //preguntar en clase si esto va por buen camino
            try {
                $usuarios = $usuarioDAO->getAllUsers();
                header("HTTP/1.1 200 ok");
                echo json_encode($usuarios);
            } catch (Exception $e) {
                header("HTTP/1.1 500 Internal Server Error");
                throw new Exception("500 Internal Server Errir".$e->getMessage());
                
                
            }
            
    }
}