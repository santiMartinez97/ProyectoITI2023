<?php
//Cargar configuración previa de mai
//Configuración base de datos
require '../config/conexion.php';
require '../Clases/usuario.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_POST['clientId'];
    $clientEmail = $_POST['clientEmail'];

    $cliente = Usuario::findBy($con,'ID',$clientId);
    $respuesta = $cliente->delete();
    if($respuesta){
    
        // Si la eliminación se realiza con éxito, devuelve 'success'
        echo 'success';
    }else{
        echo 'Error: No se puede eliminar.';
    }
        
    
} else {
    echo 'Error: Método no válido.';
}
?>