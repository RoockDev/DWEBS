<?php

require_once('./tablero.php');

class Factoria{
    public static function generaTablero(){
        $tamaniosTablero = [10,15,12,13,345];
        $tablero = new Tablero($tamaniosTablero[rand(0,count($tamaniosTablero) - 1)]);
        return $tablero;
    }
}