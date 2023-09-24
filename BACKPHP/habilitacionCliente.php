<?php
//Cargar configuración previa de mail
require '../vendor/autoload.php';
require '../config/mail.php';

$configMail = new Mail();
$mail = $configMail->configurar();
$mail->Subject = 'Habilitación - NutriBento';

//Configuración base de datos
require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];
    $clientStatus = $_POST['clientStatus'];
    $clientEmail = $_POST['clientEmail'];

    $mail->addAddress($clientEmail); //Definimos el destinatario del correo

    if($clientStatus == "true"){
        $cliente = $con->prepare("UPDATE cliente SET Habilitacion = 'Habilitado' WHERE ID = ?");
        $cliente-> execute([$clientId]);
        
        $mensaje = "Su usuario se encuentra habilitado para iniciar sesión en NutriBento.";
    }else{
        $cliente = $con->prepare("UPDATE cliente SET Habilitacion = 'No habilitado' WHERE ID = ?");
        $cliente-> execute([$clientId]);

        $mensaje = "Su usuario ha sido deshabilitado. No podrá iniciar sesión en NutriBento.";
    }

    $mail->Body = $mensaje; // Definimos que el cuerpo del correo será el mensaje previamente definido.
    $mail->send(); // Enviamos el correo.

    // Si la actualización se realiza con éxito, devuelve 'success'
    echo 'success';
} else {
    echo 'Error: Método no válido.';
}
?>
