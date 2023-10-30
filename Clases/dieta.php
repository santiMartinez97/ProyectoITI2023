<?php

class Dieta {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para crear una nueva dieta
    public function create($tipo, $descripcion) {
        $sql = "INSERT INTO Dieta (Tipo, Descripcion) VALUES (:tipo, :descripcion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para obtener una dieta por su ID
    public function findByID($id) {
        $sql = "SELECT * FROM Dieta WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return null;
        }
    }

     // Método para obtener una dieta por su ID
     public function NombreDieta($id) {
        $sql = "SELECT * FROM Dieta WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['Tipo'];
        } else {
            return null;
        }
    }


    // Método para obtener una dieta por su tipo
    public function findByTipo($tipo) {
        $sql = "SELECT * FROM Dieta WHERE Tipo = :tipo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    // Método para actualizar una dieta por su ID
    public function update($id, $tipo, $descripcion) {
        $sql = "UPDATE Dieta SET Tipo = :tipo, Descripcion = :descripcion WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para eliminar una dieta por su ID
    public function delete($id) {
        $sql = "DELETE FROM Dieta WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

     // Método para obtener todas las dietas
     public function ObtenerDieta() {
        $dieta = $this->pdo->prepare("SELECT * FROM dieta ");
        $dieta-> execute();
        return $dieta->fetchAll(PDO::FETCH_ASSOC);
        
    }
}


?>