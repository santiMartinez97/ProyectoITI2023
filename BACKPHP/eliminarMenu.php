<?php

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuID = $_POST['menuID'];

    $menu = $con->prepare("DELETE FROM menu WHERE ID = ?");
    $menu-> execute([$menuID]);
        

    // Si la eliminación se realiza con éxito, devuelve 'success'
    echo 'success';
} else {
    echo 'Error: Método no válido.';
}
?>