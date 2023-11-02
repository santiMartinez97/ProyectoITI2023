<?php
require '../config/config.php';
require '../config/conexion.php';
include_once '../Clases/clientecomun.php';
if(!isset($_SESSION['admin'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

$db = new DataBase();
$con = $db->conectar();

$dieta = $con->prepare("SELECT * FROM dieta ");
$dieta-> execute();
$resultado = $dieta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/admin.css" />
    <link rel="stylesheet" href="../CSS/loading.css"/>
    <link rel="stylesheet" type="text/css" href="../CSS/boostrap.css">
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Administrador</h1>
        <h2 class="h2tit">
            <a class = "nav" href="admin.php">Menú principal</a>
        <a class = "nav" href="adminPedidos.php">Gestión de pedidos</a>
            <a class="nav" href="cerrar_session.php">Cerrar sesión</a>
        </h2>
    </header>
    
    <br>
        
    <section class="cajaSeleccion">
        <select id="tipoCliente"class="seleccionClientes">
                <option value="comun">Clientes común</option> 
                <option value="empresa">Clientes empresa</option> 
        </select>
    </section>
    <br>
    <article class="pedidos">
        <table id="tablaClientes">
        
        </table>

    </article>
    <br>
    <!-- Modal para modificar clientes comunes-->
    <div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FF8000 !important;">
                    <h6 class="modal-title" style="color: #fff; text-align: center;">
                        Actualizar Información
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="POST" action="../BACKPHP/ActualizarCliente.php" onsubmit="return validarFormulario();">
                    <input type="hidden" name="id" value="">
                    <div class="modal-body" id="cont_modal">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">ID</label>
                                    <input type="text" id="modId" name="id" class="form-control" value="" required="true" readonly>
                                </div>
                            </div>
                        </div>
                    


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Email:</label>
                                    <input type="text" id="modEmail" name="email" class="form-control" value="" required="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">CI:</label>
                                    <input type="number" id="modCi" name="ci" class="form-control" value="" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre:</label>
                                    <input type="text" id="modNombre" name="nombre" class="form-control" value="" required="true">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Apellido:</label>
                                    <input type="text" id="modApellido" name="apellido" class="form-control" value="" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Dirección:</label>
                                    <input type="text" id="modDireccion" name="direccion" class="form-control" value="" required="true">
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Teléfono:</label>
                                    <input type="number" id="modTelefono" name="telefono" class="form-control" value="" required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Dieta:</label>
                                    <select id="dieta" name="dieta" class="form-control">
                                        <option value="" id="defaultDieta">Sin dieta</option>
                                        <?php 
                                            foreach($resultado as $row){
                                                $dieta = $row['Tipo'];
                                                $id = $row['ID'];
                                                echo '<option value="' . $id . '" >' . $dieta . '</option>';
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal para clientes empresa -->
    <div class="modal fade" id="modalClienteE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FF8000 !important;">
                    <h6 class="modal-title" style="color: #fff; text-align: center;">
                        Actualizar Información
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="POST" action="../BACKPHP/ActualizarClienteEmpresa.php" onsubmit="return validarFormularioEmpresa();">
                    <input type="hidden" name="id" value="">
                    <div class="modal-body" id="cont_modal">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">ID</label>
                                    <input type="text" id="modIdE" name="id" class="form-control" value="" required="true" readonly>
                                </div>
                            </div>
                        </div>
                    


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Email:</label>
                                    <input type="text" id="modEmailE" name="email" class="form-control" value="" required="true">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">RUT:</label>
                                    <input type="number" id="modRutE" name="rut" class="form-control" value="" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre:</label>
                                    <input type="text" id="modNombreE" name="nombre" class="form-control" value="" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Dirección:</label>
                                    <input type="text" id="modDireccionE" name="direccion" class="form-control" value="" required="true">
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Teléfono:</label>
                                    <input type="number" id="modTelefonoE" name="telefono" class="form-control" value="" required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Dieta:</label>
                                    <select id="dietaE" name="dieta" class="form-control">
                                        <option value="" id="defaultDietaE">Sin dieta</option>
                                        <?php 
                                            foreach($resultado as $row){
                                                $dieta = $row['Tipo'];
                                                $id = $row['ID'];
                                                echo '<option value="' . $id . '" >' . $dieta . '</option>';
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form> 

            </div>
        </div>
    </div>

    <!--Fin de los modal-->

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>

    <div id="loader-div">
        <img class="loader-img" src="../img/loader.gif" style="height: 120px;width: auto;" />
    </div> 
    
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/adminClientes.js"></script>
    <script src="../JS/popper.min.js"></script>
    <script src="../JS/bootstrap.min.js"></script>   
    <script src="../JS/modal.js"></script>   

</body>
</html>