<?php
namespace Model;



class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = "users_data";
    protected static $columnasDB = ["id", "nombre", "apellido", "email", "telefono", "fecha_nacimiento", "direccion", "sexo"];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $fecha_nacimiento;
    public $direccion;
    public $sexo;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";    
        $this->apellido = $args["apellido"] ?? "";    
        $this->email = $args["email"] ?? "";    
        $this->telefono = $args["telefono"] ?? "";    
        $this->fecha_nacimiento = $args["fecha_nacimiento"] ?? "";    
        $this->direccion = $args["direccion"] ?? "";    
        $this->sexo = $args["sexo"] ?? "";    
    }

    public function validar() {
        if(empty($this->nombre)) {
            self::$alertas["error"][] = "El nombre es Obligatorio";
        }
        if(empty($this->apellido)) {
            self::$alertas["error"][] = "El Apellido es Obligatorio";
        }
        if(empty($this->email)) {
            self::$alertas["error"][] = "El email es Obligatorio";
        }
        if(empty($this->telefono) || !is_numeric($this->telefono)) {
            self::$alertas["error"][] = "El numero de telefono no es valido";
        }
        if(empty($this->fecha_nacimiento)) {
            self::$alertas["error"][] = "La fecha de nacimiento es Obligatoria";
        }
        if(empty($this->sexo)) {
            self::$alertas["error"][] = "Seleccione un sexo para el usuario";
        }
        return self::$alertas;
    }

    //Validar que el email no este creado ya 
    public function existeEmail() {
        $query = "SELECT * FROM ". self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alertas["error"][] = "El email ya esta registrado";
        }
    }
}