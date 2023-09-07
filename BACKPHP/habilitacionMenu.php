<?php

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuID = $_POST['menuID'];
    $menuStatus = $_POST['menuStatus'];

    if($menuStatus == "true"){
        $menu = $con->prepare("UPDATE menu SET Habilitacion = 'Habilitado' WHERE ID = ?");
        $menu-> execute([$menuID]);
    }else{
        $menu = $con->prepare("UPDATE menu SET Habilitacion = 'No habilitado' WHERE ID = ?");
        $menu-> execute([$menuID]);
    }

    // Si la actualización se realiza con éxito, devuelve 'success'
    echo 'success';
  

} else {
    echo 'Error: Método no válido.';
}
?>
