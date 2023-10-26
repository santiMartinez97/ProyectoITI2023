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

    public function setRUT($rut){
        $this->RUT = $rut;
    }

    public function getNombreEmpresa() {
        return $this->NombreEmpresa;
    }

    public function setNombreEmpresa($nombre){
        $this->NombreEmpresa = $nombre;
    }

    public static function findByRUT($pdo, $rut) {
        $sql = "SELECT * FROM ClienteEmpresa WHERE RUT = :rut";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':rut', $rut, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cliente = parent::findByID($pdo, $row['ID']);
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

    // Método para listar todos los clientes de tipo "ClienteEmpresa"
    public static function listarClientesEmpresa($pdo) {
        $clientesEmpresa = array();

        $sql = "SELECT Cliente.ID, Usuario.Email, Cliente.DireccionCompleta, Cliente.Habilitacion, ClienteEmpresa.RUT, ClienteEmpresa.NombreEmpresa
                FROM ClienteEmpresa
                INNER JOIN Cliente ON ClienteEmpresa.ID = Cliente.ID
                INNER JOIN Usuario ON Cliente.ID = Usuario.ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clienteEmpresa = new ClienteEmpresa(
                $pdo,
                $row['Email'],
                '', // Contraseña no se necesita aquí
                $row['DireccionCompleta'],
                $row['Habilitacion'],
                $row['RUT'],
                $row['NombreEmpresa']
            );
            $clienteEmpresa->ID = $row['ID'];
            $clientesEmpresa[] = $clienteEmpresa;
        }

        return $clientesEmpresa;
    }

    public static function listarEmpresasNoHabilitados($pdo) {
        $clientesComunes = array();

        $sql = "SELECT Cliente.ID, Usuario.Email, Cliente.DireccionCompleta, Cliente.Habilitacion,  ClienteEmpresa.RUT, ClienteEmpresa.NombreEmpresa
                FROM ClienteEmpresa
                INNER JOIN Cliente ON ClienteEmpresa.ID = Cliente.ID
                INNER JOIN Usuario ON Cliente.ID = Usuario.ID WHERE Habilitacion = 'No habilitado'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clienteEmpresa = new ClienteEmpresa(
                $pdo,
                $row['Email'],
                '', // Contraseña no se necesita aquí
                $row['DireccionCompleta'],
                $row['Habilitacion'],
                $row['RUT'],
                $row['NombreEmpresa']
            );
            $clienteEmpresa->ID = $row['ID'];
            $clientesEmpresa[] = $clienteEmpresa;
        }

        return $clientesEmpresa;
    }
}

?>