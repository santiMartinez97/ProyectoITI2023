<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
</head>
<body>
  
    <header>
        <h1>Jefe de cocina</h1>
        <h2 >
            <a class= "nav" href="jefeMain.php">Menu principal</a>
            <a class= "nav" href="jefeCocina.php">Ver pedidos </a>
            <a class= "nav" href="jefeComida.php">Preparacion comidas</a>
            <a class= "nav" href="cerrar_session.php">Cerrar sesion</a>
        </h2>
    
    </header>
    
  <article class="padre">
    <article class="hijo">
      <article class="container my-3">
  
      <article id="campos">
        <form  class="row no-gutters" id="FrnINS"  action="../persistencia/altaMenu.php" method="post">

  <h2 class="titulo">Formulario de menu</h2>
 
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
      <input type="number" name="precio" id="precio" class="formulario__input form-control" placeholder="Vida util">
    </article>       
    <p class="grupo_input-error">Ingrese vida util valida </p>
  </article>


  <article class="col-6 grupo" id="grupo__descuento">
    <article class="grupo__input">  
      <input type="number" name="descuento" id="descuento" class="formulario__input form-control" placeholder="Tiempo realizacion">
    </article>       
    <p class="grupo_input-error">Ingrese un tiempo de realizacion valido</p>
  </article>

  <article class="col-6 grupo" id="grupo__stock">
    <article class="grupo__input">  
      <input type="text" name="descripcion" id="descripcion" class="formulario__input form-control" placeholder="Descripcion">
    </article>       
    <p class="grupo_input-error">Ingrese stock valido </p>
  </article>

 
<br>
  <article  class="col-12 text-center">
    <button id="enviar"class="btn btn-primary" type="submit" >Subir comida</button> 
    <p id="botonAlerta" class="grupo_input-error col-6 text-center">Complete correctamente los campos por favor</p>
    <p id="errorRepeticion" class="grupo_input-error col-6 text-center"></p>
    </article>
  </form>

</article>
</article>
</article>


</body>

<script src="../JS/jquery-3.6.4.min.js"></script>
<script src="../JS/validacionMenu.js"></script>


</html>