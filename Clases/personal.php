<?php
require_once 'usuario.php';
class Personal extends Usuario {
    public function __construct($pdo, $email, $contrasenia) {
        parent::__construct($pdo, $email, $contrasenia);
    }

    public function borrarPorID($id) {
        $sql = "DELETE FROM Personal WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar el registro: " . $e->getMessage();
            return false;
        }
    }
    public function insertarPorID($id) {
        $sql = "INSERT INTO Personal (ID) VALUES (:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al insertar el registro: " . $e->getMessage();
            return false;
        }
    }

   
}

   





   
