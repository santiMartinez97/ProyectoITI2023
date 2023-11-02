<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
require '../config/config.php';
require '../config/conexion.php';
include_once '../Clases/clientecomun.php';

$db = new DataBase();
$con = $db->conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Público | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/admin.css" />
    <link rel="stylesheet" href="../CSS/loading.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Atención al público</h1>
        <h2>
        <a class ="nav"href="atencionPublico.php">Menú principal</a>
        <a class ="nav"href="atencionPublicoMenu.php">Consultar menús</a>
        <a class ="nav"href="atencionPublicoEstado.php">Estado pedidos</a>
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>
        </h2>
    </header>

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
    <br>


    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
    
    <div id="loader-div">
        <img class="loader-img" src="../img/loader.gif" style="height: 120px;width: auto;" />
    </div> 

    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/solicitarClientes.js"></script>

</body>
</html>