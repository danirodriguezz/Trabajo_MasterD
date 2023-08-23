<?php 
namespace Controllers;

use Model\Cita;
use Model\Noticia;
use Model\Propiedad;
use MVC\Router;

class PaginasControllers {
    public static function index(Router $router) {
        $inicio = true;
        $propiedades = Propiedad::get(3);
        $noticias = Noticia::get(2);
        $router->render("paginas/index", [
            "inicio" => $inicio,
            "propiedades" => $propiedades,
            "noticias" => $noticias
        ]);
    }

    public static function blog(Router $router) {
        $noticias = Noticia::all();
        $router->render("paginas/blog", [
            "noticias" => $noticias
        ]);
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();
        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }

    public static function citaciones(Router $router) {
        if(!isAuth()) {
            header("Location: /login");
        }
        $mensaje = false;
        $errores = [];
        $cita = new Cita;
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita->sincronizar($_POST);
            $errores = $cita->validar();
            if(empty($errores)) {
                session_start();
                $cita->idUser = $_SESSION["idUser"];
                $resultado = $cita->guardar();
                if($resultado["resultado"]) {
                    header("Location: /perfil?resultado=1");
                }
            }
        }
        $router->render("paginas/citaciones", [
            "mensaje" => $mensaje,
            "errores" => $errores,
            "cita" => $cita
        ]);
    }

    public static function citacionesActualizar(Router $router) {
        if(!isAuth()) {
            header("Location: /");
        }
        $id = validarORedireccionar("/");
        $cita = Cita::find($id);
        $errores = Cita::getAlertas();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita->sincronizar($_POST);
            $errores = $cita->validar();
            if(empty($errores)) {
                $resultado = $cita->guardar();
                if($resultado) {
                    header("Location: /perfil?resultado=2");
                }
            }
        }
        $router->render("perfil/actualizar-cita", [
            "cita" => $cita,
            "errores" => $errores
        ]);
    }

    public static function eliminarCita() {
        if(!isAuth()) {
            header("Location: /");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $cita = Cita::find($id);
            if($cita) {
                $resultado = $cita->eliminar();
                if($resultado) {
                    header("Location: /perfil?resultado=3");
                }
            } else {
                header("Location: /404");
            }
        }
    }
}