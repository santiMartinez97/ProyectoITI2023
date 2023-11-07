<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['gerente'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

require_once '../config/conexion.php';
require_once '../Clases/dieta.php';

$db = new Database();
$con = $db->conectar();

$objDieta = new Dieta($con);
$listaDietas = $objDieta->ObtenerDieta();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/gerente.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
</head>
<body class="bodyGerente">
  
    <header>
        <div class="gerente-section">
            <h1>Gestión de dietas</h1>
            <a class="enlace" href="gerente.php">Alta de menú</a>
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificación de menú</a>
            <a class="enlace" href="gerenteEstadisticas.php">Estadísticas</a>
            <a class="enlace" href="gerenteMetas.php">Metas de la empresa</a>
        </div>
        <div class="baja-section">
            <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>
    <main class="mainDietas">
        <br>
        <form id="dieta-form">
            <input type="number" id="id-dieta" readonly>
            <label for="nombre-dieta">Nombre de Dieta:</label>
            <input type="text" id="nombre-dieta" required>
            <div class="error-message" id="nombre-dieta-error">Este nombre está repetido</div>
            <label for="descripcion-dieta">Descripción:</label>
            <textarea id="descripcion-dieta" required></textarea>
            <button id="subirDieta" type="submit">Agregar Dieta</button>
            <button id="resetButton">Reset</button>
        </form>
        <br>
        <div id="dietas-list">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="salida-dietas">
                    <?php
                        foreach($listaDietas as $row){
                            echo '<tr>';
                            echo '<td>'.$row['ID'].'</td>';
                            echo '<td>'.$row['Tipo'].'</td>';
                            echo '<td>'.($row['Descripcion'] ? $row['Descripcion'] : 'Sin descripción.').'</td>';
                            echo '<td class="actions">';
                            echo '<button class="edit">Modificar</button>';
                            echo '<button class="delete">Eliminar</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/gestionDietas.js"></script>
</body>
</html>