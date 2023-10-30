<?php


require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();


// Si esta Definido lo recibe- si no toma un dato para que no genere error(le da un dato vacio)
$id = isset($_GET['id']) ? $_GET['id'] : '' ;
$token =isset($_GET['token']) ? $_GET['token'] : '' ;;

if($id == '' || $token == ''){
    echo "Error al procesar la peticion";
    exit;
} else{

 $token_tmp = hash_hmac('sha1', $id , KEY_TOKEN);
//  VERFICIAR QUE EL TOKEN DEL ID SEA IGUAL TOKEN GENERADO
   if($token == $token_tmp){  

    $sql = $con->prepare("SELECT count(id) FROM menu WHERE id=? AND Habilitacion='Habilitado'");
    $sql->execute([$id]);
            if($sql->fetchColumn() > 0 ){

                $sql = $con->prepare("SELECT Nombre,Precio,descripcion,descuento,Imagen FROM menu WHERE id=? AND Habilitacion='Habilitado'");
                $sql->execute([$id]);
                $row = $sql ->fetch(PDO::FETCH_ASSOC);
                $precio = $row['Precio'];
                $nombre = $row['Nombre'];  
                $descripcion = $row['descripcion'];
                $descuento = $row['descuento'];
                $imagen = $row['Imagen'];
                $precio_desc = $precio - (($precio * $descuento) / 100);

             }
   }else{
    echo "Error al procesar la peticion";
    exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $nombre; ?> | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/detalles.css" />
    
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
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
                 echo   '<li><a class="dropdown-item" href="../login.php">Iniciar Sesion</a></li>';
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
                    echo '<li><a class="dropdown-item" href="../navegabilidad/cerrar_session.php">Cerrar Sesion</a></li>';
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
   
    
  

     <section>
      <article class="container">
         <article class="row">
            <article class= "col-md-6 order-md-1" >

            <article id="carouselImages" class="carousel slide">
    <article class="carousel-inner">
        <article class="carousel-item active">
        <?php 
                  $imagen = "../imgCatalogo/". $imagen;

                  if(!file_exists($imagen)){
                        $imagen = "../imgCatalogo/noimg.jpg";
                  }
                  ?>
            <img src=<?php echo $imagen; ?> class="d-block img-fluid" alt="...">
        </article>
    </article>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</article>

            </article>

            <article class= "pack col-md-6 order-md-2" > 
                <h2 class="nombre"><?php echo $nombre ?></h2>

                <?php if($descuento > 0) { ?>
                <p class="precio"><del>$ <?php echo number_format( $row['Precio'],0, '.',','); ?></del></p>
                <h3
                 class="descuento">$ <?php echo number_format($precio_desc); ?>
                <small class="text-success"><?php echo $descuento; ?>% descuento</small>
                </h3>
                    
                <?php } else { ?>
                  
                  <h3 class="precioo">$ <?php echo number_format( $row['Precio'],0, '.',','); ?></h3>
                <?php } ?>

                    <br>
                <ul class="descripcion">
                <?php
                $descripcion = $row['descripcion'];
                $descripcion_array = explode("\n", $descripcion);
                
                foreach ($descripcion_array as $element) {
                    echo "<li>" . nl2br($element) . "</li>";
                }
                  ?>
              </ul>

  <?php
             
    if(!isset($_SESSION['cliente'])){
   
    
    echo '  <article class="d-grid gap-3 col-6">'; 
    echo '   <button id="carritoBtn" class="agregarCarro btn btn-outline-primary" type="button">Agregar al carrito</button>';
    echo ' </article>';
    echo ' </article>';
    
}else{

  echo '  <article class="d-grid gap-3 col-6">';
  echo '<button class="agregarCarro  btn btn-outline-primary" type="button" onclick="agregarProducto(' . $id . ', \'' . $token_tmp . '\')">Agregar al carrito</button>';
  echo ' </article>';
  echo ' </article>';
  echo '</li>';
          
        }
?>   
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
              


            
         </article>
     </section>
    
 <br>
    
 <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>

    <script src="../JS/alertaRegistro.js" ></script>
    
  



 
   
    
</html>