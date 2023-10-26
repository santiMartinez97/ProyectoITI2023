<?php

include_once '../clases/menu.php';

$menu = new Menu();
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

        <?php
            $menu->listadoMenus();
        ?>
                  


        <script src="../JS/jquery-3.6.4.min.js"></script>
        <script src="../JS/adminGerente.js"></script>
        <script src="../JS/popper.min.js"></script>
        <script src="../JS/bootstrap.min.js"></script>        
