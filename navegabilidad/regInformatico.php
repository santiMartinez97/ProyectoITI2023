<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email= $_POST['email'];
    $password= $_POST['password'];
    $rol= $_POST['rol'];

    $hashedPass = password_hash($password,PASSWORD_BCRYPT);
    
    $insertarUsuario = $con->prepare("INSERT INTO usuario (Email, Contrasenia, Rol) VALUES (:email, :passHash, :rol)");
    $insertarUsuario->bindParam(':email', $email, PDO::PARAM_STR);
    $insertarUsuario->bindParam(':passHash', $hashedPass, PDO::PARAM_STR);
    $insertarUsuario->bindParam(':rol', $rol, PDO::PARAM_STR);
    $insertarUsuario->execute();
    }
    else {
        echo json_encode("El email ya está en uso.");
    }

?>