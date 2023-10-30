<?php

require_once 'usuario.php';
require_once 'dieta.php';

class Cliente extends Usuario {
    private $DireccionCompleta;
    private $Habilitacion;

    public function __construct($pdo, $email, $contrasenia, $direccion, $habilitacion) {
        parent::__construct($pdo, $email, $contrasenia);
        $this->DireccionCompleta = $direccion;
        $this->Habilitacion = $habilitacion;
    }

    public function getDireccionCompleta() {
        return $this->DireccionCompleta;
    }

    public function setDireccionCompleta($direccion) {
        $this->DireccionCompleta = $direccion;
    }

    public function getHabilitacion() {
        return $this->Habilitacion;
    }
    

    public function changeHabilitacion() {
        if ($this->Habilitacion === 'Habilitado') {
            $this->Habilitacion = 'No habilitado';
        } else {
            $this->Habilitacion = 'Habilitado';
        }
    }

    public static function findByID($pdo, $id) {
        $usuario = parent::findBy($pdo, 'ID', $id);

        if ($usuario instanceof Usuario) {
            $sql = "SELECT * FROM Cliente WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $cliente = new Cliente(
                    $pdo,
                    $usuario->getEmail(),
                    '', // Contraseña no se necesita para la búsqueda
                    $row['DireccionCompleta'],
                    $row['Habilitacion']
                );
                $cliente->ID = $usuario->getID();
                return $cliente;
            }
        }

        return null;
    }

    // Método para conseguir dieta que sigue el cliente
    public function getTipoDieta() {
        $sql = "SELECT Dieta.Tipo FROM ClienteSigueDieta
                INNER JOIN Dieta ON ClienteSigueDieta.IDdieta = Dieta.ID
                WHERE ClienteSigueDieta.IDcliente = :idCliente";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['Tipo'];
        } else {
            return null;
        }
    }

    // Método para conseguir id de dieta que sigue el cliente
    public function getIDDieta() {
        $sql = "SELECT IDdieta FROM ClienteSigueDieta
                WHERE IDcliente = :idCliente";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['IDdieta'];
        } else {
            return null;
        }
    }

    // Método para asociar un cliente con una dieta
    public function asociarDieta($idDieta) {
        // Verificar si la ID de la dieta es válida
        $dieta = new Dieta($this->pdo);
        if (!$dieta->findByID($idDieta)) {
            return false; // La ID de la dieta no es válida
        }

        $sql = "INSERT INTO ClienteSigueDieta (IDcliente, IDdieta) VALUES (:idCliente, :idDieta)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':idDieta', $idDieta, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Método para quitar una dieta
    public function quitarDieta() {
        $sql = "DELETE FROM ClienteSigueDieta WHERE IDcliente = :idCliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Método para agregar un teléfono al cliente
    public function agregarTelefono($telefono) {
        $sql = "INSERT INTO ClienteTelefono (ID, Telefono) VALUES (:idCliente, :telefono)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    //Método para modificar el télefono de un cliente
    public function modificarTelefono($telefono) {
        $sql = "UPDATE ClienteTelefono SET Telefono = :telefono WHERE ID = :idCliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para obtener los teléfonos del cliente
    public function obtenerTelefonos() {
        $sql = "SELECT Telefono FROM ClienteTelefono WHERE ID = :idCliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $this->ID, PDO::PARAM_INT);
        $stmt->execute();

        $telefonos = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $telefonos[] = $row['Telefono'];
        }

        return $telefonos;
    }

    // Método para crear un nuevo cliente en la base de datos
    public function create() {
        parent::create();
        $sql = "INSERT INTO Cliente (ID, DireccionCompleta, Habilitacion) VALUES (:id, :direccion, :habilitacion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':direccion', $this->DireccionCompleta, PDO::PARAM_STR);
        $stmt->bindParam(':habilitacion', $this->Habilitacion, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para actualizar la información del cliente
    public function update() {
        parent::update();
        $sql = "UPDATE Cliente SET DireccionCompleta = :direccion, Habilitacion = :habilitacion WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':direccion', $this->DireccionCompleta, PDO::PARAM_STR);
        $stmt->bindParam(':habilitacion', $this->Habilitacion, PDO::PARAM_STR);
        
        return $stmt->execute();
    } 

    // Método para eliminar un cliente       
    public function delete() {
        parent::delete();
        $sql = "DELETE FROM Cliente WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->getID(), PDO::PARAM_INT);

        
        return $stmt->execute();
    }

}

?>