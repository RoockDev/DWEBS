<?php

echo $_SERVER["REQUEST_URI"].'<br>';
echo $_SERVER["REQUEST_METHOD"].'<br>';

$parametros = explode("/",$_SERVER["REQUEST_URI"]);
unset($parametros[0]);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if ($parametros[1] == "iniciar") {
        inicializarTablero($tablero,$parametros[2]);
        colocarLaMosca($tablero);
        echo(toString($tablero));
    }

    if ($parametros[1] == "jugar") {
        inicializarTablero($tablero,10);
        colocarLaMosca($tablero);
        echo(toString($tablero));
        echo(golpeMosca($tablero,$parametros[2]));
    }
}

$tablero = [];

function inicializarTablero(&$tablero,$cant){
    for ($i=0; $i < $cant ; $i++) { 
        $tablero[] = '_';
    }
}

function colocarLaMosca(&$tablero){
    $posicion = rand(0,count($tablero) - 1);
    $tablero[$posicion] = '*';

}

/**
 * 0 - manotazo lejos de mosca
 * 1 - mosca cazada
 * 2-  casi se caza mosca
 */

function golpeMosca($tablero,$posicion){
    $accion = 0;

    if($tablero[$posicion] === '*'){
        $accion = 1;
    }else{
        if ($posicion > 0) {
            if ($tablero[$posicion - 1] == '*') {
                $accion = 2;
            }   
        }

        if ($posicion < count($tablero)) {
            if ($tablero[$posicion + 1] == '*') {
                $accion = 2;
            }
        }
    }

    return $accion;
}

function toString($tablero){
    $cadena = "";
    for ($i=0; $i < count($tablero) ; $i++) { 
        $cadena = $cadena. ' ' . $tablero[$i].' ';
    }

    return $cadena;
}

//inicializarTablero($tablero,10);
//colocarLaMosca($tablero);
//echo(toString($tablero));
//golpeMosca($tablero,7);