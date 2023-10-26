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
    <title>Atencion al publico | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/admin.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Atencion al publico</h1>
        <h2>
        <a class ="nav"href="atencionPublico.php">Menu principal</a>
        <a class ="nav"href="atencionPublicoMenu.php">Consultar menus</a>
        <a class ="nav"href="atencionPublicoEstado.php">Estado pedidos</a>
        <a class="nav" href="cerrar_session.php">Cerrar sesion</a>
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
    
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/solicitarClientes.js"></script>

</body>
</html>