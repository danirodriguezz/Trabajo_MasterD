<?php
namespace Controllers;

use Model\ActiveRecord;
use Model\Usuario;
use Model\UsuarioLogin;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        if(isAuth()) {
            header("Location: /perfil");
        }
        //Creamos el array de alertas
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new UsuarioLogin($_POST);
            $errores = $auth->validar();
            if(empty($errores)){
                $usuario_login = UsuarioLogin::where("usuario", $auth->usuario);
                if($usuario_login) {
                    //verificamos el password
                    if($usuario_login->verificarPassword($auth->password)) {
                        // Si la contraseña es correcta autenticamos el usuario
                        $usuario = Usuario::find($usuario_login->idUser);
                        session_start();
                        $_SESSION["id"] = $usuario_login->id;
                        $_SESSION["idUser"] = $usuario->id;
                        $_SESSION["usuario"] = $usuario_login->usuario;
                        $_SESSION["login"] = true;
                        //Redireccionamiento
                        if($usuario_login->rol === "admin") {
                            $_SESSION["rol"] = $usuario_login->rol ?? null;
                            header("Location: /admin");
                        } else {
                            header("Location: /citaciones");
                        }
                    }
                } else {
                    UsuarioLogin::setAlerta("error", "Usuario o contraseña invalidos");
                }
            }
        }
        $errores = UsuarioLogin::getAlertas();
        $router->render("auth/login", [
            "errores" => $errores
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header("Location: /");
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
                        header("Location: /login?resultado=true");
                    }
                }
            }
        }
        $router->render("auth/crear-cuenta", [
            "errores" => $errores,
            "usuario" => $usuario,
            "usuario_login" => $usuario_login
        ]);
    }
}