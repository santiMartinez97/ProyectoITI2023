<?php

require_once 'cliente.php';

class ClienteTelefono extends Cliente {
    private $Telefono;
    public function __construct($pdo, $telefono,$email,$contrasenia,$direccion,$habilitacion) {
        parent::__construct($pdo, $email, $contrasenia, $direccion, $habilitacion);
        $this->Telefono = $telefono;
        
    }

    
    public function getTelefono() {
        return $this->Telefono;
    }

    
    public function setTelefono($telefono) {
        $this->Telefono = $telefono; //
    }
    
    public static function findByID($pdo, $id) {
        $cliente = parent::findByID($pdo, $id);
    
        if ($cliente instanceof Cliente) {
            $sql = "SELECT * FROM clientetelefono WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $clienteTelefono = new ClienteTelefono(
                    $pdo,
                    $row['Telefono'],
                    $cliente->getEmail(),
                    '', // Contraseña no se necesita para la búsqueda
                    $cliente->getDireccionCompleta(),
                    $cliente->getHabilitacion()
                );
                $clienteTelefono->ID = $cliente->getID();
                return $clienteTelefono;
            }
        }
    
        return null;
    }
    
}
