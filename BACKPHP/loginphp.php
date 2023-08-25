<?php
require '../config/config.php';
require '../config/conexion.php';

//session_start();

$db = new DataBase();
$con = $db->conectar();

$email = $_POST["email"];
$pass = $_POST["pass"];

if(conteoIntentosLogin($con) == 3){
    echo json_encode('Bloqueado');
}else{
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
                $clienteID = $resultado["ID"];
                echo json_encode('cliente');
                $_SESSION['cliente'] = 'cliente';
                $_SESSION['id'] = $clienteID;

                $cliComun = $con->prepare("SELECT Nombre, Apellido FROM clientecomun WHERE ID = :id");
                $cliComun->bindParam(':id', $clienteID, PDO::PARAM_STR);
                $cliComun->execute();
                $subresultado = $cliComun->fetch(PDO::FETCH_ASSOC);

                if($subresultado){
                    $_SESSION['nombre'] = $subresultado["Nombre"]." ".$subresultado["Apellido"];
                }else{
                    $cliEmpresa = $con->prepare("SELECT NombreEmpresa FROM clienteempresa WHERE ID = :id");
                    $cliEmpresa->bindParam(':id', $clienteID, PDO::PARAM_STR);
                    $cliEmpresa->execute();
                    $subresultado = $cliEmpresa->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['nombre'] = $subresultado["NombreEmpresa"];
                }
            }
        }else{
            intentoFallido($con);
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
                asignarRolASesion($resultado["Rol"]);
            }else{
                intentoFallido($con);
                echo json_encode('Email y/o contraseña incorrecto/s.');
            }
        }else{
            intentoFallido($con);
            echo json_encode('Email y/o contraseña incorrecto/s.');
        }
    }
}

function asignarRolASesion($rol){
    switch($rol){
        case "Administración":
            echo json_encode('admin');
            $_SESSION['admin'] = 'admin';
            $_SESSION['nombre'] = 'Administración';
            break;
        case "Gerente":
            echo json_encode('gerente');
            $_SESSION['gerente'] = 'gerente';
            $_SESSION['nombre'] = "Gerente";
            break;
         case "Informático":
            echo json_encode('informatico');
            $_SESSION['informatico'] = 'informatico';
            $_SESSION['nombre'] = 'Informático';
            break;
         case "JefeCocina":
            echo json_encode('jefeCocina');
            $_SESSION['jefeCocina'] = 'jefeCocina';
            $_SESSION['nombre'] = 'Jefe de Cocina';
            break;
         case "AtenciónPúblico":
            echo json_encode('atencionPublico');
            $_SESSION['atencionPublico'] = 'atencionPublico';
            $_SESSION['nombre'] = 'Atención al Público';
            break; 
        default:
            echo json_encode('Error');
    }
}

function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
        return $ipAddr;
}

function conteoIntentosLogin($con){
    $ip = getIpAddr();
    $login_time = time()-30; //Especificar tiempo de bloqueo en segundos
    $intentos = $con->prepare("SELECT COUNT(*) AS total_count FROM intentos_login WHERE IP='$ip' AND Tiempo>$login_time");
    $intentos->execute();
    $contador = $intentos->fetch(PDO::FETCH_ASSOC);
    $contador = $contador['total_count'];
    return $contador;
}

function intentoFallido($con){
    $ip = $_SERVER['REMOTE_ADDR'];
    $login_time = time();
    $guardar = $con->prepare("INSERT INTO intentos_login SET IP='$ip', Tiempo=$login_time");
    $guardar->execute();
}
