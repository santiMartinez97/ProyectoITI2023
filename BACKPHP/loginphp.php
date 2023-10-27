<?php
require '../config/conexion.php';
require '../Clases/clientecomun.php';
require '../Clases/clienteempresa.php';
require '../Clases/intentologin.php';

session_start();

$db = new DataBase();
$con = $db->conectar();

$email = $_POST["email"];
$pass = $_POST["pass"];

//Si el conteo es tres, el usuario no puede hacer login
if(loginBloqueado($con)){
    echo json_encode('Bloqueado');
}else{
    $usuario = Usuario::findBy($con,'Email',$email);

    //Buscamos si el email está registrado
    if($usuario){
        //Chequeamos si la contraseña es correcta
        if($usuario->checkPassword($pass)){
            //Chequeamos el tipo de usuario
            if($usuario->getUsuarioTipo() === 'Cliente'){
                $cliente = Cliente::findByID($con,$usuario->getID());
                if($cliente->getHabilitacion() == 'No habilitado'){
                    echo json_encode('No habilitado');
                }else{
                    echo json_encode('cliente');
                    $_SESSION['cliente'] = 'cliente';
                    $_SESSION['id'] = $cliente->getID();

                    $cliComun = ClienteComun::findByID($con, $cliente->getID());

                    if($cliComun){
                       
                       $_SESSION['nombre'] = $cliComun->getNombreCompleto();
                        $_SESSION['ClienteComun'] = 'ClienteComun';
                        
                    }else{
                        $cliEmpresa = ClienteEmpresa::findByID($con, $cliente->getID());
                        $_SESSION['nombre'] = $cliEmpresa->getNombreEmpresa();
                         $_SESSION['ClienteEmpresa'] = 'ClienteEmpresa';
                         
                    }
                }
            }else{
                asignarRolASesion($usuario->getUsuarioTipo());
            }
        }else{
            intentoFallido($con);
            echo json_encode('Email y/o contraseña incorrecto/s.');
        }
    }else{
        intentoFallido($con);
        echo json_encode('Email y/o contraseña incorrecto/s.');
    }
}

function asignarRolASesion($rol){
    switch($rol){
        case "Administracion":
            echo json_encode('admin');
            $_SESSION['admin'] = 'admin';
            $_SESSION['nombre'] = 'Administración';
            break;
        case "Gerente":
            echo json_encode('gerente');
            $_SESSION['gerente'] = 'gerente';
            $_SESSION['nombre'] = "Gerente";
            break;
         case "Informatico":
            echo json_encode('informatico');
            $_SESSION['informatico'] = 'informatico';
            $_SESSION['nombre'] = 'Informático';
            break;
         case "JefeCocina":
            echo json_encode('jefeCocina');
            $_SESSION['jefeCocina'] = 'jefeCocina';
            $_SESSION['nombre'] = 'Jefe de Cocina';
            break;
         case "AtencionPublico":
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

function loginBloqueado($con){
    $ip = getIpAddr();
    return Login::verificarIntentos($con,$ip);
}

function intentoFallido($con){
    $ip = getIpAddr();
    Login::insertarLogin($con,$ip);
}
