<?php

require '../config/conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe Cocina | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Bienvenido Jefe</h1>
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>
    </header>
    
    <br>

    <!-- Opciones -->

    <h2>¿Qué funcionalidad va a utilizar?</h2>
    <h2><a href="jefeCocina.php">Visualizar pedidos</a></h2>
    <h2> <a href="jefeCocinaStock.php">Visualizar stock</a></h2>
    <h2> <a href="jefeComida.php">Preparar comidas</a></h2>


</body>
</html>