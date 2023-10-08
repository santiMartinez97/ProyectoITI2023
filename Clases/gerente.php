<?php
require_once 'personal.php';
class Gerente extends Personal{

    public function registrarGerente($email, $contrasenia)
    {
        $hashedPass = password_hash($contrasenia, PASSWORD_BCRYPT);

        // Insertar el usuario en la tabla 'usuario'
        $insertarUsuario = $this->pdo->prepare("INSERT INTO usuario (Email, Contrasenia) VALUES (:email, :passHash)");
        $insertarUsuario->bindParam(':email', $email, PDO::PARAM_STR);
        $insertarUsuario->bindParam(':passHash', $hashedPass, PDO::PARAM_STR);
        $insertarUsuario->execute();

        // Si se inserta correctamente, obtener el ID generado automáticamente
        if ($insertarUsuario->rowCount() > 0) {
            $usuarioID = $this->pdo->lastInsertId();
            echo $usuarioID;
            // Insertar el usuario en la tabla 'personal'
            $insertarPersonal = $this->pdo->prepare("INSERT INTO personal (ID) VALUES (:usuarioID)");
            $insertarPersonal->bindParam(':usuarioID', $usuarioID, PDO::PARAM_INT);
            $insertarPersonal->execute();
            // Insertar el usuario en la tabla 'informatico'
            $insertarGerente= $this->pdo->prepare("INSERT INTO gerente (ID) VALUES (:usuarioID)");
            $insertarGerente->bindParam(':usuarioID', $usuarioID, PDO::PARAM_INT);
            $insertarGerente->execute();
        } else {
            return false;
        }

}

// Agregar gerente por id
public function agregarGerente($id)
{
    // Verificar si el ID existe en la tabla 'usuario'
    $verificarID = $this->pdo->prepare("SELECT ID FROM usuario WHERE ID = :id");
    $verificarID->bindParam(':id', $id, PDO::PARAM_INT);
    $verificarID->execute();

    if ($verificarID->rowCount() > 0) {
        
        // Insertar el usuario en la tabla 'gerente'
        $insertarGerente = $this->pdo->prepare("INSERT INTO gerente (ID) VALUES (:usuarioID)");
        $insertarGerente->bindParam(':usuarioID', $id, PDO::PARAM_INT);
        $insertarGerente->execute();

        return true;
    } else {
        return false;
    }
}


}