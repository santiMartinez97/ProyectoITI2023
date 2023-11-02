<?php

$email = $_POST["email"];
$nombre = $_POST["empresa"];
$telefono = $_POST["telefono"];
$dieta = $_POST["dieta"];
$numero= $_POST['numero'];
$esquina= $_POST['esquina'];
$barrio= $_POST['barrio'];
$calle= $_POST['calle'];

$direccion = $barrio.'-'.$calle.'-'.$numero.'-'.$esquina;

// Incluir el archivo de configuración de la conexión
require '../config/conexion.php';
require '../config/config.php';
// Incluir clase
require '../Clases/clienteempresa.php';
require '../Clases/clienteTelefono.php';

// Crear una instancia de Database y obtener la conexión
$db = new DataBase();
$con = $db->conectar();

$id = $_SESSION['id'];


     try{
            $clientee = ClienteTelefono::findByID($con,$id);
            $clientee->setTelefono($telefono); 
            $cliente = ClienteEmpresa::findByID($con,$id);
            $cliente->setEmail($email);
            $cliente->setNombreEmpresa($nombre);
            $cliente->setDireccionCompleta($direccion);
            $cliente->update();

           // Modificamos relaciones del cliente
            $cliente->modificarTelefono($telefono);
            $cliente->quitarDieta();
            $cliente->asociarDieta($dieta);

            
          
     }catch(Exception $e){
             //Error al ejecutar la consulta
          echo "Error al actualizar los datos: " . $stmt->errorInfo()[2];
             echo '<br>';
            echo '<a href="../navegabilidad/adminClientes.php">Volver</a>';
        }


?>