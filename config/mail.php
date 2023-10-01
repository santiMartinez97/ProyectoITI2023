<?php

//Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Cargar autoload de Composer
require '../vendor/autoload.php';

class Mail {
    public function configurar(){
        //Creando la instancia, al pasar true se habilitan excepciones
        $mail = new PHPMailer(true);

        //Configuración del sevidor de correo
        $mail->SMTPDebug = 0;                                       //Modo del debug
        $mail->isSMTP();                                            //Enviar usando SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Servidor SMTP
        $mail->SMTPAuth   = true;                                   //Habilitar autentificación de SMTP
        $mail->SMTPSecure = 'tls';
        $mail->Username   = 'nutribento1@gmail.com';                //SMTP correo
        $mail->Password   = 'PREGUNTAR';                     //SMTP contraseña
        $mail->Port       = 587;                                    //Puerto TCP
        $mail->CharSet = 'UTF-8';                                   //Habilita caracteres especiales
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));

        //Remitente
        $mail->setFrom('nutribento1@gmail.com', 'Administración - NutriBento');
        $mail->addReplyTo('nutribento1@gmail.com', 'Administración - NutriBento');

        //Contenido del correo
        $mail->isHTML(true);                                  //Cambia el formato a HTML
    
        return $mail;
    }
}

?>