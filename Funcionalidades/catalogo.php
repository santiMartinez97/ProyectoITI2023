<?php

require '../config/conexion.php';
require '../config/config.php';
require '../Clases/menu.php';
require '../Clases/dieta.php';

$db = new DataBase();
$con = $db->conectar();

// CLASE MENU, traer la informacion de los menus para el catalogo
$menu = new Menu($con, null, null, null, null, null, null, null, null, null, null, null);
$resultado = $menu->InfoMenu();


// CLASE DIETA, traer las todas las dietas
$dieta = new Dieta($con);
$resultado2 = $dieta->ObtenerDieta();


?>


<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Catálogo | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/catalogo.css" />
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
        <a class="navbar-brand" href="../index.php" style="color: black">
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
                 echo   '<li><a class="dropdown-item" href="../login.php">Iniciar Sesión</a></li>';
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
                    echo '<li><a class="dropdown-item" href="../navegabilidad/cerrar_session.php">Cerrar Sesión</a></li>';
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
    <div class="styled-select" class="tipo_dieta">
        <select class="form-select custom-select" id="tipo_dieta" aria-label="Default select example" onchange="filtrarDieta(this.value)">
            <option value="" disabled selected>Selecciona una dieta</option>
            <option value="todos">Todas las dietas</option>
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
      <br>
     
  </article>

<article id="campos"> 
 <br>
 <section>
    <div class="container">
        <div id="listaMenus" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach($resultado as $row){ 
                $menu = new Menu(
                  $con,
                  $row['ID'], 
                  null, 
                  $row['Nombre'], 
                  null, 
                  $row['Precio'], 
                  null, null, null, null, null, null
              );
                $id = $menu->getID();
                $imagen = "../imgCatalogo/". $row['Imagen'];

                if(!file_exists($imagen)){
                    $imagen = "../imgCatalogo/noimg.jpg";
                }
                

            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="detalles.php?id=<?php echo $menu->getID(); ?>&token=<?php echo hash_hmac('sha1', $menu->getID(), KEY_TOKEN); ?>">
                            <img src="<?php echo $imagen; ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title "><?php echo $menu->getNombre(); ?></h5>
                            <p class="card-text ">$<?php echo number_format($menu->getPrecio(), 0, '.', '.'); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                   
                                </div>
                                <?php
                                    if(!isset($_SESSION['cliente'])){
                                        echo '<a href="#" class="btn btn-success id="carritoBtn" d-flex justify-content-center align-items-center" onclick="agregarProducto('.$menu->getID().',\''.hash_hmac('sha1', $menu->getID(), KEY_TOKEN).'\')">Agregar al Carrito</a>';
                                    } else {
                                        echo '<button class="btn btn-outline-success" type="button" onclick="agregarProducto(' . $menu->getID() . ', \'' . hash_hmac('sha1', $menu->getID(), KEY_TOKEN) . '\')">Agregar al carrito</button>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

  
 <script src="../JS/tipoDieta.js"></script>
 <script>
                function agregarProducto(id,token){
                       let url = '../BACKPHP/carrito.php';
                      let formData = new FormData();
                      formData.append('id', id);
                      formData.append('token', token);


                      fetch(url, {
                          method: 'POST',
                          body: formData,
                          mode : 'cors'

                      }).then(response => response.json())
                      .then(data => {
                              if(data.ok){
                                  let elemento = document.getElementById("num_cart");
                                  elemento.innerHTML = data.numero;
                              }
                      })


}
</script>

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
      
</php>