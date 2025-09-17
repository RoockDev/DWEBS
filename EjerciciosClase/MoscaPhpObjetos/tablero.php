<?php
class Tablero {
    private $casillas;

    public function __construct($cantidadCasillas){
        for ($i=0; $i < $cantidadCasillas ; $i++) { 
            $this->casillas[] = '_';
        }
    }

    


    public function colocarLaMosca(){
        $posicion = rand(0, count($this->casillas) - 1);
        $this->casillas[$posicion] = '*';
    }

    /**
     * 2-al lado mosca
     * 1- mosca cazada
     * 
     */
    public function golpeMosca($posicion){
        $accion = 0;
        if ($this->casillas[$posicion] === '*') {
            $accion = 1;
        }else{
            if ($posicion > 0) {
                if ($this->casillas[$posicion - 1]  == '*') {
                    $accion = 2;
                }
            }
            if ($posicion < count($this->casillas)) {
                if ($this->casillas[$posicion + 1]  == '*') {
                    $accion = 2;
                }
            }
        }

        return $accion;
    }

    public function toString(){
        $cadena = "";
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