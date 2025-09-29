<?php

require_once ('./animal.php');
require_once('./metodos.php');

class gato extends Animal implements Metodos{
    private $cantidadDeMaldad;

    public function __construct($no,$ra,$pe,$co,$cm){
        parent::__construct($no,$ra,$pe,$co);
        $this->cantidadDeMaldad = $cm;
    }

    public function hacerRuido(){
        return 'Maullido';
    }

    public function hacerCaso(){
        
        $cantidadeCaso = rand(1,100);
        return $cantidadeCaso <= 5;

        
    }

    public  function comer(){
        return true;
    }

    public  function dormir(){
        return true;
    }


    private function toserBolaPelo(){
        return 'Bola de pelo tosida';
    }

    /**
     * Get the value of cantidadDeMaldad
     */
    public function getCantidadDeMaldad() {
        return $this->cantidadDeMaldad;
    }

    /**
     * Set the value of cantidadDeMaldad
     */
    public function setCantidadDeMaldad($cantidadDeMaldad): self {
        $this->cantidadDeMaldad = $cantidadDeMaldad;
        return $this;
    }

    public function __toString(){
        return 'Gato:'.parent::__toString();
    }
}