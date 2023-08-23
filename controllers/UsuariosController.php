<?php
namespace Controllers;

use Model\ActiveRecord;
use Model\Cita;
use Model\Usuario;
use Model\UsuarioLogin;
use MVC\Router;

class UsuariosController {
    public static function index(Router $router) {
        session_start();
        $idUser = $_SESSION["idUser"];
        $resultado = $_GET["resultado"] ?? null;
        // Consulta personalizada para optener informacion de los administradores
        $consulta = "SELECT users_data.id, users_data.nombre, users_data.apellido, users_data.email";
        $consulta .= " FROM users_login";
        $consulta .= " INNER JOIN users_data ON users_login.idUser = users_data.id";
        $consulta .= " WHERE users_login.rol = 'admin'";
        // Aqui se van a guardar todos los usuarios con rol 'admin'
        $usuariosAdmin = Usuario::SQL($consulta);
        //// Consulta personalizada para optener informacion de los usuarios
        $consulta = "SELECT users_data.id, users_data.nombre, users_data.apellido, users_data.email";
        $consulta .= " FROM users_login";
        $consulta .= " INNER JOIN users_data ON users_login.idUser = users_data.id";
        $consulta .= " WHERE users_login.rol = 'user'";
        // Aqui se van a guardar todos los usuarios con rol 'user'
        $usuarios = Usuario::SQL($consulta);
        $citas = Cita::all();
        $router->render("admin/usuarios/index", [
            "resultado" => $resultado,
            "usuarios" => $usuarios,
            "usuariosAdmin" => $usuariosAdmin,
            "citas" => $citas,
            "idUser" => $idUser
        ]);
    }

    public static function crear(Router $router) {
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario($_POST);
            $usuario_login = new UsuarioLogin($_POST);
            $usuario->validar();
            $usuario_login->validar();
            $usuario->existeEmail();
            $usuario_login->existeUsuario();
            $errores = ActiveRecord::getAlertas();
            if(empty($errores)) {
                //Una vez comporbadas las alertas guardamos los datos
                $resultado = $usuario->guardar();
                if($resultado["resultado"]) {
                    //Si se guardó correctamente los datos actualizamos el id del Usuario, hasheamos el password y guardamos los datos
                    $usuario_login->idUser = $resultado["id"];
                    $usuario_login->hashPassword();
                    $resultado = $usuario_login->guardar();
                    if($resultado["resultado"]) {
                        header("Location: /admin/usuarios?resultado=1");
                    }
                }
            }
        }
        $router->render("admin/usuarios/crear", [
            "usuario" => $usuario,
            "usuario_login" => $usuario_login,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar("/admin");
        $errores = [];
        $usuario = Usuario::find($id);
        $usuario_login = UsuarioLogin::where("idUser", $id);
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizar($_POST);
            $usuario_login->sincronizar($_POST);
            $usuario->validar();
            $usuario_login->validar();
            $errores = ActiveRecord::getAlertas();
            if(empty($errores)) {
                $resultado = $usuario->guardar();
                if($resultado) {
                    $usuario_login->guardar();
                    header("Location: /admin/usuarios?resultado=2");
                }
            }
        }
        $router->render("admin/usuarios/actualizar", [
            "usuario" => $usuario,
            "usuario_login" => $usuario_login,
            "errores" => $errores
        ]);
    }

    public static function eliminar() {
        if(!isAdmin()) {
            header("Location: /");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id) {
                $tipo = $_POST["tipo"];
                //Validamos que existe el tipo
                if(validarTipoContenido($tipo)) {
                    if($tipo === "user" || $tipo === "admin") {
                        //Eliminando propiedad
                        $usuario = Usuario::find($id);
                        $resultado = $usuario->eliminar();
                        if($resultado) {
                            header("Location: /admin/usuarios?resultado=3");
                        }
                    }
                }
            }
        }
    }
}