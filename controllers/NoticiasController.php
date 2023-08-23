<?php
namespace Controllers;

use Model\Noticia;
use Model\Propiedad;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class NoticiasController {
    public static function entrada(Router $router) {
        $id=validarORedireccionar("/");
        $noticia = Noticia::find($id);
        $router->render("paginas/entrada",[
            "noticia" => $noticia
        ]);
    }
    public static function crear(Router $router) {
        if(!isAdmin()) {
            header("Location: /");
        }
        $noticia = new Noticia;
        $errores = Noticia::getAlertas();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            $noticia =  new Noticia($_POST);
            $noticia->idUser = $_SESSION["idUser"];
            //Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES["imagen"]["tmp_name"]) {
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                // Seteamos la imagen
                $noticia->setImagen($nombreImagen);
            }
            $errores = $noticia->validarErrores();
            if(empty($errores)) {
                //Creamos la carpeta para subir imagenes 
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardamos la imagen en el servidor 
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                //Guardamos la propiedad en la base de datos
                $resultado = $noticia->guardar();
                if($resultado) {
                    header("Location: /admin?resultado=1");
                    exit();
                }
            }
        }
        $router->render("admin/noticias/crear", [
            "noticia" => $noticia,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        if(!isAdmin()) {
            header("Location: /");
        }
        $id = validarORedireccionar("/admin");
        $noticia = Noticia::find($id);
        $errores = Noticia::getAlertas();
        // Este codigo se ejecuta despues de que el usuario envie el formulario
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $noticia->sincronizar($_POST);
            $noticia->fecha = date("Y/m/d");
            $errores = $noticia->validarErrores();
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES["imagen"]["tmp_name"]) {
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                // Seteamos la imagen
                $noticia->setImagen($nombreImagen);
            }
            if(empty($errores)) {
                if($_FILES["imagen"]["tmp_name"]) {
                    //Almacenamos la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                //  Actualizamos los datos
                $resultado = $noticia->guardar();
                if($resultado) {
                    header("Location: /admin?resultado=2");
                }
            }
        }
        $router->render("/admin/noticias/actualizar", [
            "noticia" => $noticia,
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
                    if($tipo === "noticia") {
                        //Eliminando propiedad
                        $noticia = Noticia::find($id);
                        $resultado = $noticia->eliminar();
                        if($resultado) {
                            header("Location: /admin?resultado=3");
                        }
                    }                
                }
            }
        }
    }
}