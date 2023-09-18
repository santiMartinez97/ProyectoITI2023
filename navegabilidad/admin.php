<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['admin'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

require '../config/conexion.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | NutriBento</title>
    <link rel="icon" href="../img/icono.png">
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="admin-section">
            <h1>Bienvenido administrador</h1>
        </div>
        <div class="baja-section">
            <a class="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
  
    <br>

    <!-- Opciones -->
    <h2>¿Qué funcionalidad va a utilizar?</h2>
    <ul>
        <li><a href="adminPedidos.php">Control de pedidos</a></li>
        <br>
        <li><a href="adminClientes.php">Visualizar clientes</a></li>
    </ul>


</body>
</html>
