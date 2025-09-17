<?php

require_once('./tablero.php');

class Factoria{
    public static function generarTablero(){
        $tamaniosTablero = [20,30,40,50];
        $tablero = new Tablero($tamaniosTablero[rand(0,count($tamaniosTablero) - 1)]);
    }
}