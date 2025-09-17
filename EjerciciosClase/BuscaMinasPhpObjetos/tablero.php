<?php

class Tablero{
    private $casillas;

    public function __construct($cantidadCasillas){
        for ($i=0; $i < $cantidadCasillas ; $i++) { 
            $this->casillas[] = rand(0,2);
        }
    }

    public function colocarMinas(){
        $cantidadMinas = 6;
        while($cantidadMinas > 0) {
            $posicion = rand(0,count($this->casillas)-1);
            if ($this->casillas[$posicion] != '*') {
                $this->casillas[$posicion] = '*';
                $cantidadMinas--; 
            }
        }
    }

    /**
     * 1- Mina Adyacente
     * 2-Mina explotada
     */
    public function minasAdyacentes($posicion){
        $accion = 0;
        if ($this->casillas[$posicion] == '*') {
            $this->casillas[$posicion] == '_';
            $accion = 2;
        }else{
            if ($posicion > 0) {
                if ($this->casillas[$posicion - 1]  == '*') {
                    $accion = 1;
                }
            }

            if ($posicion < count($this->casillas) - 1 ) {
                if ($this->casillas[$posicion + 1]  == '*') {
                    $accion = 1;
                }
            }
        }

        return $accion;

    }

    public function toString(){
        $cadena = '';
        for ($i=0; $i < count($this->casillas) ; $i++) { 
            $cadena = $cadena.' '.$this->casillas[$i].' ';
        }
        return $cadena;
    }

    

    /**
     * Get the value of casillas
     */
    public function getCasillas() {
        return $this->casillas;
    }

    /**
     * Set the value of casillas
     */
    public function setCasillas($casillas): self {
        $this->casillas = $casillas;
        return $this;
    }
}