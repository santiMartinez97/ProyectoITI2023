<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();
date_default_timezone_set('America/Montevideo');
$fecha = date(format: 'Y-m-d H:i:s');

    $nombreVianda= $_POST["nombre"];
    $vidaUtil= $_POST["vidaUtil"];
    $cantidad= $_POST["cantidad"];
    $descripcion= $_POST["descripcion"];

    for($i=1; $i <= $cantidad; $i++){
       $con->beginTransaction();

       $sql1 = "INSERT INTO vianda (Nombre, VidaUtil, Descripcion) VALUES ('$nombreVianda', '$vidaUtil', '$descripcion');";
       
       $result1 = $con->prepare($sql1);

       if ($result1->execute()) {

        $idViandaGenerado = $con->lastInsertId();
        $default = 'Envasado';
        $sql2 = "INSERT INTO `estado_vianda` (`IDVianda`, `Estado`, `Fecha`) VALUES ('$idViandaGenerado', '$default', '$fecha')";
        $result2 = $con->prepare($sql2);
 
        if ($result2->execute()) {    
            $con->commit();
        } 
     }
    }
?>