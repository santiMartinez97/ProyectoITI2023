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
    <link rel="stylesheet" href="../CSS/informatico.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="../img/icono.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
</head>
<body>
    
    <header>
        <div class="gerente-section">
            <h1>Informático</h1>
        </div>
        <div class="baja-section">
        <a class="enlace" href="informaticoBajaM.php">Baja y modificación</a>   
        <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
    <section>
   <article class="padre">
    <article class="hijo">
    
        <article class="container my-1">
  
      
        <h1 class="titulo text-center">Formulario de usuarios</h1> <br>
        <article class="col-12 text-center">
          </article>

            <article id="campos">          

            <form id="formulario" class="row no-gutters" >
        <article class="col-6 grupo" id="grupo__email">
            <article class="grupo__input">
                <input type="email" name="email" id="email" class="formulario__input form-control" placeholder="Email">
            </article>
            <p class="grupo_input-error">Ingrese un email válido</p>
        </article>

        <article class="col-6 grupo" id="grupo__password">
            <article class="grupo__input">
                <input type="password" name="password" id="password" class="formulario__input form-control" placeholder="Contraseña">
            </article>
            <p class="grupo_input-error">Contraseña de 6-17 dígitos</p>
        </article>

        <article class="col-6 grupo">
            <select id="rol" name="rol" class="formulario__input form-select gray-text" aria-label="Rol">
                <option value="" disabled selected>Rol</option>
                <option value="JefeCocina">Jefe de Cocina</option>
                <option value="Informatico">Informático</option>
                <option value="Gerente">Gerente</option>
                <option value="AtencionPublico">Atención al Público</option>
                <option value="Administracion">Administración</option>
            </select>
        </article>

        <article class="col-12 text-center">
            <button class="btn btn-primary" id="enviar" type="submit">Enviar</button>
            <p id="botonAlerta" class="grupo_input-error col-11 text-center">Complete correctamente los campos por favor.</p>
            <p id="errorRepeticion" class="grupo_input-error col-11 text-center"></p>
        </article>
    </form>
</article>
</article>
</article>
</section>

<script src="../JS/validacionRegistroInf.js"></script> 

</body>
</html>