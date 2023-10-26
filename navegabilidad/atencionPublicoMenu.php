<?php
session_start();
if(!isset($_SESSION['atencionPublico'])){
    echo '
    <script>
       alert("Por favor debes iniciar session");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

include_once '../clases/menu.php';
$menus = new Menu();
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
        <a class="nav" href="atencionPublico.php">Menu principal</a>
        <a class="nav" href="atencionPublicoClientes.php">Visualizar clientes</a>
        <a class="nav" href="atencionPublicoEstado.php">Visualizar estados</a> 
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>

        </h2>
    </header>
    <br>

    <?php
    $menus->listadoMenuSinBoton();

    ?>
    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
</body>
</html>