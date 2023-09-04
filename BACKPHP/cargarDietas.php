<?php
require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$dieta = $con->prepare("SELECT * FROM dieta ");
$dieta-> execute();
$resultado = $dieta->fetchAll(PDO::FETCH_ASSOC);

$listaDeDietas = []; // Array para almacenar las dietas

foreach ($resultado as $row) {
    $dieta = $row['Tipo'];
    $id = $row['ID'];
    $unaOpcion = '<option value="' . $id . '" >' . $dieta . '</option>';
    $listaDeDietas[] = $unaOpcion; // Agrega la dieta al array de dietas    
}

echo json_encode($listaDeDietas);
?>