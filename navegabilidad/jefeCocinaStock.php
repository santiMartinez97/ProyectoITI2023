<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$menu = $con->prepare("SELECT Nombre, Stock, StockMaximo, StockMinimo FROM menu WHERE Habilitacion='Habilitado'");
$menu-> execute();
$resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

$menu_array=[];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de cocina | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Jefe de cocina</h1>
        <a class="cerrarSesion"href="cerrar_session.php">Cerrar sesion</a>
    </header>
    
    <br>

    <h2><a class="camino" href="jefeCocina.php">Ver pedidos /</a> Control de stock</h2>

    <!-- Lista de stcok -->

    <article class="pedidos">
    <table>
            <thead>
                <tr>
                    <th class="tablaArriba">Menu</th>
                    <th class="tablaArriba">Stock actual</th>
                    <th class="tablaArriba">Stock minimo</th>
                    <th class="tablaArriba">Stock maximo</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultado as $row) {
                    $menu = $row['Nombre'];
                    $stockActual = $row['Stock'];
                    $stockMinimo = $row['StockMinimo'];
                    $stockMaximo = $row['StockMaximo'];

                    if (!in_array($menu, $menu_array)) {
                        echo '<tr>';
                        echo '<th >'.$menu.'</th> ';
                        echo '<th >'.$stockActual.'</th> ';    
                        echo '<th >'.$stockMinimo.'</th> ';    
                        echo '<th >'.$stockMaximo.'</th> ';    
                        echo '<th><button class="botonAceptar">Agregar</button></th>';
                        echo '<th><button class="botonDesechar">Quitar</button></th>';
                        echo '</tr>';
                        $menu_array[] = $menu;
                     }
                    }
                ?>
            </tbody>
        </table>

    </article>

    <h2>Calendario</h2>
    
    <?php
      // Obtener el mes y el año actual
      $mes_actual = date("n");
      $anio_actual = date("Y");
      $dia_actual = date("j");
    
      // Nombres de los meses y días de la semana
      $nombres_meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      $nombres_dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
      
      // Obtener el primer día del mes
      $primer_dia = mktime(0, 0, 0, $mes_actual, 1, $anio_actual);
      
      // Obtener el número de días en el mes
      $num_dias = date("t", $primer_dia);
      
      // Obtener el día de la semana del primer día del mes
      $dia_semana = date("w", $primer_dia);
      
      // Crear la tabla del calendario
      echo "<table border='1'>";
      echo "<tr><th colspan='7'>" . $nombres_meses[$mes_actual - 1] . " " . $anio_actual . "</th></tr>";
      echo "<tr>";
      
      // Imprimir los nombres de los días de la semana
      foreach ($nombres_dias as $nombre_dia) {
          echo "<th>" . $nombre_dia . "</th>";
      }
      
      echo "</tr><tr>";
      
      // Rellenar los espacios vacíos al principio del mes
      for ($i = 0; $i < $dia_semana; $i++) {
          echo "<td></td>";
      }
      
      // Imprimir los números de los días del mes
      
         for ($dia = 1; $dia <= $num_dias; $dia++) {
        // Agregar la clase "current-day" al día actual
        $clase = ($dia == $dia_actual) ? "class='current-day'" : "";
        echo "<td $clase>" . $dia . "</td>";
        if (($dia + $dia_semana) % 7 == 0) {
            echo "</tr><tr>";
        }
    }
      // Rellenar los espacios vacíos al final del mes
      $espacios_vacios = 7 - (($dia_semana + $num_dias) % 7);
      for ($i = 0; $i < $espacios_vacios; $i++) {
          echo "<td></td>";
      }
      
      echo "</tr></table>";
    ?>

    <footer>
    <section>
      <h3>Jefe de cocina</h3>
    </section>
    </footer>
</body>
</html>
