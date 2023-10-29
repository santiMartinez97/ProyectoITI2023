<?php
require_once('estadovianda.php');
require '../config/conexion.php';
$db = new DataBase();
$con = $db->conectar();
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
    public function listarViandas($pdo) {
        $viandas = $pdo->prepare("SELECT via.ID, via.Nombre, via.VidaUtil, est.Estado, est.Fecha FROM vianda AS via INNER JOIN estado_vianda AS est ON via.ID = est.IDVianda");
        $viandas->execute();
        $resultado = $viandas->fetchAll(PDO::FETCH_ASSOC);
    
        $viandas_array = [];
    
        echo '<div class="tabla-container">';
        echo '<article class="pedidos">';
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="tablaArriba">ID</th>';
        echo '<th class="tablaArriba">Nombre</th>';
        echo '<th class="tablaArriba">Vida util</th>';
        echo '<th class="tablaArriba">Estado</th>';
        echo '<th class="tablaArriba">Fecha</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($resultado as $row) {
            $ID = $row['ID'];
            $nombre = $row['Nombre'];
            $vidautil = $row['VidaUtil'];
            $estado = $row['Estado'];
            $fecha = $row['Fecha']; 
            if (!in_array($row, $viandas_array)) { 
                echo '<form method="POST">';
                echo '<tr>';
                echo '<th >'.$ID .'</th>';
                echo '<th >'.$nombre .'</th>';
                echo '<th >'.$vidautil.'</th>';
                echo '<th >'.$estado.'</th>';
                echo '<th >'.$fecha.'</th>';
                echo '<th><button class="botonAceptar" name="botonAceptar" value="'.$ID.'">Completar</button></th>';
                echo '<th><button class="botonDesechar" name="botonDesechar" value="'.$ID.'">Desechar</button></th>';
                echo '</tr>';
                echo '</form>';
                
            }
        }
        echo '</tbody>';
        echo '</table>';

        echo '</article>';
        echo '<div/>';
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