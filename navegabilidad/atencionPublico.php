<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
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
        <a class="nav" href="cerrar_session.php">Cerrar sesión</a>
    </header>
    <br>
    <!-- Opciones -->
    <h2>¿Qué funcionalidad va a utilizar?</h2>
    <h2><a href="atencionPublicoMenu.php">Consultar menus</a></h2>
    <h2> <a href="atencionPublicoEstado.php">Estado pedidos</a></h2>
    <h2><a href="atencionPublicoClientes.php">Solicitar alta cliente</a></h2>

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
</body>
</html>