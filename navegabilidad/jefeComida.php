<?php
include_once('../Clases/vianda.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de cocina | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/boostrap.css">

</head>
<body>
  
    <header>
        <h1>Jefe de cocina</h1>
        <h2 >
            <a class= "nav" href="jefeMain.php">Menú principal</a>
            <a class= "nav" href="jefeCocina.php">Ver pedidos </a>
            <a class= "nav" href="jefeCocinaStock.php">Gestión stock</a>
            <a class= "nav" href="cerrar_session.php">Cerrar Sesión</a>
        </h2>
    
    </header>
    <article class="padre">

    <article class="hijo">
      <article class="container my-3">
  
      <article id="campos"> 
  <form  class="row no-gutters" id="FrnINS"  action="../persistencia/altaViandas.php" method="post">

    <H2 class="titulo">Formulario de comidas</H2>

  <article class="col-6 grupo" id="grupo__nombre">
    <article class="grupo__input">  
      <input type="text" name="nombre" id="nombre" class="formulario__input form-control" placeholder="Nombre">
    </article>       
    <p class="grupo_input-error">Ingrese un nombre válido</p>
  </article>


  <article class="col-6 grupo" id="grupo__vidaUtil">
    <article class="grupo__input">  
      <input type="number" name="vidaUtil" id="vidaUtil" class="formulario__input form-control" placeholder="Vida Util">
    </article>
    <p class="grupo_input-error">Ingrese vida util en semanas </p>
    <p class="comentario">* En semanas</p>
  </article>

  <article class="col-6 grupo" id="grupo__cantidad">
    <article class="grupo__input">  
      <input type="number" name="cantidad" id="cantidad" class="formulario__input form-control" placeholder="Cantidad">
    </article>       
    <p class="grupo_input-error">Ingrese cantidad válida</p>
  </article>

  <br>
  <br>
  <br>
  <article class="col-6 grupo" id="grupo__descripcion">
    <article class="grupo__input">  
      <input type="text" name="descripcion" id="descripcion" class="formulario__input form-control" placeholder="Descripción">
    </article>       
    <p class="grupo_input-error">Ingrese una descprición válida</p>
  </article>
  <br>  <br>
  
  <article  class="col-12 text-center">
    <button id="enviar"class="btn btn-primary" type="submit" >Subir viandas</button> 
    <p id="botonAlerta" class="grupo_input-error col-6 text-center">Complete correctamente los campos por favor.</p>
    <p id="errorRepeticion" class="grupo_input-error col-6 text-center"></p>
    </article>
  </form>
  </article>

  </article>
  </article>
  </article>
  </article>

        <?php
          $vianda = new Vianda($con);
          $listaVianda = $vianda->listarViandas($con);
         ?>


</body>
<script src="../JS/jquery-3.6.4.min.js"></script>
<script src="../JS/validacionVianda.js"></script>
<script src="../JS/bootstrap.min.js"></script>        

</html>