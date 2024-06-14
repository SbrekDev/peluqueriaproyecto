<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    //asd

    public $email;
    public $nombre;
    public $token;

    public function __construct( $nombre, $email, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        //crear el obj email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirmá tu cuenta';

        // set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . ' </strong> Has creado tu cuenta en AppSalon, debes confirmarla presionando el siguiente enlace</p>';
        $contenido .= '<p>Presiona aquí: <a href="' . $_ENV["APP_URL"] . '/confirmar-cuenta?token='. $this->token . '">Confirmar Cuenta</a><p>';
        $contenido .= '<p>Si tu no solicitaste esta cuenta, puedes ignorar este mensaje.</p>';
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // enviar el email

        $mail->send();

    }

    public function enviarInstrucciones(){
                //crear el obj email
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Port = $_ENV['EMAIL_PORT'];
                $mail->Username = $_ENV['EMAIL_USER'];
                $mail->Password = $_ENV['EMAIL_PASSWORD'];
        
                $mail->setFrom('cuentas@appsalon.com');
                $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
                $mail->Subject = 'Restablecé tu contraseña';
        
                // set html
                $mail->isHTML(TRUE);
                $mail->CharSet = 'UTF-8';
        
                $contenido = '<html>';
                $contenido .= '<p><strong>Hola ' . $this->nombre . ' </strong> Has solicitado reestablecer tu contraseña. Aquí tienes el enlace para hacerlo.</p>';
                $contenido .= '<p>Presiona aquí: <a href="' . $_ENV["APP_URL"] . '/recuperar?token='. $this->token . '">REESTABLECER</a><p>';
                $contenido .= '<p>Si tu no solicitaste esta cuenta, puedes ignorar este mensaje.</p>';
                $contenido .= '</html>';
                $mail->Body = $contenido;
        
                // enviar el email
        
                $mail->send();
    }
}