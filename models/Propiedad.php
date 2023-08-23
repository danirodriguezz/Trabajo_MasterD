<?php 
namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = "propiedades";
    protected static $columnasDB = ["id", "idUser", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", 
    "estacionamiento","creado"];

    public $id;
    public $idUser;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? NULL;
        $this->idUser = $args["idUser"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
    }

    public function validarErrores() :array {
        if(!$this->titulo) {
            self::$alertas["error"][] = "El titulo es obligatorio";
        }
        if(!$this->precio || $this->precio > 99999999 ) {
            self::$alertas["error"][] = "El apartado de precio esta mal introducido";
        }
        if(strlen($this->descripcion) < 50) {
            self::$alertas["error"][] = "La descripción es obligatorio y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones) {
            self::$alertas["error"][] ="Debe introducir mínimo 1 habitación";
        }
        if(!$this->wc) {
            self::$alertas["error"][] = "El wc es obligatorio";
        }
        if(!$this->estacionamiento) {
            self::$alertas["error"][] = "El estacionamiento es obligatorio";
        }
        if(!$this->imagen) {
            self::$alertas["error"][] = "La imagen de la propiedad es obligatoria";
        }
        
        return self::$alertas;
    }

}