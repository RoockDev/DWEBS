<?php

class Partida{
    private $id;
    private $idUsuario;
    private $tablero;
    private $estado;
    private $intentosTotales;

    public function __construct($idUsuario,$tablero,$estado)
    {
        $this->idUsuario = $idUsuario;
        $this->tablero = $tablero;
        $this->estado = $estado;

        $this->intentosTotales = 0;
    }

    public function inicializarTablero(){
        $this->tablero = array_fill(0,10,'_');
        return $this->tablero;
    }

    public function colocarMosca(){
        $posicionMosca = rand(0, count($this->tablero) - 1);
        $this->tablero[$posicionMosca] = '*';
    }

    public function darManotazo($posicion){
        $this->intentosTotales++;

        if ($this->tablero[$posicion] == '*') {
            $this->estado = 'ganada';
            return [
                "resultado" => "atrapada",
                "mensaje" => "has cazado a la mosca",
                "posicion" => $posicion,
                "intents totales" => $this->intentosTotales,
            ];
        }

        for ($i=0; $i <count($this->tablero) ; $i++) { 
            if ($this->tablero[$i] == '*') {
                $distancia = abs($posicion - $i);
                if ($distancia == 1) {
                    return [
                        "resultado" => "cerca",
                        "mensaje" => "te has quedado cerca",
                        "intentos totales" => $this->intentosTotales,
                    ];
                }
            }
        }

        return [
            "resultado" => "lejos",
            "mensaje" => "te has quedado muy lejos de la mosca",
        ];
    }



    /**
     * Get the value of estado
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado($estado): self {
        $this->estado = $estado;
        return $this;
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
     * Get the value of idUsuario
     */
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     */
    public function setIdUsuario($idUsuario): self {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get the value of tablero
     */
    public function getTablero() {
        return $this->tablero;
    }

    /**
     * Set the value of tablero
     */
    public function setTablero($tablero): self {
        $this->tablero = $tablero;
        return $this;
    }

    /**
     * Get the value of intentosTotales
     */
    public function getIntentosTotales() {
        return $this->intentosTotales;
    }

    /**
     * Set the value of intentosTotales
     */
    public function setIntentosTotales($intentosTotales): self {
        $this->intentosTotales = $intentosTotales;
        return $this;
    }
}