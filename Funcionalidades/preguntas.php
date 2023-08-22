<?php
require '../config/config.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISVIANSA</title>
    <link rel="icon" href="img/icono.png" />
    <link rel="stylesheet" href="../CSS/preguntas.css" />
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
          echo   '<li><a class="dropdown-item" href="../registro.php">Registrarse</a></li>';
         echo   '<li><a class="dropdown-item" href="../login.php">Iniciar Sesion</a></li>';
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
          echo  ' <i class="fa-solid fa-user"></i>Usuario </a>';
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


    <section>
      <article class="contacto">
       <h1 class="titulo">Preguntas Frecuentes</h1>
       <article class="camino">
        <a class="index" href="../index.html">Inicio /</a>
        <a class="nosotros" href="../Funcionalidades/preguntas.html">Preguntas</a>
        </article>
      </article>
    </section>

          

    <section class="container">
        <article class="row">
            <article class="container-faq">
      
                <article class="item-faq">
                    <article class="pregunta">
                        <h3>¿Como puedo comprar? <span>P</span></h3>
                        <article class="mas"><i>+</i></article>
                    </article>
                    <article class="respuesta">
                        <p>Para realizar tu compra simplemente debes completar el formulario de nuestra página.Una vez hecho esto, tiene que esperar 24hs que le llegue la confirmacion por correo que su cuenta a sido activada correctamente.<span>R</span></p>
                    </article>
                </article>

                <article class="item-faq">
                    <article class="pregunta">
                        <h3>¿Cómo puedo pagar el servicio de viandas <span>P</span></h3>
                        <article class="mas"><i>+</i></article>
                    </article>
                    <article class="respuesta">
                        <p>El pago del menú de viandas se hace a traves de la plataforma popular y confiable, MercadoPago
                         <br>*<span>R</span></p>
                    </article>
                </article>

                <article class="item-faq">
                    <article class="pregunta">
                        <h3>¿Cuál es la ventaja de elegir viandas saludables? <span>P</span></h3>
                        <article class="mas"><i>+</i></article>
                    </article>
                    <article class="respuesta">
                        <p>Las viandas saludables te permiten ahorrar tiempo en la preparación de comidas, mientras te aseguras de consumir alimentos que respaldan tu bienestar.<span>R</span></p>
                    </article>
                </article>

                <article class="item-faq">
                    <article class="pregunta">
                        <h3>¿Qué son las viandas saludables? <span>P</span></h3>
                        <article class="mas"><i>+</i></article>
                    </article>
                    <article class="respuesta">
                        <p>Las viandas saludables son comidas preparadas con ingredientes frescos y nutritivos, diseñadas para ofrecer una opción conveniente y equilibrada para quienes buscan cuidar su alimentación.<span>R</span></p>
                    </article>
                </article>

                <article class="item-faq">
                    <article class="pregunta">
                        <h3>¿Cómo puedo hacer un pedido y cuál es el proceso de pago? <span>p</span></h3>
                        <article class="mas"><i>+</i></article>
                    </article>
                    <article class="respuesta">
                        <p>Puedes hacer un pedido a través de nuestro sitio web o plataforma en línea. Aceptamos pagos con tarjeta de crédito y otros métodos seguros en línea.<span>R</span></p>
                    </article>
                </article>




            </article>
        </article>
    </section>


    <!-- <footer>
      <section class="footer">
        <article>
             <h2>Footer</h2>
        </article>
      </section>
    </footer>
     --> 

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
  </body>
  </html>


    <script src="../JS/script.js"></script>
       
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
      
</body>
</html>


</html>