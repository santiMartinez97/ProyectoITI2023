<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['atencionPublico'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}
include_once '../clases/pedido_encarga_menu.php';
$menus = new Pedido_Encarga_Menu();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Público | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../css/atencionalpublico.css">
</head>
<body>
     <!-- Header -->
     <header>
        <h1>Bienvenido Personal</h1>
        <h2 class="h2tit">
        <a class="nav" href="atencionPublico.php">Menú principal</a>
        <a class="nav" href="atencionPublicoClientes.php">Visualizar clientes</a> 
        <a class="nav" href="atencionPublicoMenu.php">Ver menús</a> 
        <a class="nav" href="atencionPublicoClientePresencial.php">Alta cliente presencial</a>
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>
    </h2>
    </header>
    <br>


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
            $menus->cambiarEstado($IDPedido, $nuevoEstado);
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
              $menus->controlPedidos();
            ?>
        </tbody>
    </table>

</article>
    <footer>
    <section>
      <h3>Atención al Público</h3>
    </section>
    </footer>
</body>
</html>