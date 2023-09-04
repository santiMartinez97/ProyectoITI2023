<?php

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$cliente = $con->prepare("SELECT * FROM cliente");
$cliente-> execute();
$resultadoCliente = $cliente->fetchAll(PDO::FETCH_ASSOC);

$listaDeClientes = []; // Array para almacenar los clientes
$listaDeClientes[] = '<tr>
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

foreach($resultadoCliente as $row){
    $clienteEmpresa = $con->prepare("SELECT * FROM clienteempresa WHERE ID = :id");
    $clienteEmpresa->bindParam(':id', $row['ID'], PDO::PARAM_STR);
    $clienteEmpresa-> execute();
    $resultadoClienteEmpresa = $clienteEmpresa->fetchAll(PDO::FETCH_ASSOC);

    $telefono = $con->prepare("SELECT * FROM clientetelefono WHERE ID = :id");
    $telefono->bindParam(':id', $row['ID'], PDO::PARAM_STR);
    $telefono-> execute();
    $resultadoTelefono = $telefono->fetchAll(PDO::FETCH_ASSOC);

    $unTelefono = $resultadoTelefono[0];

    if($resultadoClienteEmpresa){
        $empresa = $resultadoClienteEmpresa[0];
        $codigoCliente = '<tr data-client-id="'.$row['ID'].'">
            <td>'.$row['ID'].'</td>
            <td>'.$row['Email'].'</td>
            <td>'.$empresa['RUT'].'</td>
            <td>'.$empresa['NombreEmpresa'].'</td>
            <td>'.$row['DireccionCompleta'].'</td>
            <td>'.$unTelefono['Telefono'].'</td>
            <td>'.$row['Dieta'].'</td>';
        if($row['Habilitacion'] === "No habilitado"){
            $codigoCliente .= '<td data-client-status="false">'.$row['Habilitacion'].'</td>
            <td><button class="botonAceptar habilitar-btn">Habilitar</button></td>
            <td><button class="botonModificar">Modificar</button></td>
            <td><button class="botonDesechar">Eliminar</button></td>';
        }else{
            $codigoCliente .= '<td data-client-status="true">'.$row['Habilitacion'].'</td>
            <td><button class="botonRechazar habilitar-btn">Deshabilitar</button></td>
            <td><button class="botonModificar">Modificar</button></td>
            <td><button class="botonDesechar">Eliminar</button></td>';
        }
        $listaDeClientes[] = $codigoCliente;
    }
}

echo json_encode($listaDeClientes);

?>