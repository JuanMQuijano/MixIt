<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\CarritoController;
use Controllers\DashboardController;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();
$router->get('/', [LoginController::class, 'index']);

//auth
$router->get('/iniciar-sesion', [LoginController::class, 'iniciar_sesion']);
$router->post('/iniciar-sesion', [LoginController::class, 'iniciar_sesion']);

$router->get('/cerrar-sesion', [LoginController::class, 'cerrar_sesion']);
$router->post('/cerrar-sesion', [LoginController::class, 'cerrar_sesion']);

$router->get('/crear-cuenta', [LoginController::class, 'registrar']);
$router->post('/crear-cuenta', [LoginController::class, 'registrar']);

$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);


//DASHBOARD PRENDAS
$router->get('/mis-prendas', [DashboardController::class, 'index']);
$router->post('/mis-prendas', [DashboardController::class, 'index']);

$router->get('/crear-publicacion', [DashboardController::class, 'crear_publicacion']);
$router->post('/crear-publicacion', [DashboardController::class, 'crear_publicacion']);

$router->get('/actualizar-publicacion', [DashboardController::class, 'actualizar_publicacion']);
$router->post('/actualizar-publicacion', [DashboardController::class, 'actualizar_publicacion']);

//Carrito
$router->get('/carrito', [CarritoController::class, 'index']);
$router->post('/carrito', [CarritoController::class, 'index']);

$router->get('/prenda', [CarritoController::class, 'prenda']);
$router->post('/prenda', [CarritoController::class, 'prenda']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
