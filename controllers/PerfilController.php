<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Model\Cita;


class PerfilController {
    public static function index(Router $router) {
        if(!isAuth()) {
            header("Location: /");
        }
        session_start();
        $idUser = $_SESSION["idUser"];
        //Buscamos el usuario en la base de datos
        $usuario = Usuario::find($idUser);
        //Formateamos la Fecha para que sea en un formato mas legible
        $timestamp = strtotime($usuario->fecha_nacimiento);
        $fechaFormateada = date("d-m-Y", $timestamp);
        // Obtenemos las Citas Que tenga el Usuario
        $citas = Cita::whereAll("idUser", $usuario->id);
        //Enviamos todos los datos a la vista
        $router->render("perfil/index", [
            "usuario" => $usuario,
            "fechaFormateada" => $fechaFormateada,
            "citas" => $citas
        ]);
    }
    public static function actualizar(Router $router) {
        if(!isAuth()) {
            header("Location: /");
        }
        $errores = [];
        session_start();
        $idUser = $_SESSION["idUser"];
        $usuario = Usuario::find($idUser);
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizar($_POST);
            $usuario->id = $idUser;
            $errores = $usuario->validar();
            if(empty($errores)) {
                $resultado = $usuario->guardar();
                if($resultado) {
                    header("Location: /perfil?resultado=2");
                }
            }
        }

        $router->render("perfil/actualizar",[
            "usuario" => $usuario,
            "errores" => $errores
        ]);
    } 
}