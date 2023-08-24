<?php



require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

// CREAR UNA CONSULTA PREPARADA
$menu = $con->prepare("SELECT  id,Nombre,Precio FROM menu WHERE Habilitacion='Habilitado'");
$menu->execute();
$resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

$dieta = $con->prepare("SELECT * FROM dieta ");
$dieta->execute();
$resultado2 = $dieta->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISVIANSA</title>
    <link rel="icon" href="img/icono.png" />
    <link rel="stylesheet" href="../CSS/catalogo.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e934b5c028.js" crossorigin="anonymous"></script>
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
            <a class="nav-link" href="../BACKPHP/productosCarrito.php"><i class="fa-solid fa-cart-shopping"></i>
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
              echo ' <i class="fa-solid fa-user"></i>Usuario </a>';
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
              <a class="nav-link" href="contacto.php">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="catalogo.php">Catálogo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="preguntas.php">Preguntas</a>
            </li>
          </ul>
        </nav>
      </nav>
    </nav>

    <section>
      <article class="contacto">
        <h1 class="titulo">CATÁLOGO</h1>
        <article class="camino">
          <a class="index" href="../index.php">Inicio /</a>
          <a class="nosotros" href="../Funcionalidades/catalogo.php">Catalogo</a>
        </article>
      </article>
    </section>


    <article class="col-12 text-center">
      <h2>Menús</h2>
      <div class="styled-select">
        <select class="form-select custom-select" id="tipo_dieta" aria-label="Default select example"
          onchange="filtrarDieta(this.value)">
          <option value="" disabled selected>Selecciona una dieta</option>
          <?php
          $diets_added = []; // Array para almacenar las dietas agregadas
          
          foreach ($resultado2 as $row) {
            $dieta = $row['Tipo'];
            $id = $row['ID'];
            // Verifica si la dieta ya ha sido agregada al menú
            if (!in_array($dieta, $diets_added)) {
              echo '<option value="' . $id . '" >' . $dieta . '</option>';
              $diets_added[] = $dieta; // Agrega la dieta al array de dietas agregadas
            }
          }
          ?>
        </select>
      </div>
    </article>

    <article id="campos">
      <br>
      <section>
        <article class="container">
          <article id="listaMenus" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            <?php foreach ($resultado as $row) { ?>
              <article class="col">
                <article class="card shadow-sm">
                  <?php
                  $id = $row['id'];
                  $imagen = "../imgCatalogo/" . $id . "/img.jpg";

                  if (!file_exists($imagen)) {
                    $imagen = "../imgCatalogo/noimg.jpg";
                  }
                  ?>
                  <img src="<?php echo $imagen; ?>">
                  <article class="card-body">
                    <h5 class="card-title">
                      <?php echo $row['Nombre']; ?>
                    </h5>
                    <p class="card-text">$
                      <?php echo number_format($row['Precio'], 0, '.', ','); ?>
                    </p>
                    <article class="d-flex justify-content-between align-items-center">
                      <article class="btn-group">
                        <!-- URL CON DISTINTO TOKEN -->
                        <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>"
                          class="btn btn-primary">Detalles</a>
                      </article>


                      <?php

                      if (!isset($_SESSION['cliente'])) {
                        echo '<a href="#" class="btn btn-success">Agregar</a>';
                      } else {
                        echo '<button class="btn btn-outline-success" type="button" onclick="agregarProducto(' . $row['id'] . ', \'' . hash_hmac('sha1', $row['id'], KEY_TOKEN) . '\')">Agregar al carrito</button>';

                      }
                      ?>
                    </article>
                  </article>
                </article>
              </article>
            <?php } ?>
          </article>
      </section>
      </section>
      <articule>
        <br>


        <script src="../JS/tipoDieta.js"></script>
        <script>
          function agregarProducto(id, token) {
            let url = '../BACKPHP/carrito.php';
            let formData = new FormData();
            formData.append('id', id);
            formData.append('token', token);


            fetch(url, {
              method: 'POST',
              body: formData,
              mode: 'cors'

            }).then(response => response.json())
              .then(data => {
                if (data.ok) {
                  let elemento = document.getElementById("num_cart");
                  elemento.innerHTML = data.numero;
                }
              })


          }
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
          crossorigin="anonymous"></script>




</php>