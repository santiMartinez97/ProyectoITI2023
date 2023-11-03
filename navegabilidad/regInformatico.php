<?php

require '../config/conexion.php';
require '../Clases/informatico.php';
require '../Clases/Administracion.php';
require '../Clases/JefeCocina.php';
require '../Clases/Gerente.php';
require '../Clases/atencionPublico.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $contrasenia = $_POST['password'];
    $rol = $_POST['rol']; // Asumiendo que 'rol' es el nombre del campo en el formulario

    $stmt = $con->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        // El correo ya está registrado, puedes mostrar un mensaje de error o tomar alguna otra acción
        echo json_encode(["error" => "Email repetido"]);
    } else {
        // El correo no está registrado, proceder con el registro
        switch ($rol) {
            case 'JefeCocina':
                $JefeCocina = new JefeCocina($con, $email, $contrasenia);
                $JefeCocina->registrarJefeCocina($email, $contrasenia);
                break;
            case 'Informatico':
                $informatico = new Informatico($con, $email, $contrasenia);
                $informatico->registrarInformatico($email, $contrasenia);
                break;
            case 'Gerente':
                $gerente = new Gerente($con, $email, $contrasenia);
                $gerente->registrarGerente($email, $contrasenia);
                break;
            case 'AtencionPublico':
                $atencionPublico = new AtencionPublico($con,$email,$contrasenia);
                $atencionPublico->registrarAtencionPublico($email,$contrasenia);
                break;
            case 'Administracion':
                $admin = new Administracion($con, $email, $contrasenia);
                $admin->registrarAdministracion($email, $contrasenia);
                break;
            default:
                echo json_encode("Rol inválido.");
                break;
        }
    }
}

?>