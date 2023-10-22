<?php

require '../config/config.php';
require '../config/conexion.php';
require '../vendor/autoload.php';


MercadoPago\SDK::setAccessToken(TOKEN_MP);
$preference = new MercadoPago\Preference();
$productos_mp = array();


$db = new DataBase();
$con = $db->conectar();

// CREAR UNA CONSULTA PARA NOMBRE DE PERFIL
$cliente = $con->prepare("SELECT ID FROM cliente ");
$cliente-> execute();
$cliente1 = $cliente->fetchAll(PDO::FETCH_ASSOC);


// CREAR UNA CONSULTA PARA NOMBRE DE PERFIL
$menu = $con->prepare("SELECT  id,Nombre,Precio FROM menu WHERE Habilitacion='Habilitado'");
$menu-> execute();
$resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

$dieta = $con->prepare("SELECT * FROM dieta ");
$dieta-> execute();
$resultado2 = $dieta->fetchAll(PDO::FETCH_ASSOC);


// CREAR UNA CONSULTA PREPARADA
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {

    $sql = $con->prepare("SELECT  id,Nombre,Precio,descuento, $cantidad AS cantidad FROM menu WHERE id=? AND Habilitacion='Habilitado'");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
  }
}else{
  header("Location: index.php");
  exit;
}



?>


<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISVIANSA</title>
    <link rel="icon" href="img/icono.png" />
    <link rel="stylesheet" href="../CSS/carrito.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e934b5c028.js" crossorigin="anonymous"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="https://www.mercadopago.com/v2/security.js"></script>
    
  </head>

  <body>
    <!-- Inicio de Menu -->

    <nav class="navbar navbar-expand-lg navbar-dark" style="background: rgb(240, 240, 240, 0.9); padding: 0px">
      <nav class="container justify-content-end">
        <a class="navbar-brand" href="#" style="color: black">
          <img src="../img/icono.png" class="icono1" alt="" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php"><i class="fa-solid fa-home"></i> Inicio</a>
            </li>
            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i>
              Carrito <span id="num_cart" class="badge bg-secondary">
                <?php echo $num_cart; ?>
              </span>
            </a>
            </li>
            <?php


            if (!isset($_SESSION['cliente'])) {

              echo '<li class="nav-item dropdown">';
              echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
              echo ' <i class="fa-solid fa-user"></i> Iniciar Sesion </a>';
              echo '<ul class="dropdown-menu">';
              echo '<li><a class="dropdown-item" href="../registro.php">Registrarse</a></li>';
              echo '<li><a class="dropdown-item" href="../login.php">Iniciar Sesion</a></li>';
              echo '<li><hr class="dropdown-divider"></li>';
              echo '</ul>';
              echo '</li>';
              echo '</ul>';
            } else {

              echo '<li class="nav-item dropdown">';
              echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
              echo  ' <i class="fa-solid fa-user"></i> '.$_SESSION['nombre'].'</a>';
              echo '<ul class="dropdown-menu">';
              echo '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
              echo '<li><a class="dropdown-item" href="#">Editar perfil</a></li>';
              echo '<li><hr class="dropdown-divider"></li>';
              echo '<li><a class="dropdown-item" href="../navegabilidad/cerrar_session.php">Cerrar Sesion</a></li>';
              echo '</ul>';
              echo '</li>';
              echo '</ul>';
            }
            ?>

          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="../funcionalidades/Contacto.php">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../funcionalidades/catalogo.php">Catálogo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../funcionalidades/nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../funcionalidades/preguntas.php">Preguntas</a>
            </li>
          </ul>
        </nav>
      </nav>
    </nav>

    <section>
      <article class="contacto">
        <h1 class="titulo">CARRITO</h1>
        <article class="camino">
          <!-- <a class="index" href="../index.php">Inicio /</a>
        <a class="nosotros" href="../Funcionalidades/catalogo.php">Catalogo</a> -->
        </article>
      </article>
    </section>
    <br><br>

    <section>
      <article class="container">
        <article class="row">
        <article class="col-6">
            <ar class="video-container">
        <iframe width="550" height="300" src="https://www.youtube.com/embed/Kb73RmknnQw" frameborder="0" allowfullscreen></iframe>
    </div>
        </article>
  
        <article class="col-6">
       
        <article class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Productos</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            
            <tbody>
              <?php if ($lista_carrito == null) {
                echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
              } else {
                $total = 0;
                foreach ($lista_carrito as $producto) {
                  $_id = $producto['id'];
                  $nombre = $producto['Nombre'];
                  $precio = $producto['Precio'];
                  $descuento = $producto['descuento'];
                  $cantidad = $producto['cantidad'];
                  $precio_desc = $precio - (($precio * $descuento) / 100);
                  $subtotal = $cantidad * $precio_desc;
                  $total += $subtotal;
                 
                  $item = new MercadoPago\Item();
                  $item->id= $_id;
                  $item->title = $nombre;
                  $item->quantity = $cantidad;
                  $item->unit_price = $precio_desc;
                  array_push($productos_mp, $item);
                  unset($item);
                
    
                  ?>
                  <tr>
                    <td>
                      <?php echo $nombre; ?>
                     
                    </td>               
                    <td>
                      <article id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                        <?php echo '$' . number_format($subtotal, 0, '.', ','); ?>
                      </article>
                    </td>
                    </td>
                    <td>
                  </tr>
                <?php } ?>

                <tr>
                  <td colspan="3"> </td>
                  <td colspan="2">
                    <p class="h3" id="total">
                      <?php echo '$' . number_format($total, 0, '.', ','); ?>
                    </p>
                  </td>
                 
                </tr>

              </tbody>
           
            <?php 

          
          
          }
            
            
            
            ?>
          </table>
          <div id="wallet_container"></div>
        </article>
        
        </article>
        </article>
      </article>
    </section>

    <?php
    $preference->items = $productos_mp;
    
$preference->back_urls = array(
  "success" => "http://localhost/proyectoITI2023/captura.php",
  "failure" => "http://localhost/proyectoITI2023/fallo.php"
);

$preference->auto_return = "approved";
$preference->binary_mode= true;

$preference->save();
  

    ?>




    <style>
        .video-container {
            float: right; /* Alinea el elemento a la derecha */
        }

    </style>


<script>
            
 const mp = new MercadoPago('TEST-541f11cc-8d3b-4750-aac2-52e3b54050d1', {
    locale: 'es-UY',
});
const bricksBuilder = mp.bricks();
const preferenceId = '<?php echo $preference->id; ?>';

mp.bricks().create("wallet", "wallet_container", {
    initialization: {
       preferenceId: preferenceId,
        redirectMode: "modal"
    },
});




</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"></script>
