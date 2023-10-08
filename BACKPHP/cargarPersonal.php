<?php
require '../config/conexion.php';
require '../config/config.php';
require '../Clases/usuario.php';

$db = new DataBase();
$con = $db->conectar();


$listaPersonal = Usuario::listarPersonal($con);

$codigoHtml = []; 
$codigoHtml[] = '<tr>
    <th class="tablaArriba">ID</th>
    <th class="tablaArriba">Email</th>
    <th class="tablaArriba">Puesto</th>
</tr>';

foreach($listaPersonal as $personal){
    $puesto = $personal->getUsuarioTipo(); 

    if ($puesto !== 'Cliente') {
        $codigoPersonal = '<tr data-client-id="'.$personal->getID().'">
        <td>'.$personal->getID().'</td>
        <td>'.$personal->getEmail().'</td>
        <td>'.$puesto.'</td>
        <td><button class="botonModificar" data-toggle="modal" data-target="#modalCliente">Modificar</button></td>
        <td><button class="botonDesechar">Eliminar</button></td>';

        $codigoHtml[] = $codigoPersonal;
    }
}

echo json_encode($codigoHtml);

?>