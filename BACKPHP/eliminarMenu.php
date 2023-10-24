<?php

require '../config/config.php';
require '../config/conexion.php';
require '../Clases/menu.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuID = $_POST['menuID'];

    $menuManager = new Menu($con);
    $exito = $menuManager->eliminarMenu($menuID);

    if ($exito) {
        echo 'success';
    } else {
        echo 'Error: No se pudo eliminar el menú.';
    }
} else {
    echo 'Error: Método no válido.';
}



?>