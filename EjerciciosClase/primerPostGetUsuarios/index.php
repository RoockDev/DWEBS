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
}
