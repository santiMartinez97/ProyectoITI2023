<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$infoCliente = $con->prepare("SELECT Email FROM `cliente`");
$infoCliente-> execute();
$resultado = $infoCliente->fetchAll(PDO::FETCH_ASSOC);

$infoCliente_array=[];

$pedido = $con->prepare("SELECT ID, Fecha FROM `pedido`");
$pedido-> execute();
$resultadop = $pedido->fetchAll(PDO::FETCH_ASSOC);

$pedido_array=[];

$estado = $con->prepare("SELECT Estado FROM `estado_pedido`");
$estado-> execute();
$resultadoe = $estado->fetchAll(PDO::FETCH_ASSOC);

$estado_array=[];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/admin.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <div class="admin-section">
            <h1>Bienvenido administrador</h1>
            <a class="enlace" href="admin.php">Volver al menu</a>
        </div>
        <div class="baja-section">
            <a class="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
  
    
    <br>

    <!-- Control de pedidos -->
    <h2 class=>Control de pedidos</h2>
    <select class="seleccionClientes">
                <option>Todos los pedidos</option>
                <option>Entregados</option> 
                <option>En proceso</option> 
                <option>Enviado</option>
                </select>
    
    <article class="pedidos">
    <table>
        <thead>
            <tr>
                   <th class="tablaArriba">Cliente</th>
                    <th class="tablaArriba">ID Pedido</th>
                    <th class="tablaArriba">Fecha</th>
                    <th class="tablaArriba">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultado as $row) {
                        $cliente = $row['Email'];    
                        if (!in_array($infoCliente, $infoCliente_array)) {
                            echo '<tr>';
                            echo '<th >'.$cliente.'</th> ';   
                         }
                    }
                    foreach ($resultadop as $row) {
                        $id = $row['ID']; 
                        $fecha = $row['Fecha'];       
                        if (!in_array($pedido, $pedido_array)) {
                            echo '<th >'.$id.'</th> ';
                            echo '<th >'.$fecha.'</th> ';   
                         }
                    }
                    foreach ($resultadoe as $row) {
                        $estado = $row['Estado'];        
                        if (!in_array($estado, $estado_array)) {
                            echo '<th >'.$estado.'</th> ';
                            echo '<th><button class="botonAceptar">Detalles</button></th> ';   
                            echo '</tr>';
                         }
                    }
                ?>
            </tbody>
        </table>
    </article>

</body>
</html>
