<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['gerente'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}
require_once '../Clases/vianda.php';
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
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificación de menú</a>
            <a class="enlace" href="gerenteEstadisticas.php">Estadísticas</a>
        </div>
        <div class="baja-section">
          <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
  
  <article class="padre">
    <article class="hijo">
      <article class="container my-3">
  
      <article id="campos">
        <form  class="row no-gutters" id="FrnINS"  enctype="multipart/form-data" action="../persistencia/altaMenu.php" method="post">

  <H2 class="titulo">Formulario de menú</H2>
  
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
    <p class="grupo_input-error">Ingrese un nombre válido. </p>
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
    <p class="grupo_input-error">Ingrese precio válido. </p>
  </article>


  <article class="col-6 grupo" id="grupo__descuento">
    <article class="grupo__input">  
      <input type="number" name="descuento" id="descuento" class="formulario__input form-control" placeholder="Descuento">
    </article>       
    <p class="grupo_input-error">Ingrese un descuento válido. </p>
  </article>

  <article class="col-6 grupo" id="grupo__stock">
    <article class="grupo__input">  
      <input type="number" name="stock" id="stock" class="formulario__input form-control" placeholder="Stock">
    </article>       
    <p class="grupo_input-error">Ingrese stock válido. </p>
  </article>
 
  <article class="col-6 grupo" id="grupo__stockMinimo">
    <article class="grupo__input">  
      <input type="number" name="stockMinimo" id="stockMinimo" class="formulario__input form-control" placeholder="Stock Minimo">
    </article>       
    <p class="grupo_input-error">Ingrese stock válido. </p>
  </article>
  
  <article class="col-6 grupo" id="grupo__stockMaximo">
    <article class="grupo__input"> 
        <input type="number" name="stockMaximo" id="stockMaximo" class="formulario__input form-control" placeholder="Stock Maximo">
    </article>       
    <p class="grupo_input-error">Ingrese stock válido. </p>
  </article>
  
  <article class="col-6 grupo" id="grupo__descripcion">
    <article class="grupo__input">  
      <input type="text" name="descripcion" id="descripcion" class="formulario__input form-control" placeholder="Descripcion">
    </article>       
    <p class="grupo_input-error">Ingrese una descripción válida. </p>
  </article>

  <article class="col-6 grupo" id="grupo__viandas">
  <article class="grupo__input">
    <select id="viandas" name="viandas" class="formulario__input form-select gray-text" aria-label="Agregar viandas a menu" multiple>
      <option value="">Selecciona un nombre</option>
      <?php
      $viandasListado = new Vianda($con);
      $viandasListado->listadoDistintivo($con);
      ?>
    </select>
  </article>
  <button class="botonAceptar" id="agregarVianda" type="button">Agregar Vianda</button>
  <button class="botonDesechar" id="quitarVianda" type="button">Quitar Vianda</button>
  <p class="grupo_input-error">Ingrese viandas válidas. </p>
</article>

<article class="col-6 grupo" id="grupo__viandasSeleccionadas">
  <article class="grupo__input">
    <p>Viandas seleccionadas: <span id="viandasSeleccionadas"></span></p>
  </article>
</article>

  <article class="col-12 grupo" id="grupo__imagen">
    <label>Subir imagen: <input type="file" name="imagen" id="imagen"></label>
    <p class="grupo_input-error">Solamente se aceptan formatos .jpg, .jpeg, .gif y .png. La imagen no debe superar 1 MB. </p>
  </article><br>
<br>
<br>
  <article  class="col-12 text-center">
    <button id="enviar"class="btn btn-primary" type="submit" >Subir menú</button> 
    <p id="botonAlerta" class="grupo_input-error col-6 text-center">Complete correctamente los campos por favor.</p>
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
<script src="../JS/verViandas.js"></script>


</html>