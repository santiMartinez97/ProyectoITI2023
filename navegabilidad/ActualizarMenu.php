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

    // Buscamos imagen anterior
    $menu = $con->prepare("SELECT Imagen FROM menu WHERE ID = :id");
    $menu->bindParam(":id", $id);
    $menu-> execute();
    $viejaImagen = $menu->fetchColumn();

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

        // Ahora, borramos el archivo anterior
        $ruta = '../imgCatalogo/'.$viejaImagen;
        if(file_exists($ruta) && $viejaImagen != 'noimg.jpg'){
            unlink($ruta);
        }

        // Ahora, puedes guardar $nombre_unico en tu base de datos
        $imagen = $nombre_unico;
    }else{
        $imagen = $viejaImagen;
    }
}else{
    $imagen = $viejaImagen;
}

    // Prepara la consulta SQL de actualización
    $sql = "UPDATE menu SET Periodicidad = :periodicidad, Nombre = :nombre, Precio = :precio, Descuento = :descuento, Stock = :stock, StockMinimo = :stockMinimo, StockMaximo = :stockMaximo, Descripcion = :descripcion, Imagen = :imagen WHERE ID = :id";

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
    $stmt->bindParam(":imagen", $imagen);
    $stmt->bindParam(":id", $id); // Asegúrate de definir $id con el valor adecuado

    // Ejecuta la consulta
    $stmt->execute();

    
    echo 'success';

?>