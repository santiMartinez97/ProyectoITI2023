<?php

require '../config/config.php';
require '../config/conexion.php';

if (isset($_POST['action'])) {

    $action = $_POST['action'];
    // Validar si existe el id, si no se le asigna 0
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $action = $_POST['action'];

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($id, $cantidad);
        if ($respuesta > 0) {
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }
        $datos['sub'] = number_format($respuesta, 0, '.', ',');
    } else {
        $datos['ok'] = false;
    }

} else {
    $datos['ok'] = false;
}

echo json_encode($datos);

function agregar($id, $cantidad)
{

    $res = 0;
    if ($id > 0 && $cantidad > 0 && is_numeric(($cantidad))) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = $cantidad;


            $db = new DataBase();
            $con = $db->conectar();

            $sql = $con->prepare("SELECT Precio,descuento FROM menu WHERE id=? AND Habilitacion='Habilitado'");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $precio = $row['Precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $res = $cantidad * $precio_desc;

            return $res;

        }


    } else {

        return $res;
    }

}



?>