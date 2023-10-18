<?php

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
        <h2 class="h2tit">
        <a class= "nav" href="jefeMain.php">Menu principal</a>
        <a class= "nav" href="jefeCocina.php">Ver pedidos </a>
        <a class= "nav" href="jefeComida.php">Preparacion comidas</a>
        <a class= "nav" href="cerrar_session.php">Cerrar sesion</a>
    </h2>
    
    </header>
    
    <br>

    <h2 class="titulo">Gestion de stocks</h2>

    <!-- Lista de stcok -->
    
        <?php        
          $stock->listarStocks();

          if (isset($_POST['agregarStock'])) {
            $menu = $_POST['menu'];
            $cantidad = (int)$_POST['cantidad'];
        
            if ($stock->agregarStock($menu, $cantidad)) {
                echo "Stock agregado exitosamente.";
            } else {
                echo "Error al agregar stock.";
            }
        }
        
        if (isset($_POST['quitarStock'])) {
            $menu = $_POST['menu'];
            $cantidad = (int)$_POST['cantidad'];
        
            if ($stock->quitarStock($menu, $cantidad)) {
                echo "Stock quitado exitosamente.";
            } else {
                echo "Error al quitar stock.";
            }
        }


        ?>


   

    <footer>
    <section>
      <h3>Jefe de cocina</h3>
    </section>
    </footer>
</body>
</html>
