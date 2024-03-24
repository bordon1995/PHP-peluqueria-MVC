<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use MVC\Router;
use Controllers\ClienteController;
use Controllers\ServiciosController;

$router = new Router();
//AUTH
$router->get('/', [ClienteController::class, 'login']);
$router->post('/', [ClienteController::class, 'login']);

$router->get('/registro', [ClienteController::class, 'registro']);
$router->post('/registro', [ClienteController::class, 'registro']);

$router->get('/email-enviado', [ClienteController::class, 'enviado']);
$router->get('/confirmar-cuenta', [ClienteController::class, 'confirmar']);
$router->get('/confirmar-error', [ClienteController::class, 'confirmar']);

$router->get('/resetPassword', [ClienteController::class, 'resetPassword']);
$router->post('/resetPassword', [ClienteController::class, 'resetPassword']);

//SESSION
$router->get('/admin', [ServiciosController::class, 'index']);
$router->post('/admin', [ServiciosController::class, 'index']);

$router->get('/mis-citas', [ServiciosController::class, 'eliminar']);
$router->post('/mis-citas', [ServiciosController::class, 'eliminar']);

//API-SERVICIOS
$router->get('/api/servicios', [ApiController::class, 'all']);
$router->post('/api/cita', [ApiController::class, 'save']);

$router->get('/logoaut', [ClienteController::class, 'logoaut']);

$router->urlSession();
