<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['gerente'])){
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
    <title>Gerente | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/gerente.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
</head>
<body>
  
  <header>
        <div class="gerente-section">
            <h1>Gerente</h1>
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificacion de menú</a>
        </div>
        <div class="baja-section">
          <a class ="enlace" href="cerrar_session.php">Cerrar Session</a>
        </div>
    </header>
  
  <article class="padre">
    <article class="hijo">
      <article class="container my-3">
  
      <article id="campos">
        <form  class="row no-gutters" id="FrnINS"  action="../persistencia/altaMenu.php" method="post">

  <H2 class="titulo">Formulario de menu</H2>
  
  <article class="col-6 grupo">
  <select id="periodicidad" class="formulario__input form-select gray-text" name="periodicidad">
    <option value="0" disabled selected>Ingrese periodicidad</option>
    <option value="semanal">Semanal</option>
    <option value="quincenal">Quincenal</option>
    <option value="mensual">Mensual</option>
  </select>
  </article>


  <article class="col-6 grupo">
  <select id="dieta" name="dieta" class="formulario__input form-select gray-text" aria-label="Preferencia de Dieta" >
    <option value="0" disabled selected>Seleccione dieta</option>
  </select>
  </article>

  <article class="col-6 grupo" id="grupo__menu">
    <article class="grupo__input">  
      <input type="text" name="menu" id="menu" class="formulario__input form-control" placeholder="Nombre" >
    </article>       
    <p class="grupo_input-error">Ingrese un nombre valido </p>
  </article>
 
  <article class="col-6 grupo">
  <select id="habilitacion" class="formulario__input form-select gray-text" name="habilitacion">
    <option value="0" disabled selected>Habilite o deshabilite</option>
    <option value="Habilitado">Habilitado</option>
    <option value="No habilitado">No habilitado</option>
  </select>
  </article>
 

  <article class="col-6 grupo" id="grupo__precio">
    <article class="grupo__input">  
      <input type="number" name="precio" id="precio" class="formulario__input form-control" placeholder="Precio">
    </article>       
    <p class="grupo_input-error">Ingrese precio valido </p>
  </article>


  <article class="col-6 grupo" id="grupo__descuento">
    <article class="grupo__input">  
      <input type="number" name="descuento" id="descuento" class="formulario__input form-control" placeholder="Descuento">
    </article>       
    <p class="grupo_input-error">Ingrese un descuento valido </p>
  </article>

  <article class="col-6 grupo" id="grupo__stock">
    <article class="grupo__input">  
      <input type="number" name="stock" id="stock" class="formulario__input form-control" placeholder="Stock">
    </article>       
    <p class="grupo_input-error">Ingrese stock valido </p>
  </article>
 
  <article class="col-6 grupo" id="grupo__stockMinimo">
    <article class="grupo__input">  
      <input type="number" name="stockMinimo" id="stockMinimo" class="formulario__input form-control" placeholder="Stock Minimo">
    </article>       
    <p class="grupo_input-error">Ingrese stock valido </p>
  </article>
  
  <article class="col-6 grupo" id="grupo__stockMaximo">
    <article class="grupo__input"> 
        <input type="number" name="stockMaximo" id="stockMaximo" class="formulario__input form-control" placeholder="Stock Maximo">
    </article>       
    <p class="grupo_input-error">Ingrese stock valido </p>
  </article>
  
  <article class="col-6 grupo" id="grupo__descripcion">
    <article class="grupo__input">  
      <input type="text" name="descripcion" id="descripcion" class="formulario__input form-control" placeholder="Descripcion">
    </article>       
    <p class="grupo_input-error">Ingrese una descpricion valida </p>
  </article>

  
 
<br>
  <article  class="col-12 text-center">
    <button id="enviar"class="btn btn-primary" type="submit" >Subir menu</button> 
    <p id="botonAlerta" class="grupo_input-error col-6 text-center">Complete correctamente los campos por favor</p>
    <p id="errorRepeticion" class="grupo_input-error col-6 text-center"></p>
    </article>
  </form>

</article>
</article>
</article>


</body>

<script src="../JS/jquery-3.6.4.min.js"></script>
<script src="../JS/mostrarDietasGerente.js"></script>
<script src="../JS/validacionMenu.js"></script>


</html>