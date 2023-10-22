<?php
//Cargar configuración previa de mail
require '../vendor/autoload.php';
require '../config/mail.php';

$configMail = new Mail();
$mail = $configMail->configurar();
$mail->Subject = 'Habilitación - NutriBento';

//Configuración base de datos
require '../config/conexion.php';
require '../Clases/cliente.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];
    $clientStatus = $_POST['clientStatus'];
    $clientEmail = $_POST['clientEmail'];

    $mail->addAddress($clientEmail); //Definimos el destinatario del correo

    $cliente = Cliente::findByID($con,$clientId);
    $cliente->changeHabilitacion();
    $cliente->update();

    if($clientStatus == "true"){
        $mensaje = "Su usuario se encuentra habilitado para iniciar sesión en NutriBento.";
    }else{
        $mensaje = "Su usuario ha sido deshabilitado. No podrá iniciar sesión en NutriBento.";
    }

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
