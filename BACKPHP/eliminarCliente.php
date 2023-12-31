<?php
//Cargar configuración previa de mail
require '../vendor/autoload.php';
require '../config/mail.php';

$configMail = new Mail();
$mail = $configMail->configurar();
$mail->Subject = 'Baja cliente - NutriBento';
$mail->Body = 'Su usuario ha sido dado de baja de nuestro sistema.'; // Definimos que el cuerpo del correo

//Configuración base de datos
require '../config/conexion.php';
require '../Clases/usuario.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];
    $clientEmail = $_POST['clientEmail'];

    $mail->addAddress($clientEmail); //Definimos el destinatario del correo

    $cliente = Usuario::findBy($con,'ID',$clientId);
    $respuesta = $cliente->delete();
    if($respuesta){
        try{
            $mail->send(); // Enviamos un correo notificando al usuario de su baja del sistema.
        }catch(Exception $e){
            //El correo no se pudo enviar
            //Hacer algo
        }
    
        // Si la eliminación se realiza con éxito, devuelve 'success'
        echo 'success';
    }else{
        echo 'Error: No se puede eliminar.';
    }
        
    
} else {
    echo 'Error: Método no válido.';
}
?>