<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$rut= $_POST['rut'];
$email= $_POST['email'];
$password= $_POST['password'];
$nombreEmpresa= $_POST['empresa'];
$telefono= $_POST['telefono'];
$calle= $_POST['calle'];
$numero= $_POST['numero'];
$esquina= $_POST['esquina'];
$barrio= $_POST['barrio'];
$opcionMenu= $_POST['opcionMenu'];
$menu = $_POST['dieta'];

 // Ruta del archivo de la agenda
 $archivo = '../PersistenciaArchivos/ClienteEmpresa.txt';
 // Abrir el archivo en modo de escritura (a+ para crearlo si no existe)
 $agenda = fopen($archivo, 'a+');
 
 if ($agenda) {
     // Escribir los datos en el archivo separados por comas
     $texto = $rut."\t\t\t".$email."\t\t\t".$password."\t\t\t".$nombreEmpresa."\t\t\t".$telefono."\t\t\t".$menu."\t\t\t".$calle."\t\t\t".$numero."\t\t\t".$esquina."\t\t\t".$barrio;
     fwrite($agenda,$texto."\r");

     // Cerrar el archivo
     fclose($agenda);
    
 } 
}