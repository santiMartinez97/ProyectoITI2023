<?php
class Pedido {
    private $db; // Instancia de la conexión a la base de datos

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Método para crear un nuevo pedido
    public function crearPedido($fecha, $cliente) {
        $query = "INSERT INTO Pedido (Fecha, IDCliente) VALUES (:Fecha, :IDCliente)";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Bind de los parámetros
        $stmt->bindParam(":Fecha", $fecha);
        $stmt->bindParam(":IDCliente", $cliente);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Método para borrar un pedido
    public function borrarPedido($idPedido) {
        // Borramos el pedido en la tabla Pedido
        $query = "DELETE FROM Pedido WHERE ID = :ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":ID", $idPedido);

        // Intentamos borrar el pedido
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>