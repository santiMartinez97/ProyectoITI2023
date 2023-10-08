<?php
class EstadoVianda {
    private $pdo;
    private $IDVianda;
    private $Estado;
    private $Fecha;

    public function __construct($pdo, $IDVianda, $Estado, $Fecha = null) {
        $this->pdo = $pdo;
        $this->IDVianda = $IDVianda;
        $this->Estado = $Estado;
        $this->Fecha = $Fecha;
    }

    // Getter y Setter para IDVianda
    public function getIDVianda() {
        return $this->IDVianda;
    }

    public function setIDVianda($IDVianda) {
        $this->IDVianda = $IDVianda;
    }

    // Getter y Setter para Estado
    public function getEstado() {
        return $this->Estado;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    // Getter y Setter para Fecha
    public function getFecha() {
        return $this->Fecha;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    // Método para guardar un registro de EstadoVianda en la base de datos
    public function guardar() {
        $sql = "INSERT INTO Estado_Vianda (IDVianda, Estado, Fecha) VALUES (:IDVianda, :Estado, :Fecha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':IDVianda', $this->IDVianda, PDO::PARAM_INT);
        $stmt->bindParam(':Estado', $this->Estado, PDO::PARAM_STR);
        $stmt->bindParam(':Fecha', $this->Fecha, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Método para buscar un registro de EstadoVianda por su IDVianda y Estado
    public static function buscarPorIDYEstado($pdo, $IDVianda, $Estado) {
        $sql = "SELECT * FROM Estado_Vianda WHERE IDVianda = :IDVianda AND Estado = :Estado";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':IDVianda', $IDVianda, PDO::PARAM_INT);
        $stmt->bindParam(':Estado', $Estado, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $estadoVianda = new EstadoVianda($pdo, $row['IDVianda'], $row['Estado'], $row['Fecha']);
            return $estadoVianda;
        } else {
            return null;
        }
    }

    // Método estático para buscar el estado más reciente de una Vianda por su IDVianda
    public static function buscarEstadoActual($pdo, $IDVianda) {
        $sql = "SELECT * FROM Estado_Vianda WHERE IDVianda = :IDVianda ORDER BY Fecha DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':IDVianda', $IDVianda, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $estadoVianda = new EstadoVianda($pdo, $row['IDVianda'], $row['Estado'], $row['Fecha']);
            return $estadoVianda;
        } else {
            return null;
        }
    }

    // Método para eliminar un registro de EstadoVianda
    public function eliminar() {
        $sql = "DELETE FROM Estado_Vianda WHERE IDVianda = :IDVianda AND Estado = :Estado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':IDVianda', $this->IDVianda, PDO::PARAM_INT);
        $stmt->bindParam(':Estado', $this->Estado, PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>