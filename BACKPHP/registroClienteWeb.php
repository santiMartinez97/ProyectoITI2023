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

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$ci= $_POST['ci'];
$email= $_POST['email'];
$password= $_POST['password'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$telefono= $_POST['telefono'];
$calle= $_POST['calle'];
$numero= $_POST['numero'];
$esquina= $_POST['esquina'];
$barrio= $_POST['barrio'];
$menu = $_POST['dieta'];
ob_clean(); //Limpio advertencia por posible null en dieta

//Buscamos si el email está repetido
$cuentas = $con->prepare("SELECT Email from usuario WHERE Email = :email UNION SELECT Email from cliente WHERE Email = :emaill ORDER BY 1");
$cuentas->bindParam(':email', $email, PDO::PARAM_STR);
$cuentas->bindParam(':emaill', $email, PDO::PARAM_STR);
$cuentas->execute();
$resultadoEmail = $cuentas->fetch(PDO::FETCH_ASSOC);

//Buscamos si la cedula está repetida
$cedulas = $con->prepare("SELECT CI from clientecomun WHERE CI = :ci");
$cedulas->bindParam(':ci', $ci, PDO::PARAM_STR);
$cedulas->execute();
$resultadoCi = $cedulas->fetch(PDO::FETCH_ASSOC);

if(!$resultadoEmail && !$resultadoCi){
    //Obtenemos el tipo de dieta
    $dieta = $con->prepare("SELECT Tipo FROM dieta WHERE ID = :dietaid");
    $dieta->bindParam(':dietaid', $menu, PDO::PARAM_STR);
    $dieta->execute();
    $unaDieta = $dieta->fetch(PDO::FETCH_ASSOC);
    if($unaDieta){
        $nombreDieta = $unaDieta["Tipo"];
    } else{
        $nombreDieta = null;
    }

    $hashedPass = password_hash($password,PASSWORD_BCRYPT);
    $dirCompleta = $barrio.' '.$calle.' '.$numero.' '.$esquina;

    $insertarCliente = $con->prepare("INSERT INTO cliente (Email, Contrasenia, DireccionCompleta, Dieta) VALUES (:email, :passHash, :direccion, :dieta)");
    $insertarCliente->bindParam(':email', $email, PDO::PARAM_STR);
    $insertarCliente->bindParam(':passHash', $hashedPass, PDO::PARAM_STR);
    $insertarCliente->bindParam(':direccion', $dirCompleta, PDO::PARAM_STR);
    $insertarCliente->bindParam(':dieta', $nombreDieta, PDO::PARAM_STR);
    $insertarCliente->execute();

    $obtenerID = $con->prepare("SELECT ID FROM cliente WHERE Email = :email");
    $obtenerID->bindParam(':email', $email, PDO::PARAM_STR);
    $obtenerID->execute();
    $unID = $obtenerID->fetch(PDO::FETCH_ASSOC);
    $IDcliente = $unID["ID"];

    $insertarClienteWeb = $con->prepare("INSERT INTO clientecomun VALUES ($IDcliente, :ci, :nombre, :apellido)");
    $insertarClienteWeb->bindParam(':ci', $ci, PDO::PARAM_STR);
    $insertarClienteWeb->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $insertarClienteWeb->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $insertarClienteWeb->execute();

    $insertarTelefono= $con->prepare("INSERT INTO clientetelefono VALUES ($IDcliente, :telefono)");
    $insertarTelefono->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $insertarTelefono->execute();

    echo json_encode("Completado");
    
    $mail->addAddress($email); //Definimos el destinatario del correo
    $mail->send(); // Enviamos un correo notificando al usuario de su registro.
}else if($resultadoEmail && $resultadoCi){
    echo json_encode("Email y cedula repetidos");
}else if($resultadoEmail){
    echo json_encode("Email repetido");
}else{
    echo json_encode("Cedula repetida");
}

}
?>