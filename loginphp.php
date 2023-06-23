<?php
$clienteWeb = ["webPrueba@gmail.com", "12345"];
$clienteEmpresa = ["empresaPrueba@gmail.com", "67890"];
$admin = ["admin@sisviansa.com", "qwerty"];
$gerente = ["gerentePrueba@sisviansa.com", "asdfg"];
$informatico = ["inforPrueba@sisviansa.com", "zxcvb"];
$jefeCocina = ["cocinaJefe@sisviansa.com", "hjklñ"];
$atencionPublico = ["atencion@sisviansa.com", "uiopn"];
$usuarios = [$clienteWeb, $clienteEmpresa, $admin, $gerente, $informatico, $jefeCocina, $atencionPublico];

$email = $_POST["email"];
$pass = $_POST["pass"];

$iteraciones = count($usuarios);
for($i = 0 ; $i < $iteraciones ; $i++){
    if(($email == $usuarios[$i][0]) && ($pass == $usuarios[$i][1])){
        echo json_encode('Ha iniciado sesión de forma exitosa.');
        break;
    } else if($i == ($iteraciones - 1)){
        echo json_encode('Email y/o contraseña incorrecto/s.');
    }
}

//Este PHP es una versión provisoria mientras no se tenga una base de datos.
?>