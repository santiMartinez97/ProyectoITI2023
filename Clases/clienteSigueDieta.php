<?php

require_once 'cliente.php';

class ClienteDieta extends Cliente {
    private $dieta;

    public function __construct($pdo, $dieta, $email, $contrasenia, $direccion, $habilitacion) {
        parent::__construct($pdo, $email, $contrasenia, $direccion, $habilitacion);
        $this->dieta = $dieta; 
    }

    public function getDieta() {
        return $this->dieta; 
    }

    public function setDieta($dieta) { 
        $this->dieta = $dieta; 

    }
    
    public static function findByID($pdo, $id) {
        $cliente = parent::findByID($pdo, $id);
    
        if ($cliente instanceof Cliente) {
            $sql = "SELECT * FROM clientesiguedieta WHERE IDcliente = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $clienteDieta = new ClienteDieta(
                    $pdo,
                    $row['IDdieta'],
                    $cliente->getEmail(),
                    '', // Contraseña no se necesita para la búsqueda
                    $cliente->getDireccionCompleta(),
                    $cliente->getHabilitacion()
                );
                $clienteDieta->ID = $cliente->getID();
                return $clienteDieta;
            }
        }
    
        return null;
    }
    
}
