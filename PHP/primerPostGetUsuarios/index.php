<?php

require_once('./usuario.php');

 $usuario = Usuario::getInstancia();
 $usuario->setNombre("pepe");
 $usuario->setEdad(20);
 $usuario->setPassword("1234");
 $nombre = $usuario->getNombre();
 $edad = $usuario->getEdad();
 $password = $usuario->getPassword();

 $datos = [
     "nombre" => $nombre,
     "edad" => $edad,
     "password" => $password
 ];

// echo $_SERVER['REQUEST_URI'];
// echo $_SERVER['REQUEST_METHOD'];

$parametros = explode("/", $_SERVER['REQUEST_URI']);
unset($parametros[0]);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($parametros[1] == "usuario") { // para probar
        header("HTTP/1.1 202 Creado");
        echo json_encode($datos);
    } elseif ($parametros[1] == "usuarioConcreto") {
        $user = $usuario->getUsuario(intval($parametros[2]));
        header("HTTP/1.1 202 Creado");
        echo json_encode($user);
    } elseif ($parametros[1] == "usuarios") {
        header("HTTP/1.1 202 Creado");
        echo json_encode($usuario->getAllUsuarios());
    }
}else{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($parametros[1] === "agregarUsuario") {
            $datosRecibidos = file_get_contents("php://input");
            $usuarioNuevo = json_decode($datosRecibidos,true);
            echo $usuarioNuevo["nombre"];
            echo $usuarioNuevo["edad"];
            echo $usuarioNuevo["password"];
            //estas 3 lineas no las entiendo por que no salen en ningun lado

            //echo $usuarioNuevo->nombre;
            //echo $usuarioNuevo->edad;
            //echo $usuarioNuevo->password;

            $usuario->agregarUsuario($usuarioNuevo);
            header("HTTP/1.1 200");
        }else{
            if ($parametros[1] === "login") {
                $datosRecibidos = file_get_contents("php://input");
                $datosLoginUsuario = json_decode($datosRecibidos,true);

                /**
                 * No se me ocurre haciendolo desde el singleton 
                 * de usuario asi que lo voy simular manualmente 
                 * para comprobar que funciona
                 */

                $usuariosPrueba = [
                    "sergio" => "1234",
                    "hugo" => "0000",
                    "ragnar" => "1111"
                ];

                //hecho sin manejo de erroes para probar
                if ($usuariosPrueba[$datosLoginUsuario['nombre']] === $datosLoginUsuario['password']) {
                    header("HTTP/1.1 200 ok");
                }else{
                    header("HTTP/1.1 401 Unauthorized");
                }

            }
        }
        
    }
}
