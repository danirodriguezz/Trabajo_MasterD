<?php
namespace Controllers;

use Model\Noticia;
use Model\Propiedad;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController {
    public static function index(Router $router) {
        if(!isAdmin()) {
            header("Location: /");
        }
        $propiedades = Propiedad::all();
        $noticias = Noticia::all();
        $resultado = $_GET["resultado"] ?? null;
        $router->render("/admin/index", [
            "propiedades" => $propiedades,
            "noticias" => $noticias,
            "resultado" => $resultado
        ]);
    }

}
