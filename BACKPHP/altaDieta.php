<?php
//Configuración base de datos
require '../config/conexion.php';
require '../Clases/dieta.php';

$db = new DataBase();
$con = $db->conectar();

$objDieta = new Dieta($con);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombreDieta = $_POST['nombreDieta'];
    $descripcion = $_POST['descripcion'];
    $idDieta = $_POST['idDieta'] ? $_POST['idDieta'] : null;

    $existeDieta = $objDieta->findByTipo($nombreDieta);

    if($idDieta){
        if($existeDieta){
            if($existeDieta['ID'] != $idDieta){
                echo 'Repetido';
            }else{
                if($objDieta->update($idDieta,$nombreDieta,$descripcion)){
                    echo 'Success';
                }else{
                    echo 'Error';
                }
            }
        }else{
            if($objDieta->update($idDieta,$nombreDieta,$descripcion)){
                echo 'Success';
            }else{
                echo 'Error';
            }
        }
        
    }else{
        if($existeDieta){
            echo 'Repetido';
        }else{
            if($objDieta->create($nombreDieta, $descripcion)){
                echo 'Success';
            }else{
                echo 'Error';
            }
        }
    }
}

?>