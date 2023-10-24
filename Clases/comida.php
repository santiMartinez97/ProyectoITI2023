<?php
class Comida {
    private $pdo;
    protected $ID;
    private $Nombre;
    private $Habilitacion;
    private $TiempoRealizacion;
    private $VidaUtil;
    private $Descripcion;

    public function __construct($pdo, $ID = null) {
        $this->pdo = $pdo;
        $this->ID = $ID;
    }

    // Getter y Setter para ID
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    // Getter y Setter para Nombre
    public function getNombre() {
        return $this->Nombre;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    // Getter y Setter para Habilitacion
    public function getHabilitacion() {
        return $this->Habilitacion;
    }

    public function setHabilitacion($Habilitacion) {
        $this->Habilitacion = $Habilitacion;
    }

    // Getter y Setter para TiempoRealizacion
    public function getTiempoRealizacion() {
        return $this->TiempoRealizacion;
    }

    public function setTiempoRealizacion($TiempoRealizacion) {
        $this->TiempoRealizacion = $TiempoRealizacion;
    }

    // Getter y Setter para VidaUtil
    public function getVidaUtil() {
        return $this->VidaUtil;
    }

    public function setVidaUtil($VidaUtil) {
        $this->VidaUtil = $VidaUtil;
    }

    // Getter y Setter para Descripcion
    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    // Método para guardar o actualizar una Comida en la base de datos
    public function guardar() {
        if ($this->ID === null) {
            // Si la ID es null, es una nueva Comida, por lo tanto, se inserta
            $sql = "INSERT INTO Comida (Nombre, Habilitacion, TiempoRealizacion, VidaUtil, Descripcion) 
                    VALUES (:Nombre, :Habilitacion, :TiempoRealizacion, :VidaUtil, :Descripcion)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':Nombre', $this->Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Habilitacion', $this->Habilitacion, PDO::PARAM_STR);
            $stmt->bindParam(':TiempoRealizacion', $this->TiempoRealizacion, PDO::PARAM_INT);
            $stmt->bindParam(':VidaUtil', $this->VidaUtil, PDO::PARAM_INT);
            $stmt->bindParam(':Descripcion', $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $this->ID = $this->pdo->lastInsertId();
        } else {
            // Si la ID no es null, es una Comida existente, por lo tanto, se actualiza
            $sql = "UPDATE Comida SET 
                    Nombre = :Nombre,
                    Habilitacion = :Habilitacion,
                    TiempoRealizacion = :TiempoRealizacion,
                    VidaUtil = :VidaUtil,
                    Descripcion = :Descripcion 
                    WHERE ID = :ID";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':ID', $this->ID, PDO::PARAM_INT);
            $stmt->bindParam(':Nombre', $this->Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Habilitacion', $this->Habilitacion, PDO::PARAM_STR);
            $stmt->bindParam(':TiempoRealizacion', $this->TiempoRealizacion, PDO::PARAM_INT);
            $stmt->bindParam(':VidaUtil', $this->VidaUtil, PDO::PARAM_INT);
            $stmt->bindParam(':Descripcion', $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    // Método para buscar una Comida por su ID
    public static function buscarPorID($pdo, $ID) {
        $sql = "SELECT * FROM Comida WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $comida = new Comida($pdo);
            $comida->ID = $row['ID'];
            $comida->Nombre = $row['Nombre'];
            $comida->Habilitacion = $row['Habilitacion'];
            $comida->TiempoRealizacion = $row['TiempoRealizacion'];
            $comida->VidaUtil = $row['VidaUtil'];
            $comida->Descripcion = $row['Descripcion'];
            return $comida;
        } else {
            return null;
        }
    }

    // Método para eliminar una Comida
    public function eliminar() {
        if ($this->ID !== null) {
            $sql = "DELETE FROM Comida WHERE ID = :ID";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':ID', $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            // Establecer ID a null para indicar que la Comida ya no existe en la base de datos
            $this->ID = null;
        }
    }

    // Método para listar todas las comidas disponibles en la base de datos
    public static function listarComidas($pdo) {
        $comidas = array();

        $sql = "SELECT * FROM Comida";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comida = new Comida($pdo);
            $comida->ID = $row['ID'];
            $comida->Nombre = $row['Nombre'];
            $comida->Habilitacion = $row['Habilitacion'];
            $comida->TiempoRealizacion = $row['TiempoRealizacion'];
            $comida->VidaUtil = $row['VidaUtil'];
            $comida->Descripcion = $row['Descripcion'];
            $comidas[] = $comida;
        }

        return $comidas;
    }
}

?>