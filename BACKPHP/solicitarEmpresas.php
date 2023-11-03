<?php

require '../config/conexion.php';
require '../Clases/clienteempresa.php';

$db = new DataBase();
$con = $db->conectar();

$listaClientes = ClienteEmpresa::listarClientesEmpresa($con);

$codigoHtml = []; // Array para almacenar los clientes
$codigoHtml[] = '<tr>
    <th class="tablaArriba">ID</th>
    <th class="tablaArriba">Email</th>
    <th class="tablaArriba">RUT</th>
    <th class="tablaArriba">Nombre</th>
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
        <td>'.$cliente->getRUT().'</td>
        <td>'.$cliente->getNombreEmpresa().'</td>
        <td>'.$cliente->getDireccionCompleta().'</td>
        <td>';
        foreach($telefonos as $telefono){
            $codigoCliente .= $telefono.'<br>';
        }
        $codigoCliente .= '</td>
        <td>'.$dieta.'</td>';
        if($cliente->getHabilitacion() === "No habilitado"){
            $codigoCliente .= '<td>'.$cliente->getHabilitacion().'</td>
            <td><button class="botonAceptar habilitar-btn" data-client-id="'.$cliente->getID().'">Solicitar habilitación</button></td>';
            
        }
    $codigoHtml[] = $codigoCliente;
    
}

echo json_encode($codigoHtml);

?>
