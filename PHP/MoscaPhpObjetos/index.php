<?php

require_once './Tablero.php';
require './factorias.php';

echo $_SERVER["REQUEST_URI"].'<br>';
echo $_SERVER["REQUEST_METHOD"].'<br>';

$parametros = explode("/",$_SERVER["REQUEST_URI"]);
unset($parametros[0]);

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if ($parametros[1] == "jugar" ) {
        $tableroDeJuego = new Tablero($parametros[2]);
        $tableroDeJuego->colocarLaMosca();
        echo ($tableroDeJuego->toString());
        echo ($tableroDeJuego->golpeMosca(intval($parametros[3])));
    }
}


//$tableroDeJuego = new Tablero(10);
//$tableroDeJuego-> colocarLaMosca();
//$tableroDeJuego->golpeMosca(); 