<?php

require_once('./animal.php');
require_once('./metodos.php');

class Elefante extends Animal implements Metodos{

    private $altura;

    public function __construct($no,$ra,$pe,$co,$al){
        parent::__construct($no,$ra,$pe,$co);
        $this->altura = $al;

    }

   

     public function hacerRuido(){
        return 'tururuur';
    }
     public  function comer(){
        return true;
    }

    public  function dormir(){
        return true;
    }
    /**
     * Get the value of altura
     */
    public function getAltura() {
        return $this->altura;
    }

    /**
     * Set the value of altura
     */
    public function setAltura($altura): self {
        $this->altura = $altura;
        return $this;
    }

   public function toString(){
    return 'Elefante:'.parent::__toString();
   }

}