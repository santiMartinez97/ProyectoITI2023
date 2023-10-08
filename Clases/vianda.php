<?php
require_once('estadovianda.php');

class Vianda {
    private $pdo;
    private $ID;
    private $IDComida;
    private $Comida; // Objeto Comida asociado a esta Vianda

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

    // Getter y Setter para IDComida
    public function getIDComida() {
        return $this->IDComida;
    }

    public function setIDComida($IDComida) {
        $this->IDComida = $IDComida;
    }

    // Getter y Setter para Comida (objeto Comida asociado)
    public function getComida() {
        if ($this->Comida === null && $this->IDComida !== null) {
            // Si aún no se ha cargado el objeto Comida, cargarlo desde la base de datos
            $comida = Comida::buscarPorID($this->pdo, $this->IDComida);
            $this->Comida = $comida;
        }
        return $this->Comida;
    }

    // Método para guardar o actualizar una Vianda en la base de datos
    public function guardar() {
        if ($this->ID === null) {
            // Si la ID es null, es una nueva Vianda, por lo tanto, se inserta
            $sql = "INSERT INTO Vianda (IDComida) VALUES (:IDComida)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':IDComida', $this->IDComida, PDO::PARAM_INT);
            $stmt->execute();
            $this->ID = $this->pdo->lastInsertId();
        } else {
            // Si la ID no es null, es una Vianda existente, por lo tanto, se actualiza
            $sql = "UPDATE Vianda SET IDComida = :IDComida WHERE ID = :ID";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':ID', $this->ID, PDO::PARAM_INT);
            $stmt->bindParam(':IDComida', $this->IDComida, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    // Método para buscar una Vianda por su ID
    public static function buscarPorID($pdo, $ID) {
        $sql = "SELECT * FROM Vianda WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $vianda = new Vianda($pdo);
            $vianda->ID = $row['ID'];
            $vianda->IDComida = $row['IDComida'];
            return $vianda;
        } else {
            return null;
        }
    }

    // Método para eliminar una Vianda
    public function eliminar() {
        if ($this->ID !== null) {
            $sql = "DELETE FROM Vianda WHERE ID = :ID";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':ID', $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            // Establecer ID a null para indicar que la Vianda ya no existe en la base de datos
            $this->ID = null;
        }
    }

    // Método para listar todas las viandas disponibles en la base de datos
    public static function listarViandas($pdo) {
        $viandas = array();

        $sql = "SELECT * FROM Vianda";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vianda = new Vianda($pdo);
            $vianda->ID = $row['ID'];
            $vianda->IDComida = $row['IDComida'];
            $viandas[] = $vianda;
        }

        return $viandas;
    }

    // Función para cambiar el estado de la Vianda
    public function cambiarEstado($nuevoEstado) {
        // Obtener la fecha actual
        $fechaActual = date('Y-m-d H:i:s');

        // Crear un nuevo registro de EstadoVianda
        $estadoVianda = new EstadoVianda($this->pdo, $this->getID(), $nuevoEstado, $fechaActual);
        $estadoVianda->guardar();
    }

    // Función para obtener el estado actual de la Vianda
    public function obtenerEstadoActual() {
        $estadoVianda = EstadoVianda::buscarEstadoActual($this->pdo, $this->getID());
        return $estadoVianda;
    }

    // Función para obtener el historial de estados de la Vianda
    public function obtenerHistorialEstados() {
        $historial = array();

        $sql = "SELECT * FROM Estado_Vianda WHERE IDVianda = :IDVianda ORDER BY Fecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':IDVianda', $this->getID(), PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $historial[] = new EstadoVianda($this->pdo, $row['IDVianda'], $row['Estado'], $row['Fecha']);
        }

        return $historial;
    }
}

?>