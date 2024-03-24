<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $nombre;
    public $correo;
    public $token;

    public function __construct($nombre, $correo, $token)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->token = $token;
    }

    public function sendToken()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->SMTPAuth = true;
        $phpmailer->Host = $_ENV['EMAIL_HOST'];
        $phpmailer->Port = $_ENV['EMAIL_PORT'];
        $phpmailer->Username = $_ENV['EMAIL_USER'];
        $phpmailer->Password = $_ENV['EMAIL_PASSWORD'];

        $phpmailer->setFrom('cuentas@modal.com');
        $phpmailer->addAddress('cuentas@modal.com', 'appModal');
        $phpmailer->Subject = 'Confima tu cuenta';
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . ' confirma tu cuena ingresando al siguiente enlace</strong></p>';
        $contenido .= '<a href="' . $_ENV['DOMAIN_URL'] . '/confirmar-cuenta?token=' . $this->token . '">Confirmar Cuenta</a>';
        $contenido .= '</html>';
        $phpmailer->Body = $contenido;

        $phpmailer->send();
    }
}
