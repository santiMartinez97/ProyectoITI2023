<?php
//Configuración base de datos
require '../config/conexion.php';
require '../Clases/dieta.php';

$db = new DataBase();
$con = $db->conectar();

$objDieta = new Dieta($con);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $idDieta = $_POST['idDieta'];

    if($objDieta->delete($idDieta)){
        echo 'Success';
    }else{
        echo 'Error';
    }
}

?>