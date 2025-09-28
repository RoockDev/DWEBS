<?php

class Partida{
    private $id;
    private $idUsuario;
    private $tablero;
    private $estado;
    private $intentosTotales;

    //de esta forma podemos tratar el tablero como string
    public function __construct($idUsuario,$tablero = null,$estado = null)
    {
        $this->idUsuario = $idUsuario;
        $this->estado = $estado;
        $this->intentosTotales = 0;

        if ($tablero === null) {
            $this->tablero = array_fill(0,10,'_');
        }elseif (is_string($tablero)) {
            //si el tablero viene como un string de la base de datos lo convertimos en array
            $this->tablero = str_split($tablero);
            
        }else{
            //si es array se usa directamente
            $this->tablero = $tablero;
        }
    }

    // convertimos el tablero de array a string si lo queremos guardar en bd
    public function getTableroAsString(){
        return implode('',$this->tablero); //implode une los elementos de un array en una cadena de texto por el delimitador que tu le pongas
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
        if (is_string($tablero)) {
            $this->tablero = str_split($tablero);
        }else{
            $this->tablero = $tablero;
        }
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