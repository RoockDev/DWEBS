<?php

class Usuario{
    private $dni;
    private $nombre;
    private $clave;
    private $tfno;

    public function __construct($dni,$nombre,$clave,$tfno)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->tfno = $tfno;
        
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

    public function mostrarInfo() {
        return "DNI: $this->dni, Nombre: $this->nombre,Clave:  $this->clave, Tfno: $this->tfno";
    }
}