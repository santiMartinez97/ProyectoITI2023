<?php
session_start();
if(!isset($_SESSION['admin'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

require '../Clases/pedido_encarga_menu.php';
$control = new Pedido_Encarga_Menu();
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
        <h2>
        <a class ="nav"href="admin.php">Menú principal</a>
        <a class ="nav"href="adminClientes.php">Gestion clientes</a>
        <a class="nav" href="cerrar_session.php">Cerrar Sesión</a>
        </h2>
    </header>
    
    <br>

    <!-- Control de pedidos -->

    <center><h2 class="titulo">Control de pedidos</h2></center>

    <form method="POST">
        <label for="idPedido">ID del Pedido:</label>
            <input type="text" name="IDPedido" id="IDPedido"> 
        <label for="nuevoEstado">Cambiar Estado:</label>
            <select name="nuevoEstado" id="nuevoEstado">
                <option value="solicitado">Solicitado</option>
                <option value="confirmado">Confirmado</option>
                <option value="enviado">Enviado</option>
                <option value="entregado">Entregado</option>
                <option value="rechazado">Rechazado</option>

            </select> 
                <input type="submit" value="Cambiar estado">
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $IDPedido = isset($_POST['IDPedido']) ? $_POST['IDPedido'] : "";
            $nuevoEstado = isset($_POST['nuevoEstado']) ? $_POST['nuevoEstado'] : "";
            $control->cambiarEstado($IDPedido, $nuevoEstado);
        }
    ?>

    <article class="pedidos">

    <table>
        <thead>
            <tr>
                   <th class="tablaArriba">ID Cliente</th>
                    <th class="tablaArriba">ID Pedido</th>
                    <th class="tablaArriba">Fecha</th>
                    <th class="tablaArriba">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $control->controlPedidos();
                ?>
            </tbody>
        </table>

    </article>

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
</body>
</html>
