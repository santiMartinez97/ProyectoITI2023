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
    $dieta= $_POST["dieta"];

       $con->beginTransaction();

       $sql1 = "INSERT INTO `menu` (`ID`, `Periodicidad`, `Nombre`, `Habilitacion`, `Precio`, `Descuento`, `Stock`, `StockMinimo`, `StockMaximo`, `Descripcion`, `Imagen`) 
       VALUES (NULL, '$periodicidadSeleccionada', '$nombreMenu', '$habilitacionSeleccionada', '$precio', '$descuento', '$stock', '$stockMinimo', '$stockMaximo', '$descripcion', 'noimg.jpg')";
       
       $result1 = $con->prepare($sql1);
       
       if ($result1->execute()) {

           $idMenuGenerado = $con->lastInsertId();
           $sql2 = "INSERT INTO `menu_sigue_dieta` (`IDDieta`, `IDMenu`) VALUES ('$dieta', '$idMenuGenerado')";
           $result2 = $con->prepare($sql2);
    
           if ($result2->execute()) {
               
               $con->commit();
               echo "Se ejecutaron correctamente.";
           } 
        }

    
?>