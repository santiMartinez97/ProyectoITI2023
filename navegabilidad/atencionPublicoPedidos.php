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

require_once "../config/conexion.php";
require_once "../Clases/clientecomun.php";
require_once "../Clases/clienteempresa.php";
require_once "../Clases/menu.php";

$db = new DataBase();
$con = $db->conectar();

$listaClientesComunes = ClienteComun::listarClientesComunes($con);
$listaClientesEmpresa = ClienteEmpresa::listarClientesEmpresa($con);
$listaMenus = Menu::listarMenusHabilitados($con);

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
        <a class="nav" href="atencionPublicoPedidos.php">Pedidos</a>
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>
    </h2>
    </header>
    <br>
    <main id="formularioPedidos">
        <h1 class="titlePedidos">Formulario de Pedidos</h1>
        <form id="pedido-form" action="../BACKPHP/aPublicoAltaPedido.php" method="post">
            <label for="cliente">Cliente:</label>
            <select id="cliente" name="cliente">
                <?php
                    foreach($listaClientesComunes as $cliente){
                        echo '<option value="'.$cliente->getID().'">'.$cliente->getCI().' - '.$cliente->getNombre().' '.$cliente->getApellido().'</option>';
                    }

                    foreach($listaClientesEmpresa as $empresa){
                        echo '<option value="'.$empresa->getID().'">'.$empresa->getRUT().' - '.$empresa->getNombreEmpresa().'</option>';
                    }
                ?>
            </select>

            <label for="menu">Menú:</label>
            <select id="menu" name="menu" multiple>
                <?php
                    foreach($listaMenus as $menu){
                        echo '<option data-max="'.$menu->getStock().'" value="'.$menu->getID().'">'.$menu->getNombre().' - $'.$menu->getPrecio().'</option>';
                    }
                ?>
            </select>

            <div id="cantidad-menu">
                <!-- Aquí se agregarán los campos de cantidad dinámicamente -->
            </div>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea><br>

            <button type="button" id="agregar-menu">Agregar Menú</button>
            <br>

            <button type="submit">Enviar Pedido</button>
        </form>
    </main>


    <footer>
    <section>
      <h3>Atención al Público</h3>
    </section>
    </footer>

    <script src="../JS/aPublicoPedidos.js"></script>
</body>
</html>