<?php

require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

$cliente = $con->prepare("SELECT * FROM `cliente`");
$cliente-> execute();
$resultado = $cliente->fetchAll(PDO::FETCH_ASSOC);

$cliente_array=[];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador| NutriBento</title>
    <link rel="stylesheet" href="../CSS/admin.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Administrador</h1>
        <a class="cerrarSesion" href="cerrar_session.php">Cerrar sesion</a>
    </header>
    
    <br>

    <!-- Control de pedidos -->
    <h2><a class="camino" href="admin.php">Administrador /</a>Gestion de usuarios</h2>

    <article class="pedidos">
    <select class="tablaArriba">
                <option>Todos los clientes </option>
                <option>Clientes web</option> 
                <option>Clientes empresa</option> 
                </select>
     <table>
        <thead>
            <tr>
                <th class="tablaArriba">ID</th>
                <th class="tablaArriba">Email</th>
                <th class="tablaArriba">Direccion</th>
                <th class="tablaArriba">Hablitacion</th>
                <th class="tablaArriba">Dieta</th>                            
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultado as $row) {
                        $id = $row['ID'];    
                        $email = $row['Email'];    
                        $direccion = $row['DireccionCompleta'];    
                        $habilitacion = $row['Habilitacion'];    
                        $dieta = $row['Dieta'];    

                        if (!in_array($cliente, $cliente_array)) {
                            echo '<tr>';
                            echo '<th >'.$id.'</th> ';   
                            echo '<th >'.$email.'</th> ';
                            echo '<th >'.$direccion.'</th> ';   
                            echo '<th >'.$habilitacion.'</th> ';   
                            echo '<th >'.$dieta.'</th> ';   
                            echo '<th><button class="botonAceptar">Completar</button></th>';
                            echo '<th><button class="botonModificar">Modificar</button></th>';
                            echo '<th><button class="botonDesechar">Desechar</button></th>';
                            echo '</tr>';
                         }
                    }
                ?>
            </tbody>
        </table>

    </article>

    <footer>
    <section>
      <h3>Administrador</h3>
    </section>
    </footer>
</body>
</html>
