<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/admin.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Administrador</h1>
        <a class="cerrarSesion" href="cerrar_session.php">Cerrar sesión</a>
    </header>
    
    <br>

    <!-- Control de pedidos -->
    <h2><a class="camino" href="admin.php">Administrador /</a>Gestión de usuarios</h2>
    <section class="cajaSeleccion">
        <select id="tipoCliente"class="seleccionClientes">
                <option value="comun">Clientes común</option> 
                <option value="empresa">Clientes empresa</option> 
        </select>
    </section>
    <br>
    <article class="pedidos">
        <table id="tablaClientes">
        
        </table>

    </article>

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
    
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/adminClientes.js"></script>
</body>
</html>
