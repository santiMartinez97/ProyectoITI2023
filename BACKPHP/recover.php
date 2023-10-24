<?php
require '../vendor/autoload.php';
require '../config/conexion.php';
require '../config/mail.php';
require '../Clases/usuario.php';
require '../Clases/tokenPassword.php';

$db = new DataBase();
$con = $db->conectar();

$email = $_POST['email'];

$usuario = Usuario::findBy($con,'Email',$email);

if($usuario){
    $usuarioId = $usuario->getID();
    $token = bin2hex(random_bytes(16)); //Generamos un token
    $tokenHash = hash('sha256',$token); //Hasheamos el token para extra seguridad

    $objToken = new TokenRecuperacion($con);
    $objToken->generarToken($usuarioId,$tokenHash); //Guardamos el token en la BDD

    try{
        $configMail = new Mail();
        $mail = $configMail->configurar();

        $mail->Subject = 'Resetear contraseña - NutriBento';
        $mail->Body = '<p>Se ha solicitado resetear la contraseña de su usuario en NutriBento.</p>
        <p>Si usted no ha solicitado resetear la contraseña, ignore este correo.</p>
        <p>Ingrese al siguiente enlace para poder ingresar una nueva contraseña: <a href="localhost/ProyectoITI2023/resetearPassword.php?token='.$token.'">Click aquí</a></p>'; // Definimos el cuerpo del correo
        
        // RECORDAR MODIFICAR EL ENLACE

        $mail->addAddress($email); //Definimos el destinatario del correo
        $mail->send(); // Enviamos un correo notificando al usuario de su registro.
    }catch(Exception $e){
        //No se pudo enviar el correo
    }

    echo json_encode('success');
}else{
    echo json_encode('not found');
}
?>