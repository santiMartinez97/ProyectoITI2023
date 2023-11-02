<?php
require '../config/config.php';
require '../config/conexion.php';

if(!isset($_SESSION['informatico'])){
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
    <title>Informatico | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/admin.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/boostrap.css">
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Informatico</h1>
        <a class="cerrarSesion" href="cerrar_session.php">Cerrar sesión</a>
        <a href="informatico.php">Alta</a>
    </header>
    
  
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

                <form method="POST" action="../BACKPHP/ActualizarPersonal.php" onsubmit="return validarInformatico();">
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
                                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Puesto:</label>
                                    <select id="modPuesto" name="puesto" class="puesto form-control" required="true">
                                        <option value="" disabled selected>Selecciona un puesto</option>
                                        <option value="JefeCocina">Jefe de Cocina</option>
                                        <option value="Informatico">Informático</option>
                                        <option value="Gerente">Gerente</option>
                                        <option value="AtencionPublico">Atención al Público</option>
                                        <option value="Administracion">Administración</option>
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
  
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/informatico.js"></script>
    <script src="../JS/popper.min.js"></script>
    <script src="../JS/bootstrap.min.js"></script>   
    <script src="../JS/modal.js"></script>

</body>
</html>
