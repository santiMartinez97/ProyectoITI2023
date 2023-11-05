<?php
class EstadoPedido {
    private $db; // Instancia de la conexión a la base de datos

    // Propiedades que representan las columnas de la tabla Estado_Pedido
    protected $ID;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Método para agregar un nuevo estado a un pedido
    public function agregarEstado($idPedido, $fecha, $estado) {
        $query = "INSERT INTO Estado_Pedido (ID, Estado, Fecha) VALUES (:ID, :Estado, :Fecha)";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Bind de los parámetros
        $stmt->bindParam(":ID", $idPedido);
        $stmt->bindParam(":Estado", $estado);
        $stmt->bindParam(":Fecha", $fecha);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para obtener el estado actual de un pedido
    public function obtenerEstadoActual($idPedido) {
        $query = "SELECT Estado FROM Estado_Pedido WHERE ID = :ID ORDER BY Fecha DESC LIMIT 1";
        
        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Limpiar y validar los datos antes de realizar la consulta
        $idPedido = htmlspecialchars(strip_tags($idPedido));

        // Bind de los parámetros
        $stmt->bindParam(":ID", $idPedido);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['Estado'];
    }

}
?>
