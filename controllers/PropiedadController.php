<?php
namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController {
    public static function propiedad(Router $router) {
        $id = validarORedireccionar("/");
        $propiedad = Propiedad::find($id);
        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    public static function crear(Router $router) {
        if(!isAdmin()) {
            header("Location: /");
        }
        $propiedad = new Propiedad;
        $errores = Propiedad::getAlertas();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Creamos una instancia de propiedad
            session_start();
            $propiedad = new Propiedad($_POST);
            $propiedad->idUser = $_SESSION["idUser"];
            //Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES["imagen"]["tmp_name"]) {
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                // Seteamos la imagen
                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->validarErrores();

            if(empty($errores)) {
                //Creamos la carpeta para subir imagenes 
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardamos la imagen en el servidor 
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                //Guardamos la propiedad en la base de datos
                $resultado = $propiedad->guardar();
                if($resultado) {
                    header("Location: /admin?resultado=1");
                    exit();
                }
            }
        }
        $router->render("admin/propiedades/crear", [
            "propiedad" => $propiedad,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        if(!isAdmin()) {
            header("Location: /");
        }
        $id = validarORedireccionar("/admin");
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getAlertas();
        // Este codigo se ejecuta despues de que el usuario envie el formulario
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $propiedad->sincronizar($_POST);
            $errores = $propiedad->validarErrores();
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES["imagen"]["tmp_name"]) {
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
                // Seteamos la imagen
                $propiedad->setImagen($nombreImagen);
            }
            if(empty($errores)) {
                if($_FILES["imagen"]["tmp_name"]) {
                    //Almacenamos la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                //  Actualizamos los datos
                $resultado = $propiedad->guardar();
                if($resultado) {
                    header("Location: /admin?resultado=2");
                }
            }
        }
        $router->render("admin/propiedades/actualizar", [
            "propiedad" => $propiedad,
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
                    if($tipo === "propiedad") {
                        //Eliminando propiedad
                        $propiedad = Propiedad::find($id);
                        $resultado = $propiedad->eliminar();
                        if($resultado) {
                            header("Location: /admin?resultado=3");
                        }
                    }                
                }
            }
        }
    }
}