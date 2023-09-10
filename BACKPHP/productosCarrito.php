<?php

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

// CREAR UNA CONSULTA PREPARADA
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {

    $sql = $con->prepare("SELECT  id,Nombre,Precio,descuento, $cantidad AS cantidad FROM menu WHERE id=? AND Habilitacion='Habilitado'");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
  }
}



?>


<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISVIANSA</title>
    <link rel="icon" href="img/icono.png" />
    <link rel="stylesheet" href="../CSS/carrito.css" />
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

    <section>
      <article class="contacto">
        <h1 class="titulo">CARRITO</h1>
        <article class="camino">
          <!-- <a class="index" href="../index.php">Inicio /</a>
        <a class="nosotros" href="../Funcionalidades/catalogo.php">Catalogo</a> -->
        </article>
      </article>
    </section>
    <br><br>
    <section>
      <article class="container">
        <article class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Productos</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if ($lista_carrito == null) {
                echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
              } else {
                $total = 0;
                foreach ($lista_carrito as $producto) {
                  $_id = $producto['id'];
                  $nombre = $producto['Nombre'];
                  $precio = $producto['Precio'];
                  $descuento = $producto['descuento'];
                  $cantidad = $producto['cantidad'];
                  $precio_desc = $precio - (($precio * $descuento) / 100);
                  $subtotal = $cantidad * $precio_desc;
                  $total += $subtotal;
                  ?>
                  <tr>
                    <td>
                      <?php echo $nombre; ?>
                    </td>
                    <td>
                      <?php echo '$' . number_format($precio, 0, '.', ','); ?>
                      <?php if ($descuento > 0) { ?>
                        <del class="no-underline-orange">
                          <?php echo number_format($descuento, 0, '.', ','); ?>% descuento
                        </del>
                      <?php } ?>
                    </td>
                    <td>
                      <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5"
                        id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                    </td>
                    <td>
                      <article id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                        <?php echo '$' . number_format($subtotal, 0, '.', ','); ?>
                      </article>
                    </td>
                    <td>
                      <a href="#" id="eliminar" class="btn btn-danger btn-sm text-white" data-bs-id="<?php echo $_id; ?>"
                        data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                    </td>
                  </tr>
                <?php } ?>

                <tr>
                  <td colspan="3"> </td>
                  <td colspan="2">
                    <p class="h3" id="total">
                      <?php echo '$' . number_format($total, 0, '.', ','); ?>
                    </p>
                  </td>

                </tr>

              </tbody>
            <?php } ?>
          </table>
        </article>

        <article class="row">
          <article class="col-md-5 offset-md-7 d-grid gap-2">
            <button class="btn btn-primary btn">Realizar pago</button>
          </article>
        </article>

        <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModal">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar el producto de la lista ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>





      </article>
    </section>


    <script>


      let eliminaModal = document.getElementById('eliminaModal');
      eliminaModal.addEventListener('show.bs.modal', function(event){
      let button = event.relatedTarget
      let id = button.getAttribute('data-bs-id')
      let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina') 
      buttonElimina.value = id
      })


      function actualizaCantidad(cantidad, id) {
        let url = 'actualizar_carrito.php';
        let formData = new FormData();
        formData.append('action', 'agregar');
        formData.append('id', id);
        formData.append('cantidad', cantidad);


        fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'

        }).then(response => response.json())
          .then(data => {


            if (data.ok) {
              let divsubtotal = document.getElementById('subtotal_' + id);
              divsubtotal.innerHTML = data.sub;

              let total = 0.0;
              let list = document.getElementsByName('subtotal[]');

              for (let i = 0; i < list.length; i++) {
                let valor = list[i].innerHTML.replace(/[$,]/g, '');
                let valorParsed = parseFloat(valor);
                total += valorParsed;
              }
              total = new Intl.NumberFormat('en-US', {
                minimunFractionDigits: 2
              }).format(total)
              document.getElementById('total').innerHTML = '$' + total;;
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });

      }

      
      function eliminar() {

        let botonElimina =document.getElementById('btn-elimina');
        let id =botonElimina.value;
        let url = 'actualizar_carrito.php';
        let formData = new FormData();
        formData.append('action', 'eliminar');
        formData.append('id', id);
       

        fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'

        }).then(response => response.json())
          .then(data => {
          if (data.ok) {
           location.reload();
          }     

      })
    }
    </script>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"></script>
