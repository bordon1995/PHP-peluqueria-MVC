<?php

namespace Controllers;

use Classes\Email;
use Model\Cliente;
use MVC\Router;

class ClienteController
{
    public static function registro(Router $router)
    {
        $cliente = new Cliente();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente::validarFormulario($_POST);

            if (empty(Cliente::getValidacion())) {
                $cliente->setAtributos($_POST);
                $validacionCliente = $cliente->getUsuario('correo', $cliente->correo);

                if ($validacionCliente) {
                    Cliente::setValidacion('gmail', 'El email ingresado ya se encuenrta registrado');
                } else {
                    $cliente->hashearPassword();
                    $cliente->setToken();
                    $email = new Email($cliente->nombre, $cliente->correo, $cliente->token);
                    $email->sendToken();
                    $array = $cliente->sanitizarAtributos();
                    $resultado = Cliente::guardarDB($array);

                    if ($resultado) {
                        header('Location:/email-enviado');
                    }
                };
            };
        };

        $router->render('/auth/registro', [
            'cliente' => $cliente,
            'validacion' => Cliente::getValidacion()
        ]);
    }

    public static function enviado(Router $router)
    {
        $router->render('/auth/emailEnviado', []);
    }

    public static function confirmar(Router $router)
    {
        $token = $_GET['token'];
        $usuario = Cliente::getUsuario('token', $token);

        if ($usuario) {
            $usuario->confirmado = '1';
            $usuario->token = null;
            $resultado = Cliente::actualizarDB($usuario);
            if ($resultado) {
                $router->render('/auth/confirmarToken', [
                    'login_form' => 'login_form'
                ]);
            };
        } else {

            $router->render('/auth/confirmarError', [
                'login_form' => 'login_form'
            ]);
        }
    }

    public static function login(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Cliente::validarFormulario($_POST);

            if (empty(Cliente::getValidacion())) {
                $usuario = Cliente::getUsuario('correo', $_POST['correo']);

                if ($usuario) {
                    Cliente::validarUsuario($_POST['password'], $usuario);
                } else {
                    Cliente::setValidacion('email', 'El email ingresado no se encuentra en la base de datos');
                };

                if (empty(Cliente::getValidacion())) {
                    Cliente::startSession($usuario);
                }
            };
        }


        $router->render('/auth/login', [
            'validacion' => Cliente::getValidacion(),
            'login_form' => 'login_form'
        ]);
    }

    public static function resetPassword(Router $router)
    {
        $router->render('/auth/resetPassword', [
            'login_form' => 'login_form'
        ]);
    }

    public static function logoaut()
    {

        session_start();

        $_SESSION = [];

        header('Location:/login');
    }
}
