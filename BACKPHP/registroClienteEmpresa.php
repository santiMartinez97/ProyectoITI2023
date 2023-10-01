<?php
//Cargar configuración previa de mail
require '../vendor/autoload.php';
require '../config/mail.php';

$configMail = new Mail();
$mail = $configMail->configurar();
$mail->Subject = 'Registro - NutriBento';
$mail->Body = 'Bienvenido a NutriBento, sus datos de registro serán revisados por Administración. Será notificado si es habilitado.'; // Definimos que el cuerpo del correo

//Configuración base de datos
require '../config/conexion.php';
require '../Clases/clienteempresa.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$rut= $_POST['rut'];
$email= $_POST['email'];
$password= $_POST['password'];
$nombreEmpresa= $_POST['empresa'];
$telefono= $_POST['telefono'];
$calle= $_POST['calle'];
$numero= $_POST['numero'];
$esquina= $_POST['esquina'];
$barrio= $_POST['barrio'];
$menu = $_POST['dieta'];
ob_clean(); //Limpio advertencia por posible null en dieta

//Buscamos si el email está repetido
$resultadoEmail = Usuario::findBy($con,'Email',$email);

//Buscamos si el rut está repetido
$resultadoRut = ClienteEmpresa::findByRUT($con,$rut);

if(!$resultadoEmail && !$resultadoRut){
    $dirCompleta = $barrio.' '.$calle.' '.$numero.' '.$esquina;

    $clienteEmpresa = new ClienteEmpresa($con,$email,$password,$dirCompleta,'No habilitado',$rut,$nombreEmpresa);
    $clienteEmpresa->create();
    $clienteEmpresa->agregarTelefono($telefono);
    $clienteEmpresa->asociarDieta($menu);

    echo json_encode("Completado");

    try{
        $mail->addAddress($email); //Definimos el destinatario del correo
        $mail->send(); // Enviamos un correo notificando al usuario de su registro.
    }catch(Exception $e){
        //No se pudo enviar el correo
        //Hacer algo
    }
    
}else if($resultadoEmail && $resultadoRut){
    echo json_encode("Email y RUT repetidos");
}else if($resultadoEmail){
    echo json_encode("Email repetido");
}else{
    echo json_encode("RUT repetido");
}

}