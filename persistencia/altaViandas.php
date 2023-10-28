<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

    $nombreVianda= $_POST["nombre"];
    $vidaUtil= $_POST["vidaUtil"];
    $cantidad= $_POST["cantidad"];
    $habilitacionSeleccionada= $_POST["habilitacion"];
    $descripcion= $_POST["descripcion"];

    for($i=0; $i <= $cantidad; $i++){
       $con->beginTransaction();

       $sql1 = "INSERT INTO vianda (Nombre, Habilitacion, VidaUtil, Descripcion) VALUES ('$nombreVianda', '$vidaUtil', '$habilitacionSeleccionada', '$descripcion');";
       
       $result1 = $con->prepare($sql1);

       if($results->execute()){
        echo 'muy bien';
       }
    }
?>