<?php

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];
    $clientStatus = $_POST['clientStatus'];

    if($clientStatus == "true"){
        $cliente = $con->prepare("UPDATE cliente SET Habilitacion = 'Habilitado' WHERE ID = ?");
        $cliente-> execute([$clientId]);
    }else{
        $cliente = $con->prepare("UPDATE cliente SET Habilitacion = 'No habilitado' WHERE ID = ?");
        $cliente-> execute([$clientId]);
    }

    // Si la actualización se realiza con éxito, devuelve 'success'
    echo 'success';
} else {
    echo 'Error: Método no válido.';
}
?>
