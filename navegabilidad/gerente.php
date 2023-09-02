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
    <title>Document</title>
</head>
<body>
  
  <h1>Gerente</h1>
  
<form   id=FrnINS  action="../persistencia/altaMenu.php" method="post">
    
  <H2>Formulario de menues:</H2>
  
  <label for="periodicidad">Periodicidad:</label>
<select id="periodicidad" name="periodicidad">
<option value="semana">Semanal</option>
<option value="quincenal">Quincenal</option>
    <option value="mensual">Mensual</option>
</select>
<br>
  
  <label>Ingrese nombre de el menu:
    <input type="text" name="menu" id="menu" placeholder="Nombre">
  </label>

<br>

<label for="habilitacion">Estado de habilitación:</label>
<select id="habilitacion" name="habilitacion">
    <option value="Habilitado">Habilitado</option>
    <option value="No habilitado">No habilitado</option>
</select>
<br>

  <label>Ingrese precio de el menu:
    <input type="number" name="precio" id="precio" placeholder="Precio">
  </label>

<br>
  
  <label>Ingrese descuento de el menu:
    <input type="number" name="descuento" id="descuento" placeholder="Descuento">
  </label>

  <br>
  
  <label>Ingrese stock de el menu:
    <input type="number" name="stock" id="stock" placeholder="Stock">
  </label>

  <br>
  
  <label>Ingrese stock minimo de el menu:
    <input type="number" name="stockMinimo" id="stockMinimo" placeholder="Stock Minimo">
  </label>

  <br>
  
  <label>Ingrese stock maximo de el menu:
    <input type="number" name="stockMaximo" id="stockMaximo" placeholder="Stock Maximo">
  </label>

  <br>
  
  <label>Ingrese descripcion de el menu:
    <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
  </label>

  <br>
  
  <label>Ingrese imagen de el menu:
    <input type="file" name="imagen" id="imagen" >
  </label>
<br>

<button id="enviar"  type="submit" >Enviar</button> 
</form>

<a href="cerrar_session.php">Cerrar Session</a>
</body>
</html>