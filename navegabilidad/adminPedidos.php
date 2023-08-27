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
    <title>Administrador| NutriBento</title>
    <link rel="stylesheet" href="../CSS/admin.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Administrador</h1>
        <a class="cerrarSesion" href="cerrar_session.php">Cerrar sesion</a>
    </header>
    
    <br>

    <!-- Control de pedidos -->
    <h2><a class="camino" href="admin.php">Administrador /</a>Control de pedidos</h2>

    <article class="pedidos">
    <select class="tablaArriba">
                <option> Todos los pedidos </option>
                <option>Entregados</option> 
                <option>En proceso</option> 
                <option>Enviado</option>
                </select>
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

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
</body>
</html>
