<?php
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

    public function __construct($pdo,$ID ,$periodicidad, $nombre, $habilitacion, $precio, $descuento, $stock, $stockMinimo, $stockMaximo, $descripcion, $imagen) {
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
    $menu = $this->pdo->prepare("SELECT ID,Nombre,Precio FROM menu WHERE Habilitacion='Habilitado'");
    $menu->execute();
    return $menu->fetchAll(PDO::FETCH_ASSOC); 
    
}

public function eliminarMenu($menuID) {
    $menu = $this->pdo->prepare("DELETE FROM menu WHERE ID = ?");
    $menu->execute([$menuID]);
    
    return $menu->rowCount() > 0; // Verifica si se eliminó algún registro
}

// Método para listar todos los menúes habilitados por dieta
public static function listarMenusHabilitadosPorDieta($pdo, $idDieta) {
    $listaMenues = array();

    $sql = "SELECT *
    FROM menu
    JOIN menu_sigue_dieta ON menu.ID = menu_sigue_dieta.IDMenu
    WHERE menu_sigue_dieta.IDDieta = :id AND menu.Habilitacion = 'Habilitado';
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idDieta, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $menu = new Menu(
            $pdo,
            $row['ID'],
            $row['Periodicidad'],
            $row['Nombre'],
            $row['Habilitacion'],
            $row['Precio'],
            $row['Descuento'],
            $row['Stock'],
            $row['StockMinimo'],
            $row['StockMaximo'],
            $row['Descripcion'],
            $row['Imagen']
        );
        $listaMenues[] = $menu;
    }

    return $listaMenues;
}

// Método para listar todos los menúes habilitados
public static function listarMenusHabilitados($pdo) {
    $listaMenues = array();

    $sql = "SELECT *
    FROM menu
    WHERE Habilitacion = 'Habilitado';
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $menu = new Menu(
            $pdo,
            $row['ID'],
            $row['Periodicidad'],
            $row['Nombre'],
            $row['Habilitacion'],
            $row['Precio'],
            $row['Descuento'],
            $row['Stock'],
            $row['StockMinimo'],
            $row['StockMaximo'],
            $row['Descripcion'],
            $row['Imagen']
        );
        $listaMenues[] = $menu;
    }

    return $listaMenues;
}

}