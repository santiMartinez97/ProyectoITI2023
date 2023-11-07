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
    <link rel="stylesheet" href="../CSS/jefedecocina.css" />
</head>
<body>

<header>
        <div class="gerente-section">
            <h1>Gerente</h1>
            <a class="enlace" href="gerente.php">Alta menus</a>
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificación de menú</a>
            <a class="enlace" href="gerenteEstadisticas.php">Estadísticas</a>
            <a class="enlace" href="gerenteViandas.php">Armar menus</a>

        </div>
        <div class="baja-section">
          <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
    
    <br>

    <h2 class="titulo">Gestión de stocks</h2>

    <!-- Lista de stcok -->
        <section class="cajaSeleccion">
            <form method="post" >
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
