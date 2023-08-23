<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\CitasController;
use Controllers\LoginController;
use Controllers\NoticiasController;
use Controllers\PaginasControllers;
use Controllers\PerfilController;
use Controllers\PropiedadController;
use Controllers\UsuariosController;
use MVC\Router;

$router = new Router();

//Zona pública
$router->get("/", [PaginasControllers::class, "index"]);
$router->get("/propiedades", [PaginasControllers::class, "propiedades"]);
$router->get("/blog", [PaginasControllers::class, "blog"]);
$router->get("/entrada", [NoticiasController::class, "entrada"]);
$router->get("/propiedad", [PropiedadController::class, "propiedad"]);
//Login y Autenticacion
$router->get("/login", [LoginController::class, "login"]);
$router->post("/login", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);
$router->get("/crear-cuenta", [LoginController::class, "crear"]);
$router->post("/crear-cuenta", [LoginController::class, "crear"]);

//Zona Privada
$router->get("/citaciones", [PaginasControllers::class, "citaciones"]);
$router->post("/citaciones", [PaginasControllers::class, "citaciones"]);
$router->get("/citaciones/actualizar", [PaginasControllers::class, "citacionesActualizar"]);
$router->post("/citaciones/actualizar", [PaginasControllers::class, "citacionesActualizar"]);
$router->post("/citaciones/eliminar", [PaginasControllers::class, "eliminarCita"]);

//Perfil del Usuario
$router->get("/perfil", [PerfilController::class, "index"]);
$router->post("/perfil", [PerfilController::class, "index"]);
$router->get("/perfil/actualizar", [PerfilController::class, "actualizar"]);
$router->post("/perfil/actualizar", [PerfilController::class, "actualizar"]);

//Zona de Administrador
$router->get("/admin", [AdminController::class, "index"]);
$router->post("/admin", [AdminController::class, "index"]);
//Administrador Propiedad
$router->get("/admin/propiedades/crear", [PropiedadController::class, "crear"]);
$router->post("/admin/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/admin/propiedades/actualizar", [PropiedadController::class, "actualizar"]);
$router->post("/admin/propiedades/actualizar", [PropiedadController::class, "actualizar"]);
$router->post("/admin/propiedades/eliminar", [PropiedadController::class, "eliminar"]);
//Administrador Noticias
$router->get("/admin/noticias/crear", [NoticiasController::class, "crear"]);
$router->post("/admin/noticias/crear", [NoticiasController::class, "crear"]);
$router->get("/admin/noticias/actualizar", [NoticiasController::class, "actualizar"]);
$router->post("/admin/noticias/actualizar", [NoticiasController::class, "actualizar"]);
$router->post("/admin/noticias/eliminar", [NoticiasController::class, "eliminar"]);
//Administrador Usuarios y Citas
$router->get("/admin/usuarios", [UsuariosController::class, "index"]);
$router->get("/admin/usuarios/crear", [UsuariosController::class, "crear"]);
$router->post("/admin/usuarios/crear", [UsuariosController::class, "crear"]);
$router->get("/admin/usuarios/actualizar", [UsuariosController::class, "actualizar"]);
$router->post("/admin/usuarios/actualizar", [UsuariosController::class, "actualizar"]);
$router->post("/admin/usuarios/eliminar", [UsuariosController::class, "eliminar"]);
//Citas
$router->get("/admin/citas/crear", [CitasController::class, "crear"]);
$router->post("/admin/citas/crear", [CitasController::class, "crear"]);
$router->get("/admin/citas/actualizar", [CitasController::class, "actualizar"]);
$router->post("/admin/citas/actualizar", [CitasController::class, "actualizar"]);
$router->post("/admin/citas/eliminar", [CitasController::class, "eliminar"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();