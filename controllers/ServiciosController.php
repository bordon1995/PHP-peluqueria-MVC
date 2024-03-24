<?php

namespace Controllers;

use Model\MisCitas;
use MVC\Router;

class ServiciosController
{
    public static function index(Router $router)
    {
        $router->render('/admin', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
        ]);
    }

    public static function eliminar(Router $router)
    {
        $citas = MisCitas::getCitas();
        if (!$citas) {
            MisCitas::setValidacion('cita', 'No tienes citas');
        };

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            MisCitas::deleteDB('citas_id', $_POST['servicio']);
            header('Location:/mis-citas');
        }

        $router->render('/editar', [
            'validacion' => MisCitas::getValidacion(),
            'citas' => $citas
        ]);
    }
}
