<?php

require_once('./parametros.php');

class Conexion
{
    private static $instancia = null;
    private $conexion;

    private function __construct() {}

    public static function getInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new Conexion();
        }

        return self::$instancia;
    }

    //metodo para obtener la conexion
    public function getConexion()
    {

        if ($this->conexion === null) {
            $this->conexion = mysqli_connect(
                Parametros::SERVIDOR,
                Parametros::USUARIO,
                Parametros::PASSWORD,
                Parametros::BASE_DATOS
            );


            if (!$this->conexion) {
                throw new Exception('Fallo al conectar con base de datos' . mysqli_connect_error());
            }

            return $this->conexion;
        }
    }

    //metodo para cerrar la conexion

    public function closeConexion(){
        if ($this->conexion) {
            mysqli_close($this->conexion);
            
        }
    }
}
