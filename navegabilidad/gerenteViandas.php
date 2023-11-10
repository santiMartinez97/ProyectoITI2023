<?php
include_once('../Clases/vianda.php');
$viandasListado = new Vianda($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aramdo Menus | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="../CSS/boostrap.css">
    <link rel="stylesheet" href="../CSS/gerente.css" />

</head>
<body>
    
    <header>
        <div class="gerente-section">
            <h1>Gerente</h1>
            <a class="enlace" href="gerente.php">Alta de menú</a>
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificación de menú</a>
            <a class="enlace" href="gerenteDieta.php">Gestión dietas</a>
            <a class="enlace" href="gerenteEstadisticas.php">Estadísticas</a>
            <a class="enlace" href="gerenteStock.php">Stock</a>
            <a class="enlace" href="gerenteMetas.php">Metas de la empresa</a>            
          </div>
        <div class="baja-section">
          <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
    <?php
    $viandasListado->listarViandas($con);
    ?>


</body>
<script src="../JS/jquery-3.6.4.min.js"></script>
<script src="../JS/validacionVianda.js"></script>
<script src="../JS/bootstrap.min.js"></script>        

</html>