<?php

require_once 'cliente.php';

class ClienteEmpresa extends Cliente {
    private $RUT;
    private $NombreEmpresa;

    public function __construct($pdo, $email, $contrasenia, $direccion, $habilitacion, $rut, $nombreEmpresa) {
        parent::__construct($pdo, $email, $contrasenia, $direccion, $habilitacion);
        $this->RUT = $rut;
        $this->NombreEmpresa = $nombreEmpresa;
    }

    public function getRUT() {
        return $this->RUT;
    }

    public function getNombreEmpresa() {
        return $this->NombreEmpresa;
    }

    public static function findByRUT($pdo, $rut) {
        $sql = "SELECT * FROM ClienteEmpresa WHERE RUT = :rut";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':rut', $rut, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return null;
        }
    }

    //Método para buscar un cliente empresa por su ID
    public static function findByID($pdo, $id) {
        $cliente = parent::findByID($pdo, $id);

        if ($cliente instanceof Cliente) {
            $sql = "SELECT * FROM ClienteEmpresa WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $clienteEmpresa = new ClienteEmpresa(
                    $pdo,
                    $cliente->getEmail(),
                    '', // Contraseña no se necesita para la búsqueda
                    $cliente->getDireccionCompleta(),
                    $cliente->getHabilitacion(),
                    $row['RUT'],
                    $row['NombreEmpresa']
                );
                $clienteEmpresa->ID = $cliente->getID();
                return $clienteEmpresa;
            }
        }

        return null;
    }

    // Método para crear un nuevo cliente empresa en la base de datos
    public function create() {
        parent::create();
        $sql = "INSERT INTO ClienteEmpresa (ID, RUT, NombreEmpresa) VALUES (:id, :rut, :nombreEmpresa)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':rut', $this->RUT, PDO::PARAM_STR);
        $stmt->bindParam(':nombreEmpresa', $this->NombreEmpresa, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para actualizar la información del cliente empresa
    public function update() {
        parent::update();
        $sql = "UPDATE ClienteEmpresa SET RUT = :rut, NombreEmpresa = :nombreEmpresa WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':rut', $this->RUT, PDO::PARAM_STR);
        $stmt->bindParam(':nombreEmpresa', $this->NombreEmpresa, PDO::PARAM_STR);
        
        return $stmt->execute();
    }
}

?>