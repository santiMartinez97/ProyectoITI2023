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

?>