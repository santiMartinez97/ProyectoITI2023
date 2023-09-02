<?php

require '../config/conexion.php';

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
$cuentas = $con->prepare("SELECT Email from usuario WHERE Email = :email UNION SELECT Email from cliente WHERE Email = :emaill ORDER BY 1");
$cuentas->bindParam(':email', $email, PDO::PARAM_STR);
$cuentas->bindParam(':emaill', $email, PDO::PARAM_STR);
$cuentas->execute();
$resultadoEmail = $cuentas->fetch(PDO::FETCH_ASSOC);

//Buscamos si el rut está repetido
$ruts = $con->prepare("SELECT RUT from clienteempresa WHERE RUT = :rut");
$ruts->bindParam(':rut', $rut, PDO::PARAM_STR);
$ruts->execute();
$resultadoRut = $ruts->fetch(PDO::FETCH_ASSOC);

if(!$resultadoEmail && !$resultadoRut){
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

    $insertarClienteEmpresa = $con->prepare("INSERT INTO clienteempresa VALUES ($IDcliente, :rut, :nombre)");
    $insertarClienteEmpresa->bindParam(':rut', $rut, PDO::PARAM_STR);
    $insertarClienteEmpresa->bindParam(':nombre', $nombreEmpresa, PDO::PARAM_STR);
    $insertarClienteEmpresa->execute();

    $insertarTelefono= $con->prepare("INSERT INTO clientetelefono VALUES ($IDcliente, :telefono)");
    $insertarTelefono->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $insertarTelefono->execute();

    echo json_encode("Completado");
}else if($resultadoEmail && $resultadoRut){
    echo json_encode("Email y RUT repetidos");
}else if($resultadoEmail){
    echo json_encode("Email repetido");
}else{
    echo json_encode("RUT repetido");
}

}