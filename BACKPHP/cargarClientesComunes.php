<?php

require '../config/conexion.php';
require '../Clases/clientecomun.php';

$db = new DataBase();
$con = $db->conectar();

$listaClientes = ClienteComun::listarClientesComunes($con);

$codigoHtml = []; // Array para almacenar los clientes
$codigoHtml[] = '<tr>
    <th class="tablaArriba">ID</th>
    <th class="tablaArriba">Email</th>
    <th class="tablaArriba">CI</th>
    <th class="tablaArriba">Nombre</th>
    <th class="tablaArriba">Apellido</th>
    <th class="tablaArriba">Dirección</th>
    <th class="tablaArriba">Teléfono</th>
    <th class="tablaArriba">Dieta</th>
    <th class="tablaArriba">Habilitación</th>
</tr>
';

foreach($listaClientes as $cliente){
    $telefonos = $cliente->obtenerTelefonos();
    $dieta = $cliente->getTipoDieta();

    $codigoCliente = '<tr data-client-id="'.$cliente->getID().'">
        <td>'.$cliente->getID().'</td>
        <td>'.$cliente->getEmail().'</td>
        <td>'.$cliente->getCI().'</td>
        <td>'.$cliente->getNombre().'</td>
        <td>'.$cliente->getApellido().'</td>
        <td>'.$cliente->getDireccionCompleta().'</td>
        <td>';
    foreach($telefonos as $telefono){
        $codigoCliente .= $telefono.'<br>';
    }
    $codigoCliente .= '</td>
        <td>'.$dieta.'</td>';
    if($cliente->getHabilitacion() === "No habilitado"){
        $codigoCliente .= '<td data-client-status="false">'.$cliente->getHabilitacion().'</td>
            <td><button class="botonAceptar habilitar-btn">Habilitar</button></td>
            <td><button class="botonModificar" data-toggle="modal" data-target="#modalCliente">Modificar</button></td>
            <td><button class="botonDesechar">Eliminar</button></td>';
    }else{
        $codigoCliente .= '<td data-client-status="true">'.$cliente->getHabilitacion().'</td>
            <td><button class="botonRechazar habilitar-btn">Deshabilitar</button></td>
            <td><button class="botonModificar" data-toggle="modal" data-target="#modalCliente">Modificar</button></td>
            <td><button class="botonDesechar">Eliminar</button></td>';
    }
    $codigoHtml[] = $codigoCliente;
    
}

echo json_encode($codigoHtml);

?>