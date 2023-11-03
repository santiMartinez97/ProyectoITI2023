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
    $viandas=$_POST["viandas"];

    $descripcion .= " . $viandas . ";
    // Verifica si se ha enviado un archivo y si no hay errores
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $nombre_original = $_FILES["imagen"]["name"];
        $nombre_temporal = $_FILES["imagen"]["tmp_name"];
        $extension = pathinfo($nombre_original, PATHINFO_EXTENSION);

        // Genera un nombre aleatorio para el archivo
        $nombre_unico = uniqid() . "." . $extension;

        // Carpeta de destino para almacenar las imágenes
        $carpeta_destino = "../imgCatalogo/";

        // Mueve el archivo a la carpeta de destino
        if (move_uploaded_file($nombre_temporal, $carpeta_destino . $nombre_unico)) {
            // El archivo se ha movido correctamente

            // Ahora, puedes guardar $nombre_unico en tu base de datos
            $imagen = $nombre_unico;
        }else{
            $imagen = 'noimg.jpg';
        }
    }else{
        $imagen = 'noimg.jpg';
    }
    $con->beginTransaction();

    $sql1 = "INSERT INTO `menu` (`ID`, `Periodicidad`, `Nombre`, `Habilitacion`, `Precio`, `Descuento`, `Stock`, `StockMinimo`, `StockMaximo`, `Descripcion`, `Imagen`) 
    VALUES (NULL, :periodicidad, :nombreMenu, :habilitacion, :precio, :descuento, :stock, :stockMinimo, :stockMaximo, :descripcion, :imagen)";
    
    $result1 = $con->prepare($sql1);
    $result1->bindParam(':periodicidad', $periodicidadSeleccionada);
    $result1->bindParam(':nombreMenu', $nombreMenu);
    $result1->bindParam(':habilitacion', $habilitacionSeleccionada);
    $result1->bindParam(':precio', $precio);
    $result1->bindParam(':descuento', $descuento);
    $result1->bindParam(':stock', $stock);
    $result1->bindParam(':stockMinimo', $stockMinimo);
    $result1->bindParam(':stockMaximo', $stockMaximo);
    $result1->bindParam(':descripcion', $descripcion);
    $result1->bindParam(':imagen', $imagen);
    
    if ($result1->execute()) {
        $idMenuGenerado = $con->lastInsertId();
    
        $sql2 = "INSERT INTO `menu_sigue_dieta` (`IDDieta`, `IDMenu`) VALUES (:dieta, :idMenuGenerado)";
        $result2 = $con->prepare($sql2);
        $result2->bindParam(':dieta', $dieta);
        $result2->bindParam(':idMenuGenerado', $idMenuGenerado);
    
        if ($result2->execute()) {
            $con->commit();
        }
    }
    
?>