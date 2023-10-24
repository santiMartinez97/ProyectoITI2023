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

// Incluir clase
require '../Clases/clienteempresa.php';

// Crear una instancia de Database y obtener la conexión
$db = new DataBase();
$con = $db->conectar();

// Consultas para verificar que el email recibido no esté en uso por otro usuario o cliente
$resultadoEmail = Usuario::findBy($con,'Email',$email);

if($resultadoEmail && $resultadoEmail->getID() != $id){
    echo "Error, email en uso.";
    echo '<br>';
    echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
}else{
    // Consulta para verificar que el RUT no esté en uso por otro cliente
    $resultadoRutC = ClienteEmpresa::findByRUT($con,$rut);

    if($resultadoRutC && $resultadoRutC->getID() != $id){
        echo "Error, RUT en uso.";
        echo '<br>';
        echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
    }else{
        try{
            // Creamos el objeto cliente y actualizamos
            $cliente = ClienteEmpresa::findByID($con,$id);
            $cliente->setEmail($email);
            $cliente->setRUT($rut);
            $cliente->setNombreEmpresa($nombre);
            $cliente->setDireccionCompleta($direccion);
            $cliente->update();

            // Modificamos relaciones del cliente
            $cliente->modificarTelefono($telefono);
            $cliente->quitarDieta();
            $cliente->asociarDieta($dieta);

            // Redireccionamos
            header("Location: ../navegabilidad/adminClientes.php");
            exit();
        }catch(Exception $e){
             // Error al ejecutar la consulta
            echo "Error al actualizar los datos: " . $stmt->errorInfo()[2];
            echo '<br>';
            echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
        }
    }
}

?>