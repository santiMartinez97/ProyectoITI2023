<?php

require '../Clases/clientecomun.php';

//Configuración base de datos
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ci= $_POST['ci'];
    $nombre= $_POST['nombre'];
    $apellido= $_POST['apellido'];
    $telefono= $_POST['telefono'];
    $calle= $_POST['calle'];
    $numero= $_POST['numero'];
    $esquina= $_POST['esquina'];
    $barrio= $_POST['barrio'];
    
    //Buscamos si la cedula está repetida
    $resultadoCi = ClienteComun::findByCI($con,$ci);
    
    if(!$resultadoCi){
        $dirCompleta = $barrio.'-'.$calle.'-'.$numero.'-'.$esquina;
    
        $clienteComun = new ClienteComun($con,null,null,$dirCompleta,'No habilitado',$ci,$nombre,$apellido);
        $clienteComun->create();
        $clienteComun->agregarTelefono($telefono);
    
        echo json_encode("Completado");
        
    }else{
        echo json_encode("Cedula repetida");
    }
    
    }

?>