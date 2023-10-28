<?php

include_once '../Clases/pedido_encarga_menu.php';
$pedidos = new Pedido_Encarga_Menu();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de cocina | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Jefe de cocina</h1>
        <h2 class="h2tit">
        <a class ="nav" href="jefeMain.php">Menu principal</a>
        <a class="nav" href="jefeCocinaStock.php">Control de stock</a>
        <a class="nav" href="jefeComida.php">Preparacion comidas</a>
        <a class="nav" href="cerrar_session.php">Cerrar sesion</a>
    </h2>
    </header>    
    
    <br>

    <!-- Lista de pedidos -->

    <h2>Listado de pedidos</h2>

    <article class="pedidos">
    <table>
            <thead>
                <tr>
                    <th class="tablaArriba">Nombre Menu</th>
                    <th class="tablaArriba">ID Menu</th>
                    <th class="tablaArriba">N° Pedido</th>
                    <th class="tablaArriba">Descripción</th>
                    <th class="tablaArriba">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $pedidos->listadoPedidos();                    
                ?>
            </tbody>
        </table>

    </article>

    <h2>Calendario</h2>
    
    <?php
      
    ?>

    <footer>
    <section>
      <h3>Jefe de cocina</h3>
    </section>
    </footer>
</body>
</html>
