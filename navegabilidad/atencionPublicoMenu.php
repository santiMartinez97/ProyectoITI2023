<?php
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

include_once '../clases/menu.php';
include_once '../config/conexion.php';

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
    <link rel="stylesheet" href="../css/atencionalpublico.css">
</head>
<body>
     <!-- Header -->
     <header>
        <h1>Bienvenido Personal</h1>
        <h2 class="h2tit">
        <a class="nav" href="atencionPublico.php">Menú principal</a>
        <a class="nav" href="atencionPublicoClientes.php">Visualizar clientes</a>
        <a class="nav" href="atencionPublicoEstado.php">Visualizar estados</a> 
        <a class="nav" href="atencionPublicoClientePresencial.php">Alta cliente presencial</a>
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>

        </h2>
    </header>
    <br>

    <?php
    Menu::listadoMenuSinBoton($con);

    ?>
    <footer>
    <section>
      <h3>Atención al Público</h3>
    </section>
    </footer>
</body>
</html>