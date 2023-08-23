<?php

namespace Controllers;

use Model\Cita;
use Model\UsuarioLogin;
use MVC\Router;

class CitasController
{
    public static function crear(Router $router)
    {
        if(!isAdmin()) {
            header("Location: /");
        }
        $usuarios = UsuarioLogin::whereAll("rol", "user");
        $cita = new Cita;
        $errores = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita->sincronizar($_POST);
            $errores = $cita->validar();
            if (empty($errores)) {
                $resultado = $cita->guardar();
                if ($resultado["resultado"]) {
                    header("Location: /admin/usuarios?resultado=1");
                }
            }
        }
        $router->render("admin/citas/crear", [
            "usuarios" => $usuarios,
            "cita" => $cita,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        if(!isAdmin()) {
            header("Location: /");
        }
        $id = validarORedireccionar("/admin");
        $cita = Cita::find($id);
        $usuarioLogin = UsuarioLogin::where("idUser", $cita->idUser);
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita->sincronizar($_POST);
            $errores = $cita->validar();
            if(empty($errores)) {
                $resultado = $cita->guardar();
                if($resultado) {
                    header("Location: /admin/usuarios?resultado=2");
                }
            }
        }
        $errores = Cita::getAlertas();
        $router->render("admin/citas/actualizar", [
            "cita" => $cita,
            "usuarioLogin" => $usuarioLogin,
            "errores" => $errores
        ]);
    }

    public static function eliminar() {
        if(!isAdmin()) {
            header("Location: /");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $cita = Cita::find($id);
            if($cita) {
                $resultado = $cita->eliminar();
                if($resultado) {
                    header("Location: /admin/usuarios?resultado=3");
                }
            } else {
                header("Location: /404");
            }
        }
    }
}
