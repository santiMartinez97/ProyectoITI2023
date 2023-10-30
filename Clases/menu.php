<?php
require '../config/conexion.php';
class Menu {
    protected $ID;
    private $periodicidad;
    private $nombre;
    private $habilitacion;
    private $precio;
    private $descuento;
    private $stock;
    private $stockMinimo;
    private $stockMaximo;
    private $descripcion;
    private $imagen;

    protected $pdo;
    private $con;

    public function __construct() {
        $db = new DataBase();
        $this->con = $db->conectar();
    }
   /* public function __construct($pdo,$ID ,$periodicidad, $nombre, $habilitacion, $precio, $descuento, $stock, $stockMinimo, $stockMaximo, $descripcion, $imagen) {
        $this->pdo = $pdo;
        $this->ID = $ID;
        $this->periodicidad = $periodicidad;
        $this->nombre = $nombre;
        $this->habilitacion = $habilitacion;
        $this->precio = $precio;
        $this->descuento = $descuento;
        $this->stock = $stock;
        $this->stockMinimo = $stockMinimo;
        $this->stockMaximo = $stockMaximo;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
    }
*/
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    // Getter y Setter para Periodicidad
    public function getPeriodicidad() {
        return $this->periodicidad;
    }

    public function setPeriodicidad($periodicidad) {
        $this->periodicidad = $periodicidad;
    }

    // Getter y Setter para Nombre
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter y Setter para Habilitacion
    public function getHabilitacion() {
        return $this->habilitacion;
    }

    public function setHabilitacion($habilitacion) {
        $this->habilitacion = $habilitacion;
    }

    // Getter y Setter para Precio
    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Getter y Setter para Descuento
    public function getDescuento() {
        return $this->descuento;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    // Getter y Setter para Stock
    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    // Getter y Setter para StockMinimo
    public function getStockMinimo() {
        return $this->stockMinimo;
    }

    public function setStockMinimo($stockMinimo) {
        $this->stockMinimo = $stockMinimo;
    }

    // Getter y Setter para StockMaximo
    public function getStockMaximo() {
        return $this->stockMaximo;
    }

    public function setStockMaximo($stockMaximo) {
        $this->stockMaximo = $stockMaximo;
    }

    // Getter y Setter para Descripcion
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Getter y Setter para Imagen
    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }


public function create() {
    $sql = "INSERT INTO Menu (ID, Periodicidad, Nombre, Habilitacion, Precio, Descuento, Stock, StockMinimo, StockMaximo, Descripcion, Imagen)
            VALUES (:id, :periodicidad, :nombre, :habilitacion, :precio, :descuento, :stock, :stockMinimo, :stockMaximo, :descripcion, :imagen)";
    
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':id', $this->getID(), PDO::PARAM_INT);
    $stmt->bindParam(':periodicidad', $this->getPeriodicidad(), PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $this->getNombre(), PDO::PARAM_STR);
    $stmt->bindParam(':habilitacion', $this->getHabilitacion(), PDO::PARAM_STR);
    $stmt->bindParam(':precio', $this->getPrecio(), PDO::PARAM_INT);
    $stmt->bindParam(':descuento', $this->getDescuento(), PDO::PARAM_INT);
    $stmt->bindParam(':stock', $this->getStock(), PDO::PARAM_INT);
    $stmt->bindParam(':stockMinimo', $this->getStockMinimo(), PDO::PARAM_INT);
    $stmt->bindParam(':stockMaximo', $this->getStockMaximo(), PDO::PARAM_INT);
    $stmt->bindParam(':descripcion', $this->getDescripcion(), PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $this->getImagen(), PDO::PARAM_STR);

    return $stmt->execute();
}

public function update() {
    $sql = "UPDATE Menu SET 
            Periodicidad = :periodicidad,
            Nombre = :nombre,
            Habilitacion = :habilitacion,
            Precio = :precio,
            Descuento = :descuento,
            Stock = :stock,
            StockMinimo = :stockMinimo,
            StockMaximo = :stockMaximo,
            Descripcion = :descripcion,
            Imagen = :imagen
            WHERE ID = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':periodicidad', $this->getPeriodicidad(), PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $this->getNombre(), PDO::PARAM_STR);
    $stmt->bindParam(':habilitacion', $this->getHabilitacion(), PDO::PARAM_STR);
    $stmt->bindParam(':precio', $this->getPrecio(), PDO::PARAM_INT);
    $stmt->bindParam(':descuento', $this->getDescuento(), PDO::PARAM_INT);
    $stmt->bindParam(':stock', $this->getStock(), PDO::PARAM_INT);
    $stmt->bindParam(':stockMinimo', $this->getStockMinimo(), PDO::PARAM_INT);
    $stmt->bindParam(':stockMaximo', $this->getStockMaximo(), PDO::PARAM_INT);
    $stmt->bindParam(':descripcion', $this->getDescripcion(), PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $this->getImagen(), PDO::PARAM_STR);
    $stmt->bindParam(':id', $this->getID(), PDO::PARAM_INT);

    return $stmt->execute();
}

public function delete() {
    $sql = "DELETE FROM Menu WHERE ID = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $this->getID(), PDO::PARAM_INT);
    
    return $stmt->execute();
}

public function InfoMenu(){
    $menu = $this->pdo->prepare("SELECT ID,Nombre,Precio,Imagen FROM menu WHERE Habilitacion='Habilitado'");
    $menu->execute();
    return $menu->fetchAll(PDO::FETCH_ASSOC); 
    
}

public function eliminarMenu($menuID) {
    $menu = $this->pdo->prepare("DELETE FROM menu WHERE ID = ?");
    $menu->execute([$menuID]);
    
    return $menu->rowCount() > 0; // Verifica si se eliminó algún registro
}

public function listadoMenus() {
    $menu = $this->con->prepare("SELECT * FROM menu");
    $menu->execute();
    $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

    $menu_array=[];
    echo '</article>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="tablaArriba">Periocidad</th>';
    echo '<th class="tablaArriba">Menu</th>';
    echo '<th class="tablaArriba">Precio</th>';
    echo '<th class="tablaArriba">Descuento</th>';
    echo '<th class="tablaArriba">Stock</th>';
    echo '<th class="tablaArriba">Stock minimo</th>';
    echo '<th class="tablaArriba">Stock maximo</th>';
    echo '<th class="tablaArriba">Habilitacion</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($resultado as $row) {
        $Periocidad = $row['Periodicidad'];
        $menu = $row['Nombre'];
        $precio = $row['Precio']; 
        $descuento = $row['Descuento']; 
        $stockActual = $row['Stock'];
        $stockMinimo = $row['StockMinimo'];
        $stockMaximo = $row['StockMaximo'];

        if (!in_array($menu, $menu_array)) {      
            echo '<tr data-client-id="'.$row['ID'].'">';
            echo '<th >'.$Periocidad.'</th> ';
            echo '<th >'.$menu.'</th> ';
           
            echo '<th >$' .$precio.'</th> ';
            echo '<th >'.$descuento.'</th> ';
            echo '<th >'.$stockActual.'</th> ';    
            echo '<th >'.$stockMinimo.'</th> ';    
            echo '<th >'.$stockMaximo.'</th> ';    
            include('ModalEditar.php'); 
            

            if($row['Habilitacion'] === "No habilitado"){
                echo '<td data-client-status="false">'.$row['Habilitacion'].'</td>';
                echo '<td><button class="botonAceptar habilitar-btn">Habilitar</button></td>';
                echo '<td><button class="botonDesechar">Eliminar</button></td>';
                echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editChildresn' . $row['ID'] . '">Modificar</button></td>';


            }else{
               echo '<td data-client-status="true">'.$row['Habilitacion'].'</td>';
                echo '<td><button class="botonRechazar habilitar-btn">Deshabilitar</button></td>';
                echo '<td><button class="botonDesechar">Eliminar</button></td>';
                echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editChildresn' . $row['ID'] . '">Modificar</button></td>';
               
            }
         }
        }
        echo '</tr>';
        echo '</tbody>';
        
        echo '</table>';
        
        echo '</article>';
    }

    public function listadoMenuSinBoton() {
        $menu = $this->con->prepare("SELECT * FROM menu");
        $menu->execute();
        $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);
    
        $menu_array=[];
        echo '</article>';
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="tablaArriba">Periocidad</th>';
        echo '<th class="tablaArriba">Menu</th>';
        echo '<th class="tablaArriba">Precio</th>';
        echo '<th class="tablaArriba">Descuento</th>';
        echo '<th class="tablaArriba">Stock</th>';
        echo '<th class="tablaArriba">Stock minimo</th>';
        echo '<th class="tablaArriba">Stock maximo</th>';
        echo '<th class="tablaArriba">Habilitacion</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($resultado as $row) {
            $Periocidad = $row['Periodicidad'];
            $menu = $row['Nombre'];
            $precio = $row['Precio']; 
            $descuento = $row['Descuento']; 
            $stockActual = $row['Stock'];
            $stockMinimo = $row['StockMinimo'];
            $stockMaximo = $row['StockMaximo'];
    
            if (!in_array($menu, $menu_array)) {      
                echo '<tr data-client-id="'.$row['ID'].'">';
                echo '<th >'.$Periocidad.'</th> ';
                echo '<th >'.$menu.'</th> ';
               
                echo '<th >$' .$precio.'</th> ';
                echo '<th >'.$descuento.'</th> ';
                echo '<th >'.$stockActual.'</th> ';    
                echo '<th >'.$stockMinimo.'</th> ';    
                echo '<th >'.$stockMaximo.'</th> ';                    
    
                if($row['Habilitacion'] === "No habilitado"){
                    echo '<th data-client-status="false">'.$row['Habilitacion'].'</th>';
    
                }else{
                   echo '<th data-client-status="true">'.$row['Habilitacion'].'</th>';

                }
             }
            }
            echo '</tr>';
            echo '</tbody>';
            
            echo '</table>';
            
            echo '</article>';
        }
    
}


