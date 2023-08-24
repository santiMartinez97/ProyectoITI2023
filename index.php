<?php
require 'config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISVIANSA</title>
    <link rel="icon" href="img/icono.png" />
    <link rel="stylesheet" href="CSS/estilos.css"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/e934b5c028.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <!-- Inicio de Menu -->
    <nav
    class="navbar navbar-expand-lg navbar-dark"
    style="background: rgb(240, 240, 240, 0.9); padding: 0px"
  >
    <nav class="container justify-content-end">
      <a class="navbar-brand" href="#" style="color: black">
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
                ><i class="fa-solid fa-home"></i> Inicio</a  >
                </li>
              <a class="nav-link" href="#"
                ><i class="fa-solid fa-cart-shopping"></i> 
                Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;?></span>
                </a
              >
            </li>

            <?php

    if(!isset($_SESSION['cliente'])){
   
    echo  '<li class="nav-item dropdown">';
      echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
          echo  ' <i class="fa-solid fa-user"></i> Iniciar Sesion </a>';
        echo '<ul class="dropdown-menu">';
          echo   '<li><a class="dropdown-item" href="registro.php">Registrarse</a></li>';
         echo   '<li><a class="dropdown-item" href="login.php">Iniciar Sesion</a></li>';
         echo  '<li><hr class="dropdown-divider"></li>';
            echo  '</ul>';
            echo  '</li>';


           echo  '</ul>';
    
}else{
//  $menu = $con->prepare("SELECT  id,Nombre,Precio FROM menu WHERE Habilitacion='Habilitado'");
// $menu-> execute();
// $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

          
echo  '<li class="nav-item dropdown">';
      echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
          echo  ' <i class="fa-solid fa-user"></i> '.$_SESSION['nombre'].'</a>';
        echo '<ul class="dropdown-menu">';
          echo   '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
         echo   '<li><a class="dropdown-item" href="#">Editar perfil</a></li>';
         echo  '<li><hr class="dropdown-divider"></li>';
            echo '<li><a class="dropdown-item" href="navegabilidad/cerrar_session.php">Cerrar Sesion</a></li>';
            echo  '</ul>';
            echo  '</li>';


           echo  '</ul>';

        }
?>

  
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


   
    <!-- Inicio de Slider -->
    
    <section
      id="carouselExampleCaptions"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
    >
      <article class="carousel-indicators conatiner-fluid">
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="3"
          aria-label="Slide 4"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="4"
          aria-label="Slide 5"
        ></button>
      </article>
      <article class="carousel-inner" style="overflow-x: hidden">
        <article class="carousel-item active">
          <img
            src="img/VIANDASSS.jpg"
            style="max-width: 100%"
            class="d-block w-100"
            alt="..."
          />
          <article class="carousel-caption">
            <h2>SISVIANSA</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDAS-3.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>SISVIANSA</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDASSS.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>SISVIANSA</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDAS-3.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>SISVIANSA</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDASSS.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>SISVIANSA</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>
      </article>

      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </section>
    <!-- FIN DEL SLIDER -->
    
      <section>
        <article class="section-title">Preferidos de la Semana</article>
        <article class="section-articles">
          <article
            id="carouselWeeklyCards"
            class="carousel carousel-cards"
            data-bs-ride="carousel"
          >
            <article class="carousel-inner">
              <article class="carousel-item active">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 1</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 2</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 3</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 4</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 5</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 6</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 7</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 8</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 9</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
            </article>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselWeeklyCards"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselWeeklyCards"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </article>
        </article>
      </section>

      <section>
        <article class="section-title">Novedades</article>
        <article class="section-articles">
          <article
            id="carouselNewCards"
            class="carousel carousel-cards"
            data-bs-ride="carousel"
          >
            <article class="carousel-inner">
              <article class="carousel-item active">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 1</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 2</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 3</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 4</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 5</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 6</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 7</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 8</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
              <article class="carousel-item">
                <a href="#"><article class="card">
                  <article class="img-wrapper">
                    <img
                      src="img/menu-placeholder.png"
                      class="d-block w-100"
                      alt="..."
                    />
                  </article>
                  <article class="card-body">
                    <h5 class="card-title text-center">Menú 9</h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and
                      make up the bulk of the card's content.
                    </p>
                  </article>
                </article></a>
              </article>
            </article>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselNewCards"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselNewCards"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </article>
        </article>
      </section>

      <section class="text-center">
        <a href="Funcionalidades/catalogo.php"><button class="btn btn-orange">Ver todos los productos</button></a>
      </section>

    <section class="zonas-disponibles text-center">
      <p class="btn btn-orange disabled">Zonas Disponibles</p>
      <br>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3271.84403218136!2d-56.189107784762164!3d-34.910363380381206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x959f81ceb54e547f%3A0x592102e53ece4546!2sInstituto%20Tecnologico%20de%20Inf%C3%B3rmatica!5e0!3m2!1ses-419!2suy!4v1667431425308!5m2!1ses-419!2suy" width="70%" height="70%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <script src="JS/jquery-3.6.4.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script src="JS/indexjs.js"></script>
  </body>
</html>