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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 

    <link rel="stylesheet" href="CSS/design.css">
    <link rel="stylesheet" href="CSS/loading.css">
    <title>Registro | NutriBento</title>
    <link rel="icon" href="img/icono.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    /> -->
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
              <a class="nav-link" href="BACKPHP/productosCarrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito</a>
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

<section class="fondo">
<!-- Fin de menu -->
  <section>
   <article class="padre">
  <article class="hijo">
    <article class="container my-1">
          
      
        <h1 class="titulo text-center">Formulario de Solicitud</h1> <br>
        <article class="col-12 text-center">
            <select name="tipo_usuario" id="tipo_usuario" onchange="web_empresa()">
                <option value="web">Cliente web</option>
                <option value="empresa">Cliente empresa</option>
            </select><br> 
          </article>

    
            <article id="campos">
              
            <form id="formulario" class="row no-gutters ">          

              <!-- SEPARAMOS POR GRUPOS CADA CAMPO -->
              
              <!-- Grupo nombre -->
              <article class="col-6 grupo" id="grupo__nombre">
              
                <article class="grupo__input">  
                 <input type="text" name="nombre" id="nombre" class="formulario__input form-control" placeholder="Nombre">
                </article>       
                 <p class="grupo_input-error">Ingrese un nombre valido </p>
              </article>
                
                 <!-- Grupo apellido -->
                <article class="col-6 grupo" id="grupo__apellido">
               
                 <article class="grupo__input">
                  <input type="text" name="apellido" id="apellido" class="formulario__input form-control" placeholder="Apellido">
                 </article>   
                 <p class="grupo_input-error">Ingrese un apellido valido</p>
                </article> 
                
            
                 <!-- Grupo cedula -->
                <article class="col-8 grupo" id="grupo__ci">
                  
                    <article class="grupo__input">
                    <input type="number" name="ci" id="ci" class="formulario__input form-control" placeholder="Documento">
                    </article>  
                    <p class="grupo_input-error">Ingrese su cedula sin puntos ni guiones</p>
                </article >
                
                 <!-- Grupo email -->
                <article class="col-6 grupo" id="grupo__email">
                  
                    <article class="grupo__input">
                    <input type="email" name="email" id="email" class="formulario__input form-control" placeholder="Email">
                    </article> 
                      <p class="grupo_input-error">Ingrese un email valido</p>
                </article>
                
                 <!-- Grupo password -->
                <article class="col-6 grupo" id="grupo__password">
                  
                    <article class="grupo__input">
                    <input type="password" name="password" id="password"  class="formulario__input form-control" placeholder="Contraseña"> 
                  </article>
                      <p class="grupo_input-error">Contraseña de 6-17 digitos</p> 
                </article>
                
                 <!-- Grupo telefono -->
                <article class="col-6 grupo" id="grupo__telefono">
                  
                    <article class="grupo__input">
                    <input type="number" name="telefono" id="telefono" class="formulario__input form-control"  placeholder="Teléfono">
                    </article>
                      <p class="grupo_input-error">Ingrese su número de teléfono </p> 
                </article>
                  
                <!-- Grupo Seleccion de Dieta -->
                <article class="col-6 grupo">
                  <select id="dieta" name="dieta" class="formulario__input form-select gray-text" aria-label="Preferencia de Dieta" >
                    <option value="0" disabled selected>Dieta</option>
                  </select>
                </article>

                 <!-- Grupo calle -->
                <article class="col-7 grupo" id="grupo__calle">
                  
                    <article class="grupo__input">
                    <input type="text" name="calle" id="calle" class="formulario__input form-control" placeholder="Calle">
                    </article>
                      <p class="grupo_input-error">Ingrese una calle valida</p>
                </article>
                
                 <!-- Grupo numero -->
                <article class="col-5 grupo" id="grupo__numero">
                  
                    <article class="grupo__input">
                    <input type="number" name="numero" id="numero" class="formulario__input form-control" placeholder="Número">
                    </article>
                      <p class="grupo_input-error">N° de puerta invalido</p>
                </article>
                
                 <!-- Grupo esquina -->
                <article class="col-6 grupo" id="grupo__esquina">
                  
                    <article id="grupo__input">
                    <input type="text" name="esquina" id="esquina" class="formulario__input form-control" placeholder="Esquina">
                    </article>
                      <p class="grupo_input-error">Ingrese una esquina valida</p>        
                </article>
                
                 <!-- Grupo barrio -->
                <article class="col-6 grupo" id="grupo__barrio">
                  
                    <article  class="grupo__input">
                      <input type="text" name="barrio" id="barrio" class="formulario__input form-control" placeholder="Barrio"> 
                    </article> 
                      <p class="grupo_input-error">Ingrese un barrio valido</p>
                </article>

                <article class="col-12 text-center" >
                  <button class="btn btn-primary " id="enviar"  type="submit" >Enviar</button> 
                  
                  <p id="botonAlerta" class="grupo_input-error col-11 text-center">Complete correctamente los campos por favor</p>
                  <p id="errorRepeticion" class="grupo_input-error col-11 text-center"></p>
                </article>       
        </article>
           </form>
    </article>
</article>
    <article class="mt-3 " id="respuesta">  </article>
</article>
</section>
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
        <p><i class="fas fa-envelope"></i> EmpresaNutribento@gmail.com</p>
        <p><i class="fab fa-facebook-square" style="color: #1877f2;"></i> Nutribento</p>
        <p><i class="fab fa-instagram" style="color: #e4405f;"></i> Nutribento</p>
      </article>
    </article>
  </article>
</footer>

<div id="loader-div">
    <img class="loader-img" src="img/loader.gif" style="height: 120px;width: auto;" />
</div> 

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="JS/jquery-3.6.4.min.js"></script>
    <script src="JS/mostrarDietas.js"></script>
    <script src="JS/registro.js"></script>
  
    </body>
</html>