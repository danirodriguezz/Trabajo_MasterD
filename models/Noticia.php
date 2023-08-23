<?php
namespace Model;

class Noticia extends ActiveRecord {
    //Base de datos
    protected static $tabla = "noticias";
    protected static $columnasDB = ["id", "idUser", "titulo", "imagen", "texto", "fecha"];
    public $id;
    public $idUser;
    public $titulo;
    public $imagen;
    public $texto;
    public $fecha;


    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->idUser = $args["idUser"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->texto = $args["texto"] ?? "";
        $this->fecha = date("Y/m/d");
    }

    public function validarErrores() :array {
        if(!$this->titulo) {
            self::$alertas["error"][] = "El titulo es obligatorio";
        }
        if(!$this->imagen) {
            self::$alertas["error"][] = "La imagen es obligatoria";
        }
        if(strlen($this->texto) < 50) {
            self::$alertas["error"][] = "El texto es obligatorio y necesita mínimo 50 caracteres";
        }
        return self::$alertas;
    }

}