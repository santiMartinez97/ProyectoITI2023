<?php

require_once 'cliente.php';

class ClienteComun extends Cliente {
    private $CI;
    private $Nombre;
    private $Apellido;

    public function __construct($pdo, $email, $contrasenia, $direccion, $habilitacion, $ci, $nombre, $apellido) {
        parent::__construct($pdo, $email, $contrasenia, $direccion, $habilitacion);
        $this->CI = $ci;
        $this->Nombre = $nombre;
        $this->Apellido = $apellido;
    }

    public function getCI() {
        return $this->CI;
    }

    public function setCI($ci){
        $this->CI = $ci;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setNombre($nombre){
        $this->Nombre = $nombre;
    }

    public function getApellido() {
        return $this->Apellido;
    }

    public function setApellido($apellido){
        $this->Apellido = $apellido;
    }

    public function getNombreCompleto(){
        return $this->Nombre.' '.$this->Apellido;
    }

    // Método para buscar un cliente común por CI
    public static function findByCI($pdo, $ci) {
        $sql = "SELECT * FROM ClienteComun WHERE CI = :ci";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ci', $ci, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cliente = parent::findByID($pdo, $row['ID']);
            $clienteComun = new ClienteComun(
                $pdo,
                $cliente->getEmail(),
                '', // Contraseña no se necesita para la búsqueda
                $cliente->getDireccionCompleta(),
                $cliente->getHabilitacion(),
                $row['CI'],
                $row['Nombre'],
                $row['Apellido']
            );
            $clienteComun->ID = $cliente->getID();
            return $clienteComun;
        } else {
            return null;
        }
    }

    // Método para buscar un cliente común por su ID
    public static function findByID($pdo, $id) {
        $cliente = parent::findByID($pdo, $id);

        if ($cliente instanceof Cliente) {
            $sql = "SELECT * FROM ClienteComun WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $clienteComun = new ClienteComun(
                    $pdo,
                    $cliente->getEmail(),
                    '', // Contraseña no se necesita para la búsqueda
                    $cliente->getDireccionCompleta(),
                    $cliente->getHabilitacion(),
                    $row['CI'],
                    $row['Nombre'],
                    $row['Apellido']
                );
                $clienteComun->ID = $cliente->getID();
                return $clienteComun;
            }
        }

        return null;
    }

    // Método para crear un nuevo cliente común en la base de datos
    public function create() {
        parent::create();
        $sql = "INSERT INTO ClienteComun (ID, CI, Nombre, Apellido) VALUES (:id, :ci, :nombre, :apellido)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':ci', $this->CI, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $this->Nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $this->Apellido, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para actualizar la información del cliente común
    public function update() {
        parent::update();
        $sql = "UPDATE ClienteComun SET CI = :ci, Nombre = :nombre, Apellido = :apellido WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':ci', $this->CI, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $this->Nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $this->Apellido, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para listar todos los clientes comunes
    public static function listarClientesComunes($pdo) {
        $clientesComunes = array();

        $sql = "SELECT Cliente.ID, Usuario.Email, Cliente.DireccionCompleta, Cliente.Habilitacion, ClienteComun.CI, ClienteComun.Nombre, ClienteComun.Apellido
                FROM ClienteComun
                INNER JOIN Cliente ON ClienteComun.ID = Cliente.ID
                INNER JOIN Usuario ON Cliente.ID = Usuario.ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clienteComun = new ClienteComun(
                $pdo,
                $row['Email'],
                '', // Contraseña no se necesita aquí
                $row['DireccionCompleta'],
                $row['Habilitacion'],
                $row['CI'],
                $row['Nombre'],
                $row['Apellido']
            );
            $clienteComun->ID = $row['ID'];
            $clientesComunes[] = $clienteComun;
        }

        return $clientesComunes;
    }
}

?>