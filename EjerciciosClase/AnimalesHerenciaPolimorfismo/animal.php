<?php

 abstract class Animal {
    public $nombre;
    public $raza;
    public $peso;
    public $color;

    public function __construct($no,$ra,$pe,$co){
        $this->nombre = $no;
        $this->raza = $ra;
        $this->peso = $pe;
        $this->color = $co;
    }

    /**
     * Get the value of nombre
     */
    public function getNo(){
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNo($no): self {
        $this->nombre = $no;
        return $this;
    }

    /**
     * Get the value of raza
     */
    public function getRa() {
        return $this->raza;
    }

    /**
     * Set the value of raza
     */
    public function setRa($ra): self {
        $this->raza = $ra;
        return $this;
    }

    /**
     * Get the value of peso
     */
    public function getPe() {
        return $this->peso;
    }

    /**
     * Set the value of peso
     */
    public function setPe($pe): self {
        $this->peso = $pe;
        return $this;
    }

    /**
     * Get the value of color
     */
    public function getCo() {
        return $this->color;
    }

    /**
     * Set the value of color
     */
    public function setCo($co): self {
        $this->color = $co;
        return $this;
    }

   
    public function __toString(){
        return 'Animal(nombre='. $this->nombre.',raza='.$this->raza.',peso='.$this->peso.',color='.$this->color.')<br>';
    }
    public  function vacunar(){
        return true;
    }

    public  function comer(){
        return true;
    }

    public  function dormir(){
        return true;
    }

    public function hacerRuido(){
        return 'Ruido <br>';
    }

    public function hacerCaso(){
        $haceCaso = false;
        $cantidadCaso = rand(1,10);
        if ($cantidadCaso >= 1 && $cantidadCaso <= 5) {
            $haceCaso = true;
        }
        return $haceCaso;

    }



    
    
}