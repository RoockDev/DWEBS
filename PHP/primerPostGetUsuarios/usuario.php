<?php

class Usuario {
    private static $instancia = null;

    private $nombre;
    private $edad;
    private $password;
    private $nombres = ['pepe','mikel','vinicius','Martin','Jaime'];
    private $edades = [20,21,23,34,45];
    private $passwords = ['123123','234234234','234234234','asdasd','dfdfdfdf'];



    private function __construct(){

    }

    private static $usuarios = [];

    // metodo para instanciar solo una clase y que sea singleton
    public static function getInstancia(){
        if (self::$instancia == null) {
            self::$instancia = new self();
        }

        return self::$instancia;
    }

    public function getAllUsuarios(){
        $allUsers = [];
        for ($i=0; $i < count($this->nombres)  ; $i++) { 
            $allUsers[] = [
               "nombre" => $this->nombres[$i],
               "edad" => $this->edades[$i],
               "password" =>$this->passwords[$i]
            ];
        }

        return $allUsers;
    }

    public function agregarUsuario($datosUsuario){
        // uso self como si fuese el companion object en kotlin
        self::$usuarios[] = $datosUsuario;
    }

    

    public function getUsuario($indice){
        $usuario = [$this->nombres[$indice],$this->edades[$indice],$this->passwords[$indice]];
        return $usuario;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get the value of edad
     */
    public function getEdad() {
        return $this->edad;
    }

    /**
     * Set the value of edad
     */
    public function setEdad($edad): self {
        $this->edad = $edad;
        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }
}