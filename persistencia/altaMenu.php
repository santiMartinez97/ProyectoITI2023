<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

    $periodicidadSeleccionada = $_POST["periodicidad"];
    $nombreMenu= $_POST["menu"];
    $habilitacionSeleccionada= $_POST["habilitacion"];
    $precio= $_POST["precio"];
    $descuento= $_POST["descuento"];
    $stock= $_POST["stock"];
    $stockMinimo= $_POST["stockMinimo"];
    $stockMaximo= $_POST["stockMaximo"];
    $descripcion= $_POST["descripcion"];

    /*** Hay que ver bien como va a ir la img, url o subir una foto?¡?¡?¡?¡¿' ///**/
    // $imagen= $_POST["imagen"];
    // echo "La periodicidad seleccionada es: " . $imagen;


    $sql = " INSERT INTO `menu` (`ID`, `Periodicidad`, `Nombre`, `Habilitacion`, `Precio`, `Descuento`, `Stock`, `StockMinimo`, `StockMaximo`, `Descripcion`, `Imagen`) 
    VALUES (NULL, '$periodicidadSeleccionada', '$nombreMenu', '$habilitacionSeleccionada', '$precio', '$descuento', '$stock', '$stockMinimo', '$stockMaximo', '$descripcion', 'noimg.jpg') ";
    $stmt = $con->prepare($sql);

    if ($stmt->execute()) {
       echo "exitoso";
       }
       else{
        echo "fallo";
       } 



    
?>