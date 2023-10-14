<?php

class TokenRecuperacion {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function generarToken($idUsuario, $hashToken) {
        // Primero, verifica si el usuario ya tiene un token existente
        $tokenExistente = $this->obtenerTokenPorId($idUsuario);
    
        // Si hay un token existente, elimínalo
        if ($tokenExistente) {
            $this->eliminarTokenPorId($idUsuario);
        }

        // Creamos una fecha de expiración para el token. Durará 30 minutos.
        date_default_timezone_set('America/Montevideo');
        $expiracion = date('Y-m-d H:i:s',time() + 60*30);
    
        // Luego, inserta el nuevo token
        $sql = "INSERT INTO token_recuperacion (idUsuario, hashToken, expiracion) VALUES (:id, :hash, :expiracion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":hash", $hashToken,  PDO::PARAM_STR);
        $stmt->bindParam(":expiracion", $expiracion, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function obtenerTokenPorHash($hashToken) {
        $sql = "SELECT * FROM token_recuperacion WHERE hashToken = :hash";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":hash", $hashToken, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            $expiracion = new DateTime($result['expiracion']);
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('America/Montevideo'));
    
            if ($now < $expiracion) {
                // El token está expirado, elimina la fila y retorna false
                $this->eliminarTokenPorHash($hashToken);
                return false;
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

    public function obtenerTokenPorId($id) {
        $sql = "SELECT * FROM token_recuperacion WHERE idUsuario = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            $expiracion = new DateTime($result['expiracion']);
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('America/Montevideo'));
    
            if ($now > $expiracion) {
                // El token está expirado, elimina la fila y retorna false
                $this->eliminarTokenPorId($id);
                return false;
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }
    

    public function eliminarTokenPorHash($hashToken) {
        $sql = "DELETE FROM token_recuperacion WHERE hashToken = :hash";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":hash", $hashToken, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarTokenPorId($id) {
        $sql = "DELETE FROM token_recuperacion WHERE idUsuario = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>