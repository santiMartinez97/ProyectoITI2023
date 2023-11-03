<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['gerente'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

include '../BACKPHP/consultas.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/gerente.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
</head>
<body class="bodyGerente">
  
    <header>
        <div class="gerente-section">
            <h1>Estadísticas de NutriBento</h1>
            <a class="enlace" href="gerente.php">Alta de menú</a>
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificación de menú</a>
            <a class="enlace" href="gerenteDieta.php">Gestión dietas</a>
        </div>
        <div class="baja-section">
            <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
  
    <main class="mainEstadisticas">
        <section class="estadisticas">
            <div class="estadistica">
                <h2>Total de Clientes Registrados</h2>
                <p><?php echo $nClientes; ?></p>
            </div>
            <div class="estadistica">
                <h2>Total de Clientes Comúnes</h2>
                <p><?php echo $nClientesComunes; ?></p>
            </div>
            <div class="estadistica">
                <h2>Total de Clientes Empresa</h2>
                <p><?php echo $nClientesEmpresa; ?></p>
            </div>
        </section>

        <section class="estadisticas">
            <div class="estadistica">
                <h2>Dieta más seguida por los clientes</h2>
                <p><?php echo $nombreDietaMasDemanda; ?></p>
                <p class="porcentaje"><?php echo $porcentajeClienteDieta; ?>%</p>
            </div>
        </section>

        <section class="estadisticas-tabla">
            <h2>Viandas por estado</h2>
            <div class="estado">
                <h3>Solicitado</h3>
                <p><?php echo $solicitadas; ?></p>
            </div>
            <div class="estado">
                <h3>En stock</h3>
                <p><?php echo $enStock; ?></p>
            </div>
            <div class="estado">
                <h3>En producción</h3>
                <p><?php echo $enProduccion; ?></p>
            </div>
            <div class="estado">
                <h3>Envasado</h3>
                <p><?php echo $envasado; ?></p>
            </div>
            <div class="estado">
                <h3>Entregado</h3>
                <p><?php echo $entregado; ?></p>
            </div>
            <div class="estado">
                <h3>Devuelto</h3>
                <p><?php echo $devuelto; ?></p>
            </div>
            <div class="estado">
                <h3>Desechado</h3>
                <p><?php echo $desechado; ?></p>
            </div>
        </section>

        <section class="estadisticas-tabla">
            <h2>Viandas Solicitadas por Día</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($solicitadasPorDia as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Fecha'].'</td>';
                            echo '<td>'.$row['CantidadViandasSolicitadas'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Viandas Producidas por Día</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($producidasPorDia as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Fecha'].'</td>';
                            echo '<td>'.$row['CantidadViandasProducidas'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Viandas Producidas por Semana</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Semana</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($producidasPorSemana as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Semana'].'</td>';
                            echo '<td>'.$row['CantidadViandasEnProduccion'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Viandas Producidas por Mes</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($producidasPorMes as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Mes'].'</td>';
                            echo '<td>'.$row['CantidadViandasEnProduccion'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas">
            <div class="estadistica">
                <h2>Viandas Producidas en Total</h2>
                <p><?php echo $producidasTotal; ?></p>
            </div>
        </section>

        <section class="estadisticas-tabla">
            <h2>Menús por Dieta</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Tipo de Dieta</th>
                        <th>Cantidad de Menús</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($menusPorDieta as $row){
                            echo '<tr>';
                            echo '<td>'.$row['TipoDieta'].'</td>';
                            echo '<td>'.$row['CantidadMenus'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Recaudado por día</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Recaudación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($recaudadoPorDia as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Fecha'].'</td>';
                            echo '<td>$'.round($row['Recaudado']).'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Recaudado por semana</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Semana</th>
                        <th>Recaudación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($recaudadoPorSemana as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Semana'].'</td>';
                            echo '<td>$'.round($row['Recaudado']).'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Recaudado por mes</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Recaudación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($recaudadoPorMes as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Mes'].'</td>';
                            echo '<td>$'.round($row['Recaudado']).'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas">
            <div class="estadistica">
                <h2>Total de pedidos</h2>
                <p><?php echo $nPedidos; ?></p>
            </div>
        </section>

        <section class="estadisticas-tabla">
            <h2>Pedidos por día</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($pedidosPorFecha as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Fecha'].'</td>';
                            echo '<td>'.$row['TotalPedidos'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Pedidos por semana</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Semana</th>
                        <th>Pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($pedidosPorSemana as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Semana'].'</td>';
                            echo '<td>'.$row['TotalPedidos'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Pedidos por mes</h2>
            <table class="tabla-estadisticas">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($pedidosPorMes as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Mes'].'</td>';
                            echo '<td>'.$row['TotalPedidos'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Ventas por Menú</h2>
            <table class="tabla-estadisticas tabla-menu">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Menú</th>
                        <th>Stock vendido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($ventasPorMenu as $row){
                            echo '<tr>';
                            echo '<td>'.$row['IDMenu'].'</td>';
                            echo '<td>'.$row['NombreMenu'].'</td>';
                            echo '<td>'.$row['TotalStockVendido'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Ventas de Menú por fecha</h2>
            <table class="tabla-estadisticas tabla-menu-fecha">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>ID</th>
                        <th>Menú</th>
                        <th>Stock vendido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($ventasMenuPorFecha as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Fecha'].'</td>';
                            echo '<td>'.$row['IDMenu'].'</td>';
                            echo '<td>'.$row['NombreMenu'].'</td>';
                            echo '<td>'.$row['TotalStockVendido'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Ventas de Menú por semana</h2>
            <table class="tabla-estadisticas tabla-menu-fecha">
                <thead>
                    <tr>
                        <th>Semana</th>
                        <th>ID</th>
                        <th>Menú</th>
                        <th>Stock vendido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($ventasMenuPorSemana as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Semana'].'</td>';
                            echo '<td>'.$row['IDMenu'].'</td>';
                            echo '<td>'.$row['NombreMenu'].'</td>';
                            echo '<td>'.$row['TotalStockVendido'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="estadisticas-tabla">
            <h2>Ventas de Menú por mes</h2>
            <table class="tabla-estadisticas tabla-menu-fecha">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>ID</th>
                        <th>Menú</th>
                        <th>Stock vendido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($ventasMenuPorMes as $row){
                            echo '<tr>';
                            echo '<td>'.$row['Mes'].'</td>';
                            echo '<td>'.$row['IDMenu'].'</td>';
                            echo '<td>'.$row['NombreMenu'].'</td>';
                            echo '<td>'.$row['TotalStockVendido'].'</td>';
                            echo '<tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>


</body>

<script src="../JS/jquery-3.6.4.min.js"></script>


</html>