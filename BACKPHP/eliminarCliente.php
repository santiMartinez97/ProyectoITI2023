<?php

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];

    $cliente = $con->prepare("DELETE FROM cliente WHERE ID = ?");
    $cliente-> execute([$clientId]);
        

    // Si la eliminación se realiza con éxito, devuelve 'success'
    echo 'success';
} else {
    echo 'Error: Método no válido.';
}
?>