<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$ci= $_POST['ci'];
$email= $_POST['email'];
$password= $_POST['password'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$telefono= $_POST['telefono'];
$calle= $_POST['calle'];
$numero= $_POST['numero'];
$esquina= $_POST['esquina'];
$barrio= $_POST['barrio'];
$menu = $_POST['dieta'];


// Ruta del archivo de la agenda
$archivo = '../PersistenciaArchivos/ClienteWeb.txt';
// Abrir el archivo en modo de escritura (a+ para crearlo si no existe)
$agenda = fopen($archivo, 'a+');
 
if ($agenda) {
    // Escribir los datos en el archivo separados por comas
    $texto = $ci."\t\t\t".$email."\t\t\t".$password."\t\t\t".$nombre."\t\t\t".$apellido."\t\t\t".$telefono."\t\t\t".$menu."\t\t\t".$calle."\t\t\t".$numero."\t\t\t".$esquina."\t\t\t".$barrio;
    fwrite($agenda,$texto."\r");
    // Cerrar el archivo
     fclose($agenda);  
 } 

}
?>