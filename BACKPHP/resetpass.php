<?php
require '../config/conexion.php';
require '../Clases/usuario.php';
require '../Clases/tokenPassword.php';

$db = new DataBase();
$con = $db->conectar();

$token = $_POST['token'];

$token_hash = hash('sha256', $token);

$objToken = new TokenRecuperacion($con);
$tokenValido = $objToken->obtenerTokenPorHash($token_hash);

//Si el token está expirado
if(!$tokenValido){
    header("Location: recoverPassword.php?status=expired");
}else{
    //Si el token es valido
    $pass = $_POST['pass'];
    $idUsuario = $tokenValido['idUsuario'];

    //Cambiamos la contraseña
    $usuario = Usuario::findBy($con,'ID',$idUsuario);
    $usuario->updatePassword($pass);

    //Borramos el token
    $objToken->eliminarTokenPorHash($token_hash);

    echo json_encode('success');
}
?>