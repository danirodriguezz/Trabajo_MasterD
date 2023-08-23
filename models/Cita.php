<?php
namespace Model;

class Cita extends ActiveRecord{
    //Base de datos
    protected static $tabla = "citas";
    protected static $columnasDB = ["id", "idUser", "fecha_cita", "motivo_cita"];
    public $id;
    public $idUser;
    public $fecha_cita;
    public $motivo_cita;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->idUser = $args["idUser"] ?? null;
        $this->fecha_cita = $args["fecha_cita"] ?? "";
        $this->motivo_cita = $args["motivo_cita"] ?? "";
    }

    public function validar() {
        if(empty($this->motivo_cita)) {
            self::$alertas["error"][] = "Debes Indicar el motivo de tu Cita";
        }
        if(empty($this->fecha_cita)) {
            self::$alertas["error"][] = "La fecha de la cita es Obligatoria";
        }
        return self::$alertas;
    }
}