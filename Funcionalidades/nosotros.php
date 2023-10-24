<?php
require '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/sobreNosotros.css" />
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
          <img src="../img/icono.png" class="icono1" alt=""
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
              <a class="nav-link" href="../index.php"
                ><i class="fa-solid fa-home"></i> Inicio</a  >
                </li>
              <a class="nav-link" href="../BACKPHP/productosCarrito.php"
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
          echo   '<li><a class="dropdown-item" href="../registro.php">Registrarse</a></li>';
         echo   '<li><a class="dropdown-item" href="../login.php">Iniciar Sesion</a></li>';
         echo  '<li><hr class="dropdown-divider"></li>';
            echo  '</ul>';
            echo  '</li>';


           echo  '</ul>';

        

    
}else{

          
echo  '<li class="nav-item dropdown">';
      echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
      echo  ' <i class="fa-solid fa-user"></i> '.$_SESSION['nombre'].'</a>';
        echo '<ul class="dropdown-menu">';
          echo   '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
         echo   '<li><a class="dropdown-item" href="#">Editar perfil</a></li>';
         echo  '<li><hr class="dropdown-divider"></li>';
            echo '<li><a class="dropdown-item" href="../navegabilidad/cerrar_session.php">Cerrar Sesion</a></li>';
            echo  '</ul>';
            echo  '</li>';


           echo  '</ul>';

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
    <!-- // Carrusel -->
            <section>
              <article id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <article class="carousel-inner">
                  <article class="carousel-item active">
                    <img src="../img/distribucion_cocina_rte-thegem-blog-default.jpg" class="d-block w-100" id="imagenSobreN1" alt="...">
                   <article class="image-text">NOSOTROS</article>
                   <article class="camino">
                   <a class="index" href="../index.php">Inicio /</a>
                   <a class="nosotros" href="../Funcionalidades/nosotros.php">Nosotros</a>
                   </article>
                  </article>
                </article>
              </article>
            </section>

           


            <section class="container section_2" id="sec">
              
              <h1 class="section_2-title">NutriBento</h1> 
              
              <article class="us">
                <article class="us-paragraph">
                  <p class="parrafo-text">En Nutribento, creemos que una alimentación saludable es mucho más que una tendencia:
                    es un estilo de vida que impacta directamente en nuestro bienestar y calidad de vida. <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis velit, accusamus, iusto corrupti natus </p>

                  <p class="parrafo-text">Fundada con la pasión por fomentar hábitos alimenticios conscientes y saludables, 
                    nuestra empresa se dedica a proporcionar viandas
                     nutricionales a nuestros clientes.</p>

                  <p class="parrafo-text">  Nuestra historia comenzó con la visión de crear
                     una alternativa que rompiera con la idea de que lo saludable es sinónimo de aburrido o insípido. </p>

                    
                  <p class="parrafo-text"> Creemos fervientemente 
                    que cuidar de uno mismo no debe ser una tarea monótona, sino una celebración de sabores auténticos y nutritivos.</p>
                </article>

                <article class="us-img">
                    <img src="../img/SobreNosotros1.jpg" alt="" class="img-img">
                </article>
              </article>

            </section>

            <!-- Necesario el br para las pantallas full hd, para que no quede un espaciado -->
  <br><br><br><br><br><br> 
<footer class="site-footer bg-dark text-white py-0">
  <article class="container">
    <article class="row">
      <article class="col-md-2 col-6 text-center  mx-auto" style="margin-top: 30px;">
        <img src="../img/icono.png" alt="Tu imagen" class="imgfooter" style="max-width: 50%; margin: 0 auto;">
      </article>

      <article class="col-md-5 col-12 text-center">
        <br>
        <p>&copy; 2023 SISVIANSA. Todos los derechos reservados.</p>
        <p><i class="fas fa-phone phone-icon"></i>  (+598) 2204 5199</p>
        <p><i class="fas fa-home"></i> Avenida Uruguay 1291</p>
      </article>

      <article class="col-md-5 col-12 text-center" style="margin-top: 26px;">
        <p><i class="fas fa-envelope"></i> EmpresaNutribento@gmail.com</p>
        <p><i class="fab fa-facebook-square" style="color: #1877f2;"></i> Nutribento</p>
        <p><i class="fab fa-instagram" style="color: #e4405f;"></i> Nutribento</p>
      </article>
    </article>
  </article>
</footer>








    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
      




               
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
      
            
          </body>
          