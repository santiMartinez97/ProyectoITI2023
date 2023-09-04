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
    <link rel="stylesheet" href="../CSS/admin.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Bienvenido Administrador</h1>
        <a class="cerrarSesion" href="cerrar_session.php">Cerrar sesión</a>
    </header>
    
    <br>

    <!-- Opciones -->

    <h2>¿Qué funcionalidad va a utilizar?</h2>
    <h2><a href="adminPedidos.php">Control de pedidos</a></h2>
    <h2> <a href="adminClientes.php">Visualizar clientes</a></h2>

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
</body>
</html>