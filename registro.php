<?php
require 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="CSS/design.css">
  <title>Registro</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://kit.fontawesome.com/e934b5c028.js" crossorigin="anonymous"></script>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-dark" style="background: rgb(240, 240, 240,0.9); padding: 0px; ">

    <nav class="container justify-content-end">
      <a class="navbar-brand" href="index.php" style="color: rgb(0, 0, 0); ">
        <img src="img/icono.png" class="icono1" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <nav class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fa-solid fa-home"></i> Inicio</a>
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
            echo '<li><a class="dropdown-item" href="registro.php">Registrarse</a></li>';
            echo '<li><a class="dropdown-item" href="login.php">Iniciar Sesion</a></li>';
            echo '<li><hr class="dropdown-divider"></li>';
            echo '</ul>';
            echo '</li>';


            echo '</ul>';




          } else {
            //  $menu = $con->prepare("SELECT  id,Nombre,Precio FROM menu WHERE Habilitacion='Habilitado'");
// $menu-> execute();
// $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);
          

            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo ' <i class="fa-solid fa-user"></i>Usuario </a>';
            echo '<ul class="dropdown-menu">';
            echo '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
            echo '<li><a class="dropdown-item" href="#">Editar perfil</a></li>';
            echo '<li><hr class="dropdown-divider"></li>';
            echo '<li><a class="dropdown-item" href="navegabilidad/cerrar_session.php">Cerrar Sesion</a></li>';
            echo '</ul>';
            echo '</li>';


            echo '</ul>';

          }
          ?>

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

  <!-- Fin de menu -->
  <section>
    <article class="padre">
      <article class="hijo">
        <article class="container my-1">

          <br><br>
          <h1 class="titulo text-center">Formulario de Solicitud</h1> <br>
          <article class="col-12 text-center">
            <select name="tipo_usuario" id="tipo_usuario" onchange="web_empresa()">
              <option value="web">Cliente web</option>
              <option value="empresa">Cliente empresa</option>
            </select><br>
          </article>


          <article id="campos">

            <form id="formulario" class="row no-gutters ">

              <article class="col-6">
                <label></label>
                <input type="text" name="nombre" id="nombre" class="form-control " placeholder="Nombre" required>
                <article>
                  <p id="warnings" class="warnings"></p>
                </article>
              </article>


              <article class="col-6">
                <label></label>
                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" required>
                <article>
                  <p id="warningsApellido" class="warnings"></p>
                </article>
              </article>

              <article class="col-8">
                <label></label>
                <input type="number" name="ci" id="ci" class="form-control" placeholder="Documento" required>
                <article>
                  <p id="warningsCi" class="warnings"></p>
                </article>
              </article>

              <article class="col-7">
                <label></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                <article>
                  <p id="warningsEmail" class="warnings"></p>
                </article>
              </article>

              <article class="col-5">

                <label></label>
                <input type="password" name="password" id="pass" class="form-control" placeholder="Contraseña"
                  requiered>
                <article>
                  <p id="warningsPassword" class="warnings"></p>
                </article>
              </article>

              <article class="container mt-4">
                <select id="dieta" name="dieta" class="form-select gray-text" aria-label="Preferencia de Dieta"
                  required>
                  <option value="" disabled selected>Selecciona una opción...</option>
                  <option value="omnivoro">Omnívoro</option>
                  <option value="vegetariano">Vegetariano</option>
                  <option value="vegano">Vegano</option>
                  <option value="paleo">Paleo</option>
                </select>
              </article>

              <article class="col-8">
                <label></label>
                <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Telefono" required>
                <article>
                  <p id="warningsTelefono" class="warnings"></p>
                </article>
              </article>

              <article class="col-7">

                <label></label>
                <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" required>
                <article>
                  <p id="warningsCalle" class="warnings"></p>
                </article>
              </article>


              <article class="col-5">
                <label></label>
                <input type="number" name="numero" id="numero" class="form-control" placeholder="Numero" required>
                <article>
                  <p id="warningsNumero" class="warnings"></p>
                </article>
              </article>


              <article class="col-6">
                <label></label>
                <input type="text" name="esquina" id="esquina" class="form-control" placeholder="Esquina" required>
                <article>
                  <p id="warningsEsquina" class="warnings"></p>
                </article>
              </article>

              <article class="col-6">
                <label></label>
                <input type="text" name="barrio" id="barrio" class="form-control" placeholder="Barrio" required> <br>
                <article>
                  <p id="warningsBarrio" class="warnings"></p>
                </article>
              </article>
              <article class="col-12 text-center">
                <button class="btn btn-primary " idS="enviar" type="submit">Enviar</button>
              </article>
          </article>
          </form>
        </article>
      </article>
      <article class="mt-3 " id="respuesta"> </article>
    </article>
  </section>




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


  <script src="JS/registro.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>


</body>

</html>