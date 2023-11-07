<?php
require 'config/config.php';
require 'config/conexion.php';
require 'Clases/cliente.php';
require 'Clases/menu.php';

$db = new DataBase();
$con = $db->conectar();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NutriBento</title>
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
              <a class="nav-link" href="BACKPHP/productosCarrito.php"
                ><i class="fa-solid fa-cart-shopping"></i> 
                Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;?></span>
                </a
              >
            </li>

            <?php

    if(!isset($_SESSION['cliente'])){
   
    echo  '<li class="nav-item dropdown">';
      echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
          echo  ' <i class="fa-solid fa-user"></i> Iniciar Sesión </a>';
        echo '<ul class="dropdown-menu">';
          echo   '<li><a class="dropdown-item" href="registro.php">Registrarse</a></li>';
         echo   '<li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>';
         echo  '<li><hr class="dropdown-divider"></li>';
            echo  '</ul>';
            echo  '</li>';


           echo  '</ul>';
    
}else if(!isset($_SESSION['ClienteComun'])){
 
          
echo  '<li class="nav-item dropdown">';
      echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
          echo  ' <i class="fa-solid fa-user"></i> '.$_SESSION['nombre'].'</a>';
        echo '<ul class="dropdown-menu">';
          echo   '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
         echo   '<li><a class="dropdown-item" href="BACKPHP/editarPerfilEmpresa.php">Editar Perfil</a></li>';
         echo  '<li><hr class="dropdown-divider"></li>';
            echo '<li><a class="dropdown-item" href="navegabilidad/cerrar_session.php">Cerrar Sesión</a></li>';
            echo  '</ul>';
            echo  '</li>';


           echo  '</ul>';

        }

        else{
                    
          echo  '<li class="nav-item dropdown">';
          echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
              echo  ' <i class="fa-solid fa-user"></i> '.$_SESSION['nombre'].'</a>';
            echo '<ul class="dropdown-menu">';
              echo   '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
            echo   '<li><a class="dropdown-item" href="BACKPHP/editarPerfil.php">Editar Perfil</a></li>';
            echo  '<li><hr class="dropdown-divider"></li>';
                echo '<li><a class="dropdown-item" href="navegabilidad/cerrar_session.php">Cerrar Sesión</a></li>';
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
            <h2>NUTRIBENTO</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDAS-3.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>NUTRIBENTO</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDASSS.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>NUTRIBENTO</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDAS-3.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>NUTRIBENTO</h2>
            <p>
              "La nutrición óptima es comer las cosas adecuadas."<br />Siim Land
            </p>
          </article>
        </article>

        <article class="carousel-item">
          <img src="img/VIANDASSS.jpg" class="d-block w-100" alt="..." />
          <article class="carousel-caption">
            <h2>NUTRIBENTO</h2>
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
        <article class="section-title">Te recomendamos</article>
        <article class="section-articles">
          <article
            id="carouselWeeklyCards"
            class="carousel carousel-cards"
            data-bs-ride="carousel"
          >
            <article class="carousel-inner">
            <?php
              $contadorMenuesInsertados = 0; // Variable utilizada para identificar el primer menú insertado y que sean nueve en lista.

              // Procedimiento para crear un carrusel con los menúes
              function listarMenues($listaMenues, $contadorMenuesInsertados){
                if(empty($listaMenues)){
                  $contadorMenuesInsertados = 9;
                  echo '<p>No se encontraron menús, contacte con gerente.</p>';
                }
                while($contadorMenuesInsertados < 9){
                  foreach($listaMenues as $menu){
                    if($contadorMenuesInsertados == 0){
                      echo '<article class="carousel-item active">';
                      echo '<a href="Funcionalidades/detalles.php?id='.$menu->getID().'&token='.hash_hmac('sha1', $menu->getID(), KEY_TOKEN).'"><article class="card">';
                      echo '<article class="img-wrapper">';
                      echo '<img src="imgCatalogo/'.$menu->getImagen().'" class="d-block w-100" alt="..."/>';
                      echo '</article>';
                      echo '<article class="card-body">';
                      echo '<h5 class="card-title text-center">'.$menu->getNombre().'</h5>';
                      echo '<p class="card-text">';
                      echo $menu->getDescripcion();
                      if($menu->getDescuento() == 0){
                        echo '<h4>$'.$menu->getPrecio().'</h4>';
                      }else{
                        echo '<h4><span style="text-decoration:line-through;">$'.$menu->getPrecio().'</span> <span style="font-weight:bold;">$'.$menu->getPrecio()-($menu->getPrecio()*$menu->getDescuento()/100).'</span></h4>';
                      }
                      echo '</p>';
                      echo '</article>';
                      echo '</article></a>';
                      echo '</article>';

                      $contadorMenuesInsertados++;
                    } else if($contadorMenuesInsertados == 9){
                        break;
                    } else {
                        echo '<article class="carousel-item">';
                        echo '<a href="Funcionalidades/detalles.php?id='.$menu->getID().'&token='.hash_hmac('sha1', $menu->getID(), KEY_TOKEN).'"><article class="card">';
                        echo '<article class="img-wrapper">';
                        echo '<img src="imgCatalogo/'.$menu->getImagen().'" class="d-block w-100" alt="..."/>';
                        echo '</article>';
                        echo '<article class="card-body">';
                        echo '<h5 class="card-title text-center">'.$menu->getNombre().'</h5>';
                        echo '<p class="card-text">';
                        echo $menu->getDescripcion();
                        if($menu->getDescuento() == 0){
                          echo '<h4>$'.$menu->getPrecio().'</h4>';
                        }else{
                          echo '<h4><span style="text-decoration:line-through;">$'.$menu->getPrecio().'</span> <span style="font-weight:bold;">$'.$menu->getPrecio()-($menu->getPrecio()*$menu->getDescuento()/100).'</span></h4>';
                      }
                      echo '</p>';
                      echo '</article>';
                      echo '</article></a>';
                      echo '</article>';

                      $contadorMenuesInsertados++;
                    }

                  }
                }
              }

              // Verificamos si el cliente ha iniciado sesión
              if(isset($_SESSION['id'])){
                $cliente = Cliente::findByID($con, $_SESSION['id']);
                $idDieta = $cliente->getIDDieta();

                // Verificamos si el cliente tiene una dieta
                if($idDieta){
                  $listaMenues = Menu::listarMenusHabilitadosPorDieta($con,$idDieta);
                  if(empty($listaMenues)){
                    $listaMenues = Menu::listarMenusHabilitados($con);
                    listarMenues($listaMenues, $contadorMenuesInsertados);
                  }else{
                    listarMenues($listaMenues,$contadorMenuesInsertados);
                  }
                }else{
                  $listaMenues = Menu::listarMenusHabilitados($con);
                  listarMenues($listaMenues, $contadorMenuesInsertados);
                }
              } else{
                $listaMenues = Menu::listarMenusHabilitados($con);
                listarMenues($listaMenues, $contadorMenuesInsertados);

              }
            ?>
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

      <section class="text-center">
        <a href="Funcionalidades/catalogo.php"><button class="btn btn-orange">Ver todos los productos</button></a>
      </section>

    <section class="zonas-disponibles text-center">
      
      <br><br>
          <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1FFZo3QKHcF3HrOnhi8VaWCPJy0aJu5I&ehbc=2E312F&noprof=1"  width="70%" height="80%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         
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

   

    <script src="JS/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
          $('.card p').each(function() {
            var text = $(this).text();
            var words = text.split(' ');
            if (words.length > 6) {
              var truncatedText = words.slice(0, 6).join(' ') + '...';
              $(this).text(truncatedText);
            }
          });
        });
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script src="JS/indexjs.js"></script>
  </body>
</html>