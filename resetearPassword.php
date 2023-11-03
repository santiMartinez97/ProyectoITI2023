<?php
require 'config/conexion.php';
require 'Clases/usuario.php';
require 'Clases/tokenPassword.php';

// Si ya hay una sesión activa, redirecciona al index.
session_start();

// Verificar si hay una sesión activa
if (isset($_SESSION['nombre']) || !isset($_GET['token'])) {
    // Redirigir a index.html si hay una sesión activa
    header("Location: index.php");
    exit; // Salir del script después de la redirección
}

$db = new DataBase();
$con = $db->conectar();

$token = $_GET['token'];

$token_hash = hash('sha256', $token);

$objToken = new TokenRecuperacion($con);
$tokenValido = $objToken->obtenerTokenPorHash($token_hash);

//Si el token está expirado
if(!$tokenValido){
    header("Location: recoverPassword.php?status=expired");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cambiar contraseña | NutriBento</title>
    <link rel="icon" href="img/icono.png" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="CSS/design.css" />
    <script src="https://kit.fontawesome.com/e934b5c028.js" crossorigin="anonymous"></script>
    
  </head>
  <body>
    
    <nav
      class="navbar navbar-expand-lg navbar-dark"
      style="background: rgb(240, 240, 240, 0.9); padding: 0px"
    >
      <nav class="container justify-content-end">
        <a class="navbar-brand" href="index.php" style="color: black">
          <img src="img/icono.png" class="icono1" alt=""
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php"
                ><i class="fa-solid fa-home"></i> Inicio</a
              >
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i> Carrito</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fa-solid fa-user"></i> Iniciar sesión</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="Funcionalidades/contacto.php">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Funcionalidades/catalogo.php">Catálogo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Funcionalidades/nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Funcionalidades/preguntas.php">Preguntas</a>
            </li>
          </ul>
        </nav>
      </nav>
    </nav>


    <section class="fondo" >
    <!-- *************************************************************************** -->
    <section>
    <article class="padre">
      <article class="hijo">
        <article class="container my-1">
          <h1 class="titulo text-center"  id="IniciarS" >Cambiar Contraseña</h1>
          <article id="campos">
            <form id="loginForm" class="row no-gutters">
              <article>
                <input
                  name="token"
                  type="hidden"
                  value="<?= htmlspecialchars($token) ?>"
                />
              </article>
              <br /><br />
              <article class="col-12">
                <input
                  class="formulario__input form-control"
                  name="pass"
                  type="password"
                  placeholder="Ingrese su nueva contraseña aquí..."
                  required
                />
              </article>
              <br /><br />
              <article class="col-12">
              <input
                  class="formulario__input form-control"
                  name="passConfirm"
                  type="password"
                  placeholder="Confirme su contraseña..."
                  required
                />
              </article>
              <br /><br />
              <article id="mensajeSalida"></article>
              <article class="col-12 text-center">
                <button type="submit" class="btn btn-primary" id="enviar">
                  Cambiar
                </button>
              </article>
            </form>
          </article>
        </article>
      </article>
    </article>
  </section>
          
  
<footer class="site-footer bg-dark text-white py-0">
  <article class="container">
    <article class="row">
      <article class="col-md-2 col-6 text-center  mx-auto" style="margin-top: 30px;">
        <img src="img/icono.png" alt="Tu imagen" class="imgfooter" style="max-width: 50%; margin: 0 auto;">
      </article>

      <article class="col-md-5 col-12 text-center">
        <br>
        <p>&copy; 2023 SISVIANSA. Todos los derechos reservados.</p>
        <p><i class="fas fa-phone phone-icon"></i>  (+598) 2204 5199</p>
        <p><i class="fas fa-home"></i> Avenida Uruguay 1291</p>
      </article>

      <article class="col-md-5 col-12 text-center" style="margin-top: 26px;">
        <p><i class="fas fa-envelope"></i> EmpresaNutriBento@gmail.com</p>
        <p><i class="fab fa-facebook-square" style="color: #1877f2;"></i> NutriBento</p>
        <p><i class="fab fa-instagram" style="color: #e4405f;"></i> NutriBento</p>
      </article>
    </article>
  </article>
</footer>

    </section>



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="JS/resetpass.js"></script>
  </body>
</html>