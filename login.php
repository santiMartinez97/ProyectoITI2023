<?php
// Si ya hay una sesión activa, redirecciona al index.
session_start();

// Verificar si hay una sesión activa
if (isset($_SESSION['nombre'])) {
    // Redirigir a index.html si hay una sesión activa
    header("Location: index.php");
    exit; // Salir del script después de la redirección
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
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
              <a class="nav-link" href="#"><i class="fa-solid fa-user"></i> Iniciar sesión</a>
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
    <!-- *************************************************************************** -->
    <section>
    <article class="padre">
      <article class="hijo">
        <article class="container my-1">
          <h1 class="titulo text-center"  id="IniciarS" >Iniciar Sesión</h1>
          <p class="subtitulo">
            ¿Es tu primera vez? <a href="registro.php" class="enlace">registrate</a>
          </p>
          <article id="campos">
            <form id="loginForm" class="row no-gutters">
              <article class="col-12">
                <input
                  class="formulario__input form-control"
                  name="email"
                  type="email"
                  placeholder="Ingrese su email aquí..."
                  required
                />
              </article>
              <br /><br />
              <article class="col-12">
                <input
                  class="formulario__input form-control"
                  name="pass"
                  type="password"
                  placeholder="Ingrese su contraseña aquí..."
                  required
                />
              </article>
              <br />
              <a href="../BACKPHP/passwordReset.php" class="enlace">¿Olvidaste tu contraseña?</a>
              <br /><br />
              <article id="loginError"></article>
              <article class="col-12 text-center">
                <button type="submit" class="btn btn-primary" id="enviar">
                  Iniciar Sesión
                </button>
              </article>
            </form>
          </article>
        </article>
      </article>
    </article>
  </section>
    <!-- *************************************************************************** -->
    <footer class="site-footer">
      <article class="footer-left">
        <p>&copy; 2023 SISVIANSA. Todos los derechos reservados.</p>
        <p>Contacto: contacto@example.com</p>
      </article>
      <article class="footer-right">
        <p>Teléfono: 232066522</p>
        <p>Facebook: Nutribento</p>
      </article>
    </footer>




    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="JS/login.js"></script>
  </body>
</html>
