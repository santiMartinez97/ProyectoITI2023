<?php
require '../config/config.php';
require '../config/conexion.php';

//session_start();

$db = new DataBase();
$con = $db->conectar();

$email = $_POST["email"];
$pass = $_POST["pass"];

$cliente = $con->prepare("SELECT ID, Contrasenia, Habilitacion FROM cliente WHERE Email = :email");
$cliente->bindParam(':email', $email, PDO::PARAM_STR);
$cliente->execute();
$resultado = $cliente->fetch(PDO::FETCH_ASSOC);

if($resultado){
    $hashedPass = $resultado["Contrasenia"];
    if(password_verify($pass, $hashedPass)){
        if($resultado["Habilitacion"] == "No habilitado"){
            echo json_encode('No habilitado');
        }else{
            echo json_encode('cliente');
            $_SESSION['cliente'] = 'cliente';
        }
    }else{
        echo json_encode('Email y/o contraseña incorrecto/s.');
    }
}else{
    $usuario = $con->prepare("SELECT Contrasenia, Rol FROM usuario WHERE Email = :email");
    $usuario->bindParam(':email', $email, PDO::PARAM_STR);
    $usuario->execute();
    $resultado = $usuario->fetch(PDO::FETCH_ASSOC);

    if($resultado){
        $hashedPass = $resultado["Contrasenia"];
        if(password_verify($pass, $hashedPass)){
            switch($resultado["Rol"]){
                case "Administración":
                    echo json_encode('admin');
                    $_SESSION['admin'] = 'admin';
                    break;
                case "Gerente":
                    echo json_encode('gerente');
                    $_SESSION['gerente'] = 'gerente';
                    break;
                 case "Informático":
                    echo json_encode('informatico');
                    $_SESSION['informatico'] = 'informatico';
                    break;
                 case "JefeCocina":
                    echo json_encode('jefeCocina');
                    $_SESSION['jefeCocina'] = 'jefeCocina';
                    break;
                 case "AtenciónPúblico":
                    echo json_encode('atencionPublico');
                    $_SESSION['atencionPublico'] = 'atencionPublico';
                    break; 
                default:
                    echo json_encode('Error');
            }
        }else{
            echo json_encode('Email y/o contraseña incorrecto/s.');
        }
    }else{
        echo json_encode('Email y/o contraseña incorrecto/s.');
    }
}

?>