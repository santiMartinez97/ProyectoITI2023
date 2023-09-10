<?php

$id = $_POST["id"];
$email = $_POST["email"];
$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$dieta = $_POST["dieta"];

// Incluir el archivo de configuración de la conexión
require '../config/conexion.php';

// Crear una instancia de Database y obtener la conexión
$db = new DataBase();
$con = $db->conectar();

// Consultas para verificar que el email recibido no esté en uso por otro usuario o cliente
$sqlEmailU = "SELECT * FROM usuario WHERE Email = :email";
$stmtEmailU = $con->prepare($sqlEmailU);
$stmtEmailU->bindParam(":email", $email);
$stmtEmailU->execute();
$resultadoEmailU = $stmtEmailU->fetchAll(PDO::FETCH_ASSOC);

$sqlEmailC = "SELECT * FROM cliente WHERE Email = :email AND ID <> :id";
$stmtEmailC = $con->prepare($sqlEmailC);
$stmtEmailC->bindParam(":email", $email);
$stmtEmailC->bindParam(":id", $id);
$stmtEmailC->execute();
$resultadoEmailC = $stmtEmailC->fetchAll(PDO::FETCH_ASSOC);

if($resultadoEmailU || $resultadoEmailC){
    echo "Error, email en uso.";
    echo '<br>';
    echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
}else{
    // Consulta para verificar que el RUT no esté en uso por otro cliente
    $sqlRutC = "SELECT * FROM clienteempresa WHERE RUT = :rut AND ID <> :id";
    $stmtRutC = $con->prepare($sqlRutC);
    $stmtRutC->bindParam(":rut", $rut);
    $stmtRutC->bindParam(":id", $id);
    $stmtRutC->execute();
    $resultadoRutC = $stmtRutC->fetchAll(PDO::FETCH_ASSOC);

    if($resultadoRutC){
        echo "Error, RUT en uso.";
        echo '<br>';
        echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
    }else{
        // Prepara la consulta SQL de actualización
        $sql = "UPDATE cliente AS c 
        JOIN clienteempresa AS ce ON c.ID = ce.ID
        JOIN clientetelefono AS ct ON c.ID = ct.ID
        SET c.Email = :email,
            c.DireccionCompleta = :direccion,
            c.Dieta = :dieta,
            ce.RUT = :rut,
            ce.NombreEmpresa = :nombre,
            ct.Telefono = :telefono
        WHERE c.ID = :id";
        
        // Prepara la sentencia SQL
        $stmt = $con->prepare($sql);

        // Enlaza los parámetros
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":direccion", $direccion);
        $stmt->bindParam(":dieta", $dieta);
        $stmt->bindParam(":rut", $rut);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":id", $id);

        //Ejecutar la consulta
        if($stmt->execute()){
            header("Location: ../navegabilidad/adminClientes.php");
            exit();
        }else{
            // Error al ejecutar la consulta
            echo "Error al actualizar los datos: " . $stmt->errorInfo()[2];
            echo '<br>';
            echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
        }
    }
}

?>