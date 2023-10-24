<?php

require '../config/conexion.php';

class Stock {
    private $con;

    public function __construct() {
        $db = new DataBase();
        $this->con = $db->conectar();
    }

    public function listarStocks() {
        $menu = $this->con->prepare("SELECT Nombre, Stock, StockMaximo, StockMinimo FROM menu WHERE Habilitacion='Habilitado'");
        $menu->execute();
        $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

        $menu_array = [];
    
        echo '<article class="pedidos">';
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="tablaArriba">Menu</th>';
        echo '<th class="tablaArriba">Stock actual</th>';
        echo '<th class="tablaArriba">Stock minimo</th>';
        echo '<th class="tablaArriba">Stock maximo</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        foreach ($resultado as $row) {
            $menu = $row['Nombre'];
            $stockActual = $row['Stock'];
            $stockMinimo = $row['StockMinimo'];
            $stockMaximo = $row['StockMaximo'];

            if (!in_array($menu, $menu_array)) {
                echo '<tr>';
                echo '<th>' . $menu . '</th>';
                echo '<th>' . $stockActual . '</th>';
                echo '<th>' . $stockMinimo . '</th>';
                echo '<th>' . $stockMaximo . '</th>';
                echo '</tr>';
                $menu_array[] = $menu;
            }
        }
        
        echo '</tbody>';
        echo '</table>';
        echo '</article>';
    }

    
    public function agregarStock($menu, $cantidad) {
        $sql = "UPDATE menu SET Stock = Stock + :cantidad WHERE Nombre = :menu";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':menu', $menu, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Éxito
        } else {
            return false; // Error
        }
    }

    public function quitarStock($menu, $cantidad) {
        $sql = "UPDATE menu SET Stock = Stock - :cantidad WHERE Nombre = :menu";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':menu', $menu, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    public function mostrarCalendario() {
      $mes_actual = date("n");
      $anio_actual = date("Y");
      $dia_actual = date("j");
    
      $nombres_meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      $nombres_dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
      
      $primer_dia = mktime(0, 0, 0, $mes_actual, 1, $anio_actual);
      
      $num_dias = date("t", $primer_dia);
      
      $dia_semana = date("w", $primer_dia);
      
      echo "<table border='1'>";
      echo "<tr><th colspan='7'>" . $nombres_meses[$mes_actual - 1] . " " . $anio_actual . "</th></tr>";
      echo "<tr>";
      
      foreach ($nombres_dias as $nombre_dia) {
          echo "<th>" . $nombre_dia . "</th>";
      }
      
      echo "</tr><tr>";
      
      for ($i = 0; $i < $dia_semana; $i++) {
          echo "<td></td>";
      }
      
         for ($dia = 1; $dia <= $num_dias; $dia++) {
        $clase = ($dia == $dia_actual) ? "class='current-day'" : "";
        echo "<td $clase>" . $dia . "</td>";
        if (($dia + $dia_semana) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

      $espacios_vacios = 7 - (($dia_semana + $num_dias) % 7);
      for ($i = 0; $i < $espacios_vacios; $i++) {
          echo "<td></td>";
      }
      
      echo "</tr></table>";
    }
}

?>