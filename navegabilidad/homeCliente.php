<?php

// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['cliente'])){
    echo '
    <script>
       alert("Por favor debes iniciar session");
       window.location = "../index.html";
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
    <title>Document</title>
</head>
<body>
    
<h1>BIENVENIDOS A LA TIENDA</h1>
<a href="cerrar_session.php">Cerrar Session</a>

</body>
</html>