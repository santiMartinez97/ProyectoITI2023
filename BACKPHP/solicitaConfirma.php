<?php
require '../vendor/autoload.php';
require '../config/mail.php';
require '../Clases/cliente.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$configMail = new Mail();
$mail = $configMail->configurar();
$mail->Subject = 'Solicitar habilitacion - NutriBento';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];
    $adminMail= "pabloyarzon2004@gmail.com";

    $mail->addAddress($adminMail);

    $mensaje = 'El usuario de ID:'.$clientID.' ha solicitado su habilitacion';
   
    try{
        $mail->Body = $mensaje; // Definimos que el cuerpo del correo será el mensaje previamente definido.
        $mail->send(); // Enviamos el correo.
    }catch(Exception $e){
        //No se pudo enviar el correo
        //Hacer algo
    }

    // Si la actualización se realiza con éxito, devuelve 'success'
    echo 'success';
} else {
    echo 'Error: Método no válido.';
}

?>