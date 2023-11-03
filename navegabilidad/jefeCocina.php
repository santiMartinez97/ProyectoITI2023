<?php
session_start();
if(!isset($_SESSION['jefeCocina'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

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
        <a class ="nav" href="jefeMain.php">Menú principal</a>
        <a class="nav" href="jefeCocinaStock.php">Control de stock</a>
        <a class="nav" href="jefeComida.php">Preparación de comidas</a>
        <a class="nav" href="cerrar_session.php">Cerrar Sesión</a>
    </h2>
    </header>    
    
    <br>

    <!-- Lista de pedidos -->

    <h2>Listado de pedidos</h2>

    <article class="pedidos">
    <table>
            <thead>
                <tr>
                    <th class="tablaArriba">Nombre Menú</th>
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
