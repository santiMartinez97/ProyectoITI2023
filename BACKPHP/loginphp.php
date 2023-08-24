<?php

session_start();

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
$aux = "";

$iteraciones = count($usuarios);
for ($i = 0; $i < $iteraciones; $i++) {
    if (($email == $usuarios[$i][0]) && ($pass == $usuarios[$i][1])) {
        echo json_encode($usuarios[$i][0]);
        $aux = $usuarios[$i][0];
        break;
    } else if ($i == ($iteraciones - 1)) {
        echo json_encode('Email y/o contraseña incorrecto/s.');
    }
}

// PROTEGER LA PAGINA PARA QUE UNA VEZ DENTRO NO PUEDA ENTRAR EN DIFERENTES CATEGORIAS DE NAVEGABILIDAD POR LA URL//
switch ($aux) {

    case "webPrueba@gmail.com":
        $_SESSION['cliente'] = $usuarios[0][0];
        break;
    case "empresaPrueba@gmail.com":
        $_SESSION['cliente'] = $usuarios[1][0];
        break;
        ;
    case "admin@sisviansa.com":
        $_SESSION['admin'] = $usuarios[2][0];
        break;
    case "gerentePrueba@sisviansa.com":
        $_SESSION['gerente'] = $usuarios[3][0];
        break;
    case "inforPrueba@sisviansa.com":
        $_SESSION['informatico'] = $usuarios[4][0];
        break;
    case "cocinaJefe@sisviansa.com":
        $_SESSION['jefeCocina'] = $usuarios[5][0];
        break;
    case "atencion@sisviansa.com":
        $_SESSION['atencionPublico'] = $usuarios[6][0];
        break;
}
//Este PHP es una versión provisoria mientras no se tenga una base de datos.
?>