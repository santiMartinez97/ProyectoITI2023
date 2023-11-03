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
include_once '../Clases/listadostock.php';
$stock = new Stock();
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
        <h2 >
        <a class= "nav" href="jefeMain.php">Menú principal</a>
        <a class= "nav" href="jefeCocina.php">Ver pedidos </a>
        <a class= "nav" href="jefeComida.php">Preparación de comidas</a>
        <a class= "nav" href="cerrar_session.php">Cerrar Sesión</a>
    </h2>
    
    </header>
    
    <br>

    <h2 class="titulo">Gestión de stocks</h2>

    <!-- Lista de stcok -->
        <section class="cajaSeleccion">
            <form method="post" action="jefeCocinaStock.php">
                <h2>Agregue o quite stock</h2>
                <input type="text" name="menu" class="input-text" placeholder="Nombre del menú">
                <input type="number" name="cantidad" class="input-number" placeholder="Cantidad" min="0">
                <input type="submit" class="botonAceptar" name="agregarStock" value="Agregar Stock">
                <input type="submit" class="botonDesechar" name="quitarStock" value="Quitar Stock">
            </form>
       </section>

        <?php        

          if (isset($_POST['agregarStock'])) {
            $menu = $_POST['menu'];
            $cantidad = (int)$_POST['cantidad'];
        
            if ($stock->agregarStock($menu, $cantidad)) {
                echo '<p class="alert2">Se ha agregado correctamente el stock de: ' . $menu . '</p>' ;
            } else {
                echo '<p class="alert-confirmacion">¡Alerta! No puedes agregar más stock de ' . $menu . ' porque excede el stock máximo.</p>';
            }
        }
        
        if (isset($_POST['quitarStock'])) {
            $menu = $_POST['menu'];
            $cantidad = (int)$_POST['cantidad'];
        
            if ($stock->quitarStock($menu, $cantidad)) {
                echo '<p class="alerta">Se ha quitado correctamente el stock de: ' . $menu . '</p>';
            } else {
                echo '<p class="alert-confirmacion">¡Alerta! El stock de ' . $menu . ' no puede ser negativo.</p>';
            }
        }

        $stock->listarStocks();

        
        ?>


   

    <footer>
    <section>
      <h3>Jefe de cocina</h3>
    </section>
    </footer>
    <script src="JS/jquery-3.6.4.min.js"></script>
</body>
</html>
