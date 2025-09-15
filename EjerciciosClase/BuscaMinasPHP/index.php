<?php

echo $_SERVER["REQUEST_URI"].'<br>';
echo $_SERVER["REQUEST_METHOD"].'<br>';

$ser

$parametros = explode("/",$_SERVER["REQUEST_URI"]);
unset($parametros[0]);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if ($parametros[1] == "iniciar") {
        inicializarTablero($tablero,20);
        colocarMinas($tablero);
        echo(toString($tablero));
    
    }

    if($parametros[1] == "jugar"){
        $tablero = [];
        inicializarTablero($tablero,20);
        colocarMinas($tablero);
        echo(toString($tablero));
        echo(toString(tirada($tablero,$parametros[2])));
        echo(toString(minasAdyacentesDerecha($tablero,$parametros[2])));
        echo(toString(minasAdyacentesIzquierda($tablero,$parametros[2])));
    }
}



$tablero = [];
$tamanioTablero = 20;

function inicializarTablero(&$tablero,$tamanio){
    for ($i=0; $i < $tamanio ; $i++) { 
        $tablero[] = rand(0,2);
    }
}

function colocarMinas(&$tablero){
    $minas = 6;
    while($minas != 0){
        $posicion = rand(0,count($tablero) - 1);
        if ($tablero[$posicion] != '*') {
            $tablero[$posicion] = '*';
            $minas--;
        }
    }

}

function toString($tablero){
    $cadena = "";
    for ($i=0; $i < count($tablero) ; $i++) { 
        $cadena = $cadena.' '.$tablero[$i].' ';
    }
    return $cadena;
}

/**
 * 1  - explota mina
 * 0 - casilla libre de minas
 */

function tirada($tablero,$posicion){
    $resultadoTirada = 0;
    if ( $tablero[$posicion] == '*') {
        $resultadoTirada = 1;
    }else {
        if ($posicion > 0 && $tablero[$posicion] != '*') {
            $tablero[$posicion] = '-';
        }

        if ($posicion < count($tablero) && $tablero[$posicion] != '*') {
            $tablero[$posicion] = '-';
        }
    }

    return $resultadoTirada;
}

/*
 * contador = cantodad de minas adyacentes que hay a la derecha 
 */

function minasAdyacentesDerecha($tablero, $posicion) {
    $contador = 0;
    $salir = false;

    while (!$salir) {
        
        if ($posicion >= count($tablero) - 1) {
            $salir = true;
            
        }

        $posicion++; 

        
        if (isset($tablero[$posicion]) && $tablero[$posicion] != '*') {
            $contador++;
        } else {
            $salir = true;
        }
    }
    return $contador;
}

/**
 * contador = cantidad de minas adyacentes que hay a la izquierda
 */

function minasAdyacentesIzquierda($tablero, $posicion) {
    $contador = 0;
    $salir = false;

    while (!$salir) {
        
        if ($posicion <= 0) {
            $salir = true;
            
        }

        $posicion--; 

        
        if (isset($tablero[$posicion]) && $tablero[$posicion] != '*') {
            $contador++;
        } else {
            $salir = true;
        }
    }
    return $contador;
}
//inicializarTablero($tablero,20);
//colocarMinas($tablero);
//echo(toString($tablero));