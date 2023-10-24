<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION// 
session_start();
if(!isset($_SESSION['informatico'])){
    echo '
    <script>
       alert("Por favor debes iniciar session");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

require '../config/conexion.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informático | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
</head>
<body>
    

<h1>INFORMATICO</h1>
<a href="informaticoBajaM.php">Baja</a>

<form action="regInformatico.php" method="post">
    <H2>Formulario de usuarios:</H2>
<label>Ingrese email de el usuario:
    <input type="email" name="email" id="email" placeholder="Email">
</label>

<br>

<label>Ingrese contrasena de el usuario:
    <input type="password" name="password" id="password" placeholder="Password" >
</label>

<br>

<label>Rol</label>
<select id="rol" name="rol">
    <option value="" disabled selected>Rol</option>
    <option value="JefeCocina">Jefe de Cocina</option>
    <option value="Informatico">Informático</option>
    <option value="Gerente">Gerente</option>
    <option value="AtencionPublico">Atención al Público</option>
    <option value="Administracion">Administración</option>
</select>
<br>

<button id="enviar"  type="submit" >Enviar</button> 
</form>

<a href="cerrar_session.php">Cerrar Session</a>
</body>
</html>