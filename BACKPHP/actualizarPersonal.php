<?php

$id = $_POST["id"];
$email = $_POST["email"];
$puesto = $_POST["puesto"];


// Incluir el archivo de configuración de la conexión
require '../config/conexion.php';

// Incluir clase
require '../Clases/usuario.php';
require '../Clases/informatico.php';
require '../Clases/Administracion.php';
require '../Clases/JefeCocina.php';
require '../Clases/Gerente.php';
require '../Clases/atencionPublico.php';


// Crear una instancia de Database y obtener la conexión
$db = new DataBase();
$con = $db->conectar();

// Consultas para verificar que el email recibido no esté en uso por otro usuario 
$resultadoEmail = Usuario::findBy($con,'Email',$email);

if($resultadoEmail && $resultadoEmail->getID() != $id){
    echo "Error, email en uso.";
    echo '<br>';
    echo '<a href="../navegabilidad/informaticoBajaM.php">Volver</a>';


}
try {
    $personal = new Personal($con, null, null);

    switch ($puesto) {
        case 'Gerente':
            // Borrar y actualizar en la tabla 'personal'
            $personal->borrarPorID($id);
            $personal->insertarPorID($id);

            // Agregar a la tabla 'gerente'
            $gerente = new Gerente($con, null, null);
            $gerente->agregarGerente($id);

            // Actualizar el email en la tabla 'usuario'
            $personal = Usuario::findUpdate($con, 'ID', $id);
            $personal->setEmail($email);
            $personal->update();

            // Redireccionar
            header("Location: ../navegabilidad/informaticoBajaM.php");
            exit();
        case 'JefeCocina':
            $personal->borrarPorID($id);
            $personal->insertarPorID($id);

            // Agregar a la tabla 'jefeCocina'
            $JefeCocina = new JefeCocina($con, null, null);
            $JefeCocina->agregarJefeCocina($id);

            // Actualizar el email en la tabla 'usuario'
            $personal = Usuario::findUpdate($con, 'ID', $id);
            $personal->setEmail($email);
            $personal->update();

            // Redireccionar
            header("Location: ../navegabilidad/informaticoBajaM.php");
            exit();
        case 'Informatico':
            $personal->borrarPorID($id);
            $personal->insertarPorID($id);

            // Agregar a la tabla 'informatico'
            $informatico = new Informatico($con, null, null);
            $informatico->agregarInformatico($id);

            // Actualizar el email en la tabla 'usuario'
            $personal = Usuario::findUpdate($con, 'ID', $id);
            $personal->setEmail($email);
            $personal->update();

            // Redireccionar
            header("Location: ../navegabilidad/informaticoBajaM.php");
            exit();
        case 'AtencionPublico':
            $personal->borrarPorID($id);
            $personal->insertarPorID($id);

            // Agregar a la tabla 'atencionPublico'
            $AtencionPublico = new AtencionPublico($con, null, null);
            $AtencionPublico->agregarAtencionPublico($id);

            // Actualizar el email en la tabla 'usuario'
            $personal = Usuario::findUpdate($con, 'ID', $id);
            $personal->setEmail($email);
            $personal->update();

            // Redireccionar
            header("Location: ../navegabilidad/informaticoBajaM.php");
            exit();
        case 'Administracion':
            $personal->borrarPorID($id);
            $personal->insertarPorID($id);

            // Agregar a la tabla 'atencionPublico'
            $Administracion = new Administracion($con, null, null);
            $Administracion->agregarAdmin($id);

            // Actualizar el email en la tabla 'usuario'
            $personal = Usuario::findUpdate($con, 'ID', $id);
            $personal->setEmail($email);
            $personal->update();

            // Redireccionar
            header("Location: ../navegabilidad/informaticoBajaM.php");
            exit();
        default:
            // Código por defecto (si no se selecciona ningún rol)
            exit();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            // Error al actualizar
            echo "Error al actualizar los datos: " . $e;
            echo '<br>';
            echo '<a href="../navegabilidad/informaticoBajaM.php">Volver</a>';
        }
    


?>