<?php

require_once ('./animal.php');
require_once('./metodos.php');


class Perro extends Animal implements Metodos{
    private $pedigree;
    public function __construct($no,$ra,$pe,$co,$pg){

        parent::__construct($no,$ra,$pe,$co);
        $this->pedigree = $pg;
    }

    public function hacerRuido(){
        return 'Ladrido <br>';
    }

    public function hacerCaso(){
       
        $cantidadeCaso = rand(1,10);
        
        return $cantidadeCaso < 10;
    }

    private function sacarPaseo(){
        return 'sacado de paseo';
    }

    public  function comer(){
        return true;
    }

    public  function dormir(){
        return true;
    }


    /**
     * Get the value of pedigree
     */
    public function getPedigree() {
        return $this->pedigree;
    }

    /**
     * Set the value of pedigree
     */
    public function setPedigree($pedigree): self {
        $this->pedigree = $pedigree;
        return $this;
    }

    public function __toString(){
        return 'Perro:'.parent::__toString();
    }
}