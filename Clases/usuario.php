<?php
class Usuario {
    protected $ID;
    private $Email;
    private $Contrasenia;

    protected $pdo; // Objeto PDO para la conexión a la base de datos

    public function __construct($pdo, $email, $contrasenia) {
        $this->pdo = $pdo;
        $this->Email = $email;
        $this->Contrasenia = $contrasenia;
    }

    public function getID() {
        return $this->ID;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($email) {
        $this->Email = $email;
    }

    // Método para crear un nuevo usuario en la base de datos
    public function create() {
        $sql = "INSERT INTO Usuario (Email, Contrasenia) VALUES (:email, :contrasenia)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $this->Email, PDO::PARAM_STR);
        $contrasenia=password_hash($this->Contrasenia, PASSWORD_BCRYPT); // Hash de la contraseña
        $stmt->bindParam(':contrasenia', $contrasenia, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $this->ID = $this->pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    // Método para buscar un usuario por su ID o correo electrónico 
    public static function findBy($pdo, $field, $value) {
        $sql = "SELECT * FROM Usuario WHERE $field = :value";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $usuario = new Usuario($pdo, $row['Email'], $row['Contrasenia']);
            $usuario->ID = $row['ID'];
            return $usuario;
        } else {
            return null;
        }
    }

    public static function findUpdate($pdo, $field, $value) {
        $sql = "SELECT * FROM Usuario WHERE $field = :value";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();



        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $usuario = new Usuario($pdo, $row['Email'], $row['Contrasenia']);
            $usuario->ID = $row['ID'];
            return $usuario;
        } else {
            return null;
        }
    }

    // Método para verificar si una contraseña es correcta
    public function checkPassword($password) {
        return password_verify($password, $this->Contrasenia);
    }

    // Método para actualizar la información del usuario
    public function update() {
        $sql = "UPDATE Usuario SET Email = :email WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':email', $this->Email, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para actualizar la contraseña del usuario
    public function updatePassword($password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "UPDATE Usuario SET Contrasenia = :contrasenia WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(':contrasenia', $hashedPassword, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Método para eliminar un usuario
    public function delete() {
        try{
            $sql = "DELETE FROM Usuario WHERE ID = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    //Función para saber qué rol tiene un usuario
    public function getUsuarioTipo() {
        $tablas = ['Cliente', 'Gerente', 'Administracion', 'AtencionPublico', 'JefeCocina', 'Informatico'];

        foreach ($tablas as $tabla) {
            if ($this->isUsuarioInTabla($tabla)) {
                return $tabla;
            }
        }

        return 'Desconocido'; // Si no se encuentra en ninguna tabla
    }

    private function isUsuarioInTabla($tabla) {
        $sql = "SELECT ID FROM $tabla WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function listarPersonal($pdo) {
        $personal = array();
    
        $sql = "SELECT ID,Email FROM usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario($pdo, $row['Email'], null);
            $usuario->ID = $row['ID'];
            $personal[] = $usuario;
        }
    
        return $personal;
    }
}


?>