<?php

$id= $_POST["id"];
$periodicidadSeleccionada = $_POST["periodicidad"];
$nombreMenu = $_POST["nombre"];
$precio = $_POST["precio"];
$descuento = $_POST["descuento"];
$stock = $_POST["stock"];
$stockMinimo = $_POST["stockMinimo"];
$stockMaximo = $_POST["stockMaximo"];
$descripcion = $_POST["descripcion"];


    // Incluir el archivo de configuración de la conexión
    require '../config/conexion.php';

    // Crear una instancia de Database y obtener la conexión
    $db = new DataBase();
    $con = $db->conectar();

    // Prepara la consulta SQL de actualización
    $sql = "UPDATE menu SET Periodicidad = :periodicidad, Nombre = :nombre, Precio = :precio, Descuento = :descuento, Stock = :stock, StockMinimo = :stockMinimo, StockMaximo = :stockMaximo, Descripcion = :descripcion WHERE ID = :id";

    // Prepara la sentencia SQL
    $stmt = $con->prepare($sql);

    // Enlaza los parámetros
    $stmt->bindParam(":periodicidad", $periodicidadSeleccionada);
    $stmt->bindParam(":nombre", $nombreMenu);
    $stmt->bindParam(":precio", $precio);
    $stmt->bindParam(":descuento", $descuento);
    $stmt->bindParam(":stock", $stock);
    $stmt->bindParam(":stockMinimo", $stockMinimo);
    $stmt->bindParam(":stockMaximo", $stockMaximo);
    $stmt->bindParam(":descripcion", $descripcion);
    $stmt->bindParam(":id", $id); // Asegúrate de definir $id con el valor adecuado

    // Ejecuta la consulta
    $stmt->execute();

    // Redirecciona a la página de éxito o realiza otras acciones después de la actualización
    header("Location: gerenteBajaModi.php");

?>