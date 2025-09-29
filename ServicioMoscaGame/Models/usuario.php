<?php

class Usuario {
    private $id;
    private $dni;
    private $nombre;
    private $email;
    private $clave;
    private $tfno;
    private $es_admin;
    private $partidas_jugadas;
    private $partidas_ganadas;

    public function __construct($dni,$nombre,$email=null,$clave,$tfno = null,$es_admin = false)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->clave = $clave;
        $this->tfno = $tfno;
        $this->es_admin = $es_admin;
        $this->partidas_jugadas = 0;
        $this->partidas_ganadas = 0;
    }

    
    public function verificarClave($clave_ingresada){ // esto iria aqui o en el controlador? 
        return $this->clave === md5($clave_ingresada); // no se si estoy haciendo bien lo de md5, es asi?
    }

    


    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of dni
     */
    public function getDni() {
        return $this->dni;
    }

    /**
     * Set the value of dni
     */
    public function setDni($dni): self {
        $this->dni = $dni;
        return $this;
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
     * Get the value of clave
     */
    public function getClave() {
        return $this->clave;
    }

    /**
     * Set the value of clave
     */
    public function setClave($clave): self {
        $this->clave = $clave;
        return $this;
    }

    /**
     * Get the value of tfno
     */
    public function getTfno() {
        return $this->tfno;
    }

    /**
     * Set the value of tfno
     */
    public function setTfno($tfno): self {
        $this->tfno = $tfno;
        return $this;
    }

    /**
     * Get the value of es_admin
     */
    public function getEsAdmin() {
        return $this->es_admin;
    }

    /**
     * Set the value of es_admin
     */
    public function setEsAdmin($es_admin): self {
        $this->es_admin = $es_admin;
        return $this;
    }

    /**
     * Get the value of partidas_jugadas
     */
    public function getPartidasJugadas() {
        return $this->partidas_jugadas;
    }

    /**
     * Set the value of partidas_jugadas
     */
    public function setPartidasJugadas($partidas_jugadas): self {
        $this->partidas_jugadas = $partidas_jugadas;
        return $this;
    }

    /**
     * Get the value of partidas_ganadas
     */
    public function getPartidasGanadas() {
        return $this->partidas_ganadas;
    }

    /**
     * Set the value of partidas_ganadas
     */
    public function setPartidasGanadas($partidas_ganadas): self {
        $this->partidas_ganadas = $partidas_ganadas;
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }
}