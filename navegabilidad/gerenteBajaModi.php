<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$menu = $con->prepare("SELECT *  FROM menu ");
$menu-> execute();
$resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

$menu_array=[];

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$menu = $con->prepare("SELECT *  FROM menu ");
$menu-> execute();
$resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

$menu_array=[];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/gerente.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/boostrap.css">
</head>
<body class="mainBaja">

    <header>
        <div class="gerente-section">
            <h1>Control de Menu</h1>
            <a class="enlace" href="gerente.php">Alta de menú</a>
        </div>
        <div class="baja-section">
          <a class ="enlace" href="cerrar_session.php">Cerrar Session</a>
        </div>
    </header>

        <table>
            <thead>
                <tr>
                    <th class="tablaArriba">Periocidad</th>
                    <th class="tablaArriba">Menu</th>
                    <th class="tablaArriba">Precio</th>
                    <th class="tablaArriba">Descuento</th>
                    <th class="tablaArriba">Stock</th>
                    <th class="tablaArriba">Stock minimo</th>
                    <th class="tablaArriba">Stock maximo</th>
                    <th class="tablaArriba">Habilitacion</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultado as $row) {
                    $Periocidad = $row['Periodicidad'];
                    $menu = $row['Nombre'];
                    $precio = $row['Precio']; 
                    $descuento = $row['Descuento']; 
                    $stockActual = $row['Stock'];
                    $stockMinimo = $row['StockMinimo'];
                    $stockMaximo = $row['StockMaximo'];

                    if (!in_array($menu, $menu_array)) {      
                        echo '<tr data-client-id="'.$row['ID'].'">';
                        echo '<th >'.$Periocidad.'</th> ';
                        echo '<th >'.$menu.'</th> ';
                       
                        echo '<th >$' .$precio.'</th> ';
                        echo '<th >'.$descuento.'</th> ';
                        echo '<th >'.$stockActual.'</th> ';    
                        echo '<th >'.$stockMinimo.'</th> ';    
                        echo '<th >'.$stockMaximo.'</th> ';    
                        

                        if($row['Habilitacion'] === "No habilitado"){
                            echo '<td data-client-status="false">'.$row['Habilitacion'].'</td>';
                            echo '<td><button class="botonAceptar habilitar-btn">Habilitar</button></td>';
                            echo '<td><button class="botonDesechar">Eliminar</button></td>';
                            echo '<td><button type="button" class="btn btn-primary botonModificar" data-toggle="modal" data-target="#editChildresn' . $row['ID'] . '">Modificar</button></td>';


                        }else{
                           echo '<td data-client-status="true">'.$row['Habilitacion'].'</td>';
                            echo '<td><button class="botonRechazar habilitar-btn">Deshabilitar</button></td>';
                            echo '<td><button class="botonDesechar">Eliminar</button></td>';
                            echo '<td><button type="button" class="btn btn-primary botonModificar" data-toggle="modal" data-target="#editChildresn' . $row['ID'] . '">Modificar</button></td>';
                           
                        }
                        echo '</tr>';
                    
                     }
                     include('ModalEditar.php'); 
                    }
                  
                    
       
                ?>
                  
            </tbody>
        </table>
        </article>

        <script src="../JS/jquery-3.6.4.min.js"></script>
        <script src="../JS/adminGerente.js"></script>
        <script src="../JS/popper.min.js"></script>
        <script src="../JS/bootstrap.min.js"></script>        

        
