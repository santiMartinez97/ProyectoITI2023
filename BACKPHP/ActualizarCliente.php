<?php

$id = $_POST["id"];
$email = $_POST["email"];
$ci = $_POST["ci"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$dieta = $_POST["dieta"];

// Incluir el archivo de configuración de la conexión
require '../config/conexion.php';

// Incluir clase
require '../Clases/clientecomun.php';

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
    // Consulta para verificar que la CI no esté en uso por otro cliente
    $resultadoCiC = ClienteComun::findByCI($con,$ci);

    if($resultadoCiC && $resultadoCiC->getID() != $id){
        echo "Error, CI en uso.";
        echo '<br>';
        echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
    }else{
        try{
            // Creamos el objeto cliente y actualizamos
            $cliente = ClienteComun::findByID($con,$id);
            $cliente->setEmail($email);
            $cliente->setCI($ci);
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setDireccionCompleta($direccion);
            $cliente->update();

            // Modificamos relaciones del cliente
            $cliente->modificarTelefono($telefono);
            $cliente->quitarDieta();
            $cliente->asociarDieta($dieta);

            //Redireccionamos
            header("Location: ../navegabilidad/adminClientes.php");
            exit();
        }catch(Exception $e){
            // Error al actualizar
            echo "Error al actualizar los datos: " . $e;
            echo '<br>';
            echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
        }
    }
}

?>