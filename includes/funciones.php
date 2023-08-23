<?php
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Funcion para comprobar que es admin
function isAdmin() {
    if(!isset($_SESSION)) {
        session_start();
    }
    if($_SESSION["rol"] === "admin") {
        return true;
    }
}

// Funcion para comprobar que el usuario ha iniciado sesion
function isAuth() {
    if(!isset($_SESSION)) {
        session_start();
    }
    if($_SESSION["login"]) {
        return true;
    }
}

//Mostrar las notificaciones de CRUD
function mostrarNotificacion($codigo) {
    $mensaje = "";
    switch($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

//Validar tipo de Contenido
function validarTipoContenido($tipo) {
    $tipos = ["noticia", "propiedad", "user", "admin"];
    return in_array($tipo, $tipos);
}

// Validamos que el id es un numero o direccionamos a la url que pongamos
function validarORedireccionar(string $url) {
    //Validar el id 
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: {$url}");
    }
    return $id;
}