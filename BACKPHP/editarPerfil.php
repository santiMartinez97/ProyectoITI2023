<?php

require '../config/config.php';
require '../config/conexion.php';
require '../Clases/clientecomun.php';
require '../Clases/clienteTelefono.php';
require '../Clases/clienteSigueDieta.php';
require_once '../Clases/dieta.php';


$db = new DataBase();
$con = $db->conectar();

$idCliente = $_SESSION['id'];



 $usuario = ClienteComun::findByID($con, $idCliente);
 $usuarioTelefono = ClienteTelefono::findByID($con, $idCliente);
 $usuarioDieta = ClienteDieta::findByID($con, $idCliente);


 if ($usuarioDieta !== null) {
  if ($usuarioDieta->getIDdieta() === null) {
      $usuarioDietaDefinido = "Sin especificar";
  } else {
      $idUsuarioDieta = $usuarioDieta->getIDdieta();
      $dieta = new Dieta($con);
      $usuarioDietaDefinido = $dieta->NombreDieta($idUsuarioDieta);
  }
} else {
  $usuarioDietaDefinido = "Sin especificar";
}
 
 $dire = $usuario-> getDireccionCompleta();
 
  preg_match('/^([^\\-]+)/', $dire, $matches);
  $barrio = $matches[1];
  
  preg_match('/^[^-]+-([^\\-]+)/', $dire, $matches);
  $calle = $matches[1];


  preg_match('/^[^-]+-[^-]+-([^\\-]+)/', $dire, $matches);
  $numero = $matches[1];
  

  preg_match('/^[^-]+-[^-]+-[^-]+-([^\\-]+)/', $dire, $matches);
  $esquina = $matches[1];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/design2.css">
    <title>Registro | NutriBento</title>
    <link rel="icon" href="img/icono.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
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
            <a class="nav-link" href="productosCarrito.php"><i class="fa-solid fa-cart-shopping"></i>
              Carrito <span id="num_cart" class="badge bg-secondary">
                <?php echo $num_cart; ?>
              </span>
            </a>
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
  
}else if(!isset($_SESSION['ClienteComun'])){

        
echo  '<li class="nav-item dropdown">';
    echo   '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';        
        echo  ' <i class="fa-solid fa-user"></i> '.$_SESSION['nombre'].'</a>';
      echo '<ul class="dropdown-menu">';
        echo   '<li><a class="dropdown-item" href="#">Ver Perfil</a></li>';
       echo   '<li><a class="dropdown-item" href="../BACKPHP/editarPerfilEmpresa.php">Editar perfil</a></li>';
       echo  '<li><hr class="dropdown-divider"></li>';
          echo '<li><a class="dropdown-item" href="navegabilidad/cerrar_session.php">Cerrar Sesion</a></li>';
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
          echo   '<li><a class="dropdown-item" href="../BACKPHP/editarPerfil.php">Editar perfil</a></li>';
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

    </nav>

<section class="fondo">
<!-- Fin de menu -->
  <section>
   <article class="padre">
  <article class="hijo">
    <article class="container my-1">
          <br>
    <article class="inicio text-center">
  <h3 class="d-flex align-items-center  custom-font">&nbsp;
    <!-- SI HAY TIEMPO SE PUEDE PONER UNA FOTO QUE EL USUARIO QUIERA -->
    <i class="fa-solid fa-user mr-2"></i>&nbsp;&nbsp;Editar perfil 
  </h3>
  <article class="col-12 text-center">
    <!-- Contenido adicional aquí -->
  </article>
</article>

    
            <article id="campos">
              
            <form id="formulario" class="row no-gutters ">          

              <!-- SEPARAMOS POR GRUPOS CADA CAMPO -->
              
              <!-- Grupo nombre -->
              <article class="col-6 grupo" id="grupo__nombre">
              
                <article class="grupo__input">  
                 <input type="text" name="nombre" id="nombre" class="formulario__input form-control"  value="<?php echo $usuario->getNombre(); ?>"  placeholder="Nombre">
                </article>       
                 <p class="grupo_input-error">Ingrese un nombre valido </p>
              </article>
                
                 <!-- Grupo apellido -->
                <article class="col-6 grupo" id="grupo__apellido">
               
                 <article class="grupo__input">
                  <input type="text" name="apellido" id="apellido" class="formulario__input form-control"  value="<?php echo  $usuario->getApellido(); ?>" placeholder="Apellido">
                 </article>   
                 <p class="grupo_input-error">Ingrese un apellido valido</p>
                </article> 
                
            
               
                
                 <!-- Grupo email -->
                <article class="col-7 grupo" id="grupo__email">
                  
                    <article class="grupo__input">
                    <input type="email" name="email" id="email" class="formulario__input form-control"  value="<?php echo $usuario->getEmail(); ?>" placeholder="Email">
                    </article> 
                      <p class="grupo_input-error">Ingrese un email valido</p>
                </article>
                
                 <!-- Grupo telefono -->
                <article class="col-5 grupo" id="grupo__telefono">
                    <article class="grupo__input">
                    <input type="number" name="telefono" id="telefono" class="formulario__input form-control" value="<?php echo $usuarioTelefono->getTelefono(); ?>"   placeholder="Teléfono">
                    </article>
                      <p class="grupo_input-error">Ingrese su número de teléfono </p> 
                </article>
                  
                <!-- Grupo Seleccion de Dieta -->
                <article class="col-6 grupo">
                  <select id="dieta" name="dieta" class="formulario__input form-select gray-text"  aria-label="Preferencia de Dieta" >
                    <option value="0"><?php echo $usuarioDietaDefinido; ?></option>
                  </select>
                </article>

                 <!-- Grupo calle -->
                <article class="col-7 grupo" id="grupo__calle">
                  
                    <article class="grupo__input">
                    <input type="text" name="calle" id="calle" class="formulario__input form-control" placeholder="Calle"  value="<?php echo $calle; ?>">
                    </article>
                      <p class="grupo_input-error">Ingrese una calle valida</p>
                </article>
                
                 <!-- Grupo numero -->
                <article class="col-5 grupo" id="grupo__numero">
                  
                    <article class="grupo__input">
                    <input type="number" name="numero" id="numero" class="formulario__input form-control" placeholder="Número" value="<?php echo $numero; ?>">
                    </article>
                      <p class="grupo_input-error">N° de puerta invalido</p>
                </article>
                
                 <!-- Grupo esquina -->
                <article class="col-6 grupo" id="grupo__esquina">
                  
                    <article id="grupo__input">
                    <input type="text" name="esquina" id="esquina" class="formulario__input form-control" placeholder="Esquina" value="<?php echo $esquina; ?>">
                    </article>
                      <p class="grupo_input-error">Ingrese una esquina valida</p>        
                </article>
                
                 <!-- Grupo barrio -->
                <article class="col-6 grupo" id="grupo__barrio">
                  
                    <article  class="grupo__input">
                      <input type="text" name="barrio" id="barrio" class="formulario__input form-control" placeholder="Barrio" value="<?php echo $barrio; ?>"> 
                    </article> 
                      <p class="grupo_input-error">Ingrese un barrio valido</p>
                </article>
         
                <article class="col-12 text-center" >
                  
                  <button class="btn btn-primary "  id="enviar"  type="submit" >Actualizar</button> 
                
                  <p id="botonAlerta" class="grupo_input-error col-11 text-center">Complete correctamente los campos por favor</p>
                  <p id="errorRepeticion" class="grupo_input-error col-11 text-center"></p>
                  <br><br>
                </article>       
        </article>
           </form>
    </article>
</article>
    <article class="mt-3 " id="respuesta">  </article>
</article>
</section>
</section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/mostrarDietasPerfil.js"></script>
    <script src="../JS/editarPerfil.js"></script> 
  

    </body>



</html>