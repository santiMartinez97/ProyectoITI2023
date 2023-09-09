<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION// 
session_start();
if(!isset($_SESSION['informatico'])){
    echo '
    <script>
       alert("Por favor debes iniciar session");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$rol = $con->prepare("SELECT * FROM `usuario`");
$rol-> execute();
$resultado = $rol->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informático | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
</head>
<body>
    

<h1>INFORMATICO</h1>

<form action="regInformatico.php" method="post">
    <H2>Formulario de usuarios:</H2>
<label>Ingrese email de el usuario:
    <input type="email" name="email" id="email" placeholder="Email">
</label>

<br>

<label>Ingrese contrasena de el usuario:
    <input type="password" name="password" id="password" placeholder="Password" >
</label>

<br>

<label>Rol</label>
<select id="rol" name="rol" >
    <option value="" disabled selected>Rol</option>
        <?php
        $rol_added = []; 
        foreach ($resultado as $row) {
            $rol = $row['Rol'];
            if (!in_array($rol, $rol_added)) {
                echo '<option value="'.$rol.'" >' . $rol . '</option>';
                $rol_added[] = $rol; // Agrega la dieta al array de dietas agregadas
                }
            }
            ?>
           </select>
<br>

<button id="enviar"  type="submit" >Enviar</button> 
</form>

<a href="cerrar_session.php">Cerrar Session</a>
</body>
</html>