<?php
namespace Model;

class UsuarioLogin extends ActiveRecord {
    //Base de datos 
    protected static $tabla = "users_login";
    protected static $columnasDB = ["id", "idUser", "usuario", "password", "rol"];
    public $id;
    public $idUser;
    public $usuario;
    public $password;
    public $rol;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->idUser = $args["idUser"] ?? "";
        $this->usuario = $args["usuario"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->rol = $args["rol"] ?? "user";
    }
    //Validamos que los campos esten correctos al crear la Cuenta
    public function validar()
    {
        if(empty($this->usuario)) {
            self::$alertas["error"][] = "El nombre de usuario es Obligatorio";
        }
        if(empty($this->password) || strlen($this->password) < 6) {
            self::$alertas["error"][] = "El password es obligatorio y debe tener 6 caracteres mínimo";
        }
        return self::$alertas;
    }
    //validar si el nombre de usuario ya esta creado 
    public function existeUsuario() 
    {
        $query = "SELECT * FROM ". self::$tabla . " WHERE usuario = '" . $this->usuario . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alertas["error"][] = "El nombre de Usuario ya esta registrado";
        }
    }
    //Hasheamos el Password
    public function hashPassword() 
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
    //Verificamos que el password introducido sea el corrrectp
    public function verificarPassword($password) {
        $resultado = password_verify($password, $this->password);
        if(!$resultado) {
            self::$alertas["error"][] = "Usuario o contraseña invalidos";
        } else {
            return true;
        }
    }
}