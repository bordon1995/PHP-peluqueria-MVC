<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tableName = 'cliente';
    protected static $tablaDB = ['id', 'nombre', 'apellido', 'telefono', 'correo', 'password', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $correo;
    public $password;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? null;
    }

    public function hashearPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function setToken()
    {
        $this->token = uniqid();
    }

    public static function validarPassword($passwordInput, $passwordDB)
    {
        $resultado = password_verify($passwordInput, $passwordDB);

        if ($resultado === false) {
            self::$validacion['passgord'] = 'El Password ingresado es incorrecto';
        }
    }

    public static function startSession($object)
    {
        session_start();
        $_SESSION['id'] = $object->id;
        $_SESSION['nombre'] = $object->nombre;
        $_SESSION['login'] = true;

        header('Location:/admin');
    }

    public static function validarUsuario($password, $usuario)
    {
        if ($usuario->confirmado === '1') {
            self::validarPassword($password, $usuario->password);
        } else {
            self::$validacion['token'] = 'Tu cuenta no esta confirmada';
        };
    }
}
