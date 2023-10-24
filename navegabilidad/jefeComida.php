<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de cocina | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
</head>
<body>
  
    <header>
        <h1>Jefe de cocina</h1>
        <h2 >
            <a class= "nav" href="jefeMain.php">Menu principal</a>
            <a class= "nav" href="jefeCocina.php">Ver pedidos </a>
            <a class= "nav" href="jefeCocinaStock.php">Gestion stock</a>
            <a class= "nav" href="cerrar_session.php">Cerrar sesion</a>
        </h2>
    
    </header>
    
 
    <form class="formulario" id="FrnINS" action="../persistencia/altaMenu.php" method="post">
    <h2 class="titulo">Formulario de Comida</h2>

    <div class="grupo" id="grupo__menu">
        <input type="text" name="menu" id="menu" class="formulario__input" placeholder="Nombre">
        <p class="grupo__input-error">Ingrese un nombre válido</p>
    </div>

    <div class="grupo" id="grupo__habilitacion">
        <select id="habilitacion" class="formulario__input" name="habilitacion">
            <option value="0" disabled selected>Habilitar o Deshabilitar</option>
            <option value="Habilitado">Habilitado</option>
            <option value="No habilitado">No habilitado</option>
        </select>
    </div>

    <div class="grupo" id="grupo__precio">
        <input type="number" name="precio" id="precio" class="formulario__input" placeholder="Precio">
        <p class="grupo__input-error">Ingrese un precio válido</p>
    </div>

    <div class="grupo" id="grupo__descuento">
        <input type="number" name="descuento" id="descuento" class="formulario__input" placeholder="Descuento">
        <p class="grupo__input-error">Ingrese un descuento válido</p>
    </div>

    <div class="grupo" id="grupo__stock">
        <input type="number" name="stock" id="stock" class="formulario__input" placeholder="Stock">
        <p class="grupo__input-error">Ingrese un stock válido</p>
    </div>

    <div class="botones">
        <button id="enviar" class="formulario__button" type="submit">Subir Comida</button>
        <p id="botonAlerta" class="grupo__input-error">Complete correctamente los campos por favor</p>
        <p id="errorRepeticion" class="grupo__input-error"></p>
    </div>
</form>




</body>

<script src="../JS/jquery-3.6.4.min.js"></script>
<script src="../JS/validacionMenu.js"></script>


</html>