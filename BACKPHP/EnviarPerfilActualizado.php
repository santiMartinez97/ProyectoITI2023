<?php


$email = $_POST["email"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];
$dieta = $_POST["dieta"];

$calle= $_POST['calle'];
$numero= $_POST['numero'];
$esquina= $_POST['esquina'];
$barrio= $_POST['barrio'];
$direccion = $barrio.'-'.$calle.'-'.$numero.'-'.$esquina;



// Incluir el archivo de configuración de la conexión
require '../config/conexion.php';

// Incluir clase
require '../Clases/clientecomun.php';

// Crear una instancia de Database y obtener la conexión
$db = new DataBase();
$con = $db->conectar();

$cliente = $con->prepare("SELECT * FROM cliente");
 $cliente-> execute();
 $resultadoCliente = $cliente->fetchAll(PDO::FETCH_ASSOC);
 $id = $resultadoCliente[0]['ID'];

        try{
            // Creamos el objeto cliente y actualizamos
            $cliente = ClienteComun::findByID($con,$id);
            $cliente->setEmail($email);
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
    

?>