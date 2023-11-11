<?php

require '../config/config.php';
require '../config/conexion.php';
require '../vendor/autoload.php';
require '../config/mail.php';

//Datos de correo //
if(isset($_SESSION['email'])){
  $configMail = new Mail();
  $mail = $configMail->configurar();
  $mail->Subject = 'Confirmación de pedido - NutriBento';
  $clientEmail = $_SESSION['email'];
  $mail->addAddress($clientEmail); //Definimos el destinatario del correo
  $mensaje = "Su pedido ha sido recibido. ¡Gracias por elegirnos!";
  $mail->Body = $mensaje; // Definimos que el cuerpo del correo será el mensaje previamente definido.
  try{
    $mail->send(); // Enviamos el correo.
  }catch(Error $e){
    //El correo no pudo ser enviado.
  }
  
}

// Recibimos la personalización del pedido
$detallesPedido = isset($_SESSION['detallesPedido']) ? $_SESSION['detallesPedido'] : null;

//Datos de compra-MercadoPago //
// $payment = $_GET['payment_id'];
// $status = $_GET['status'];
// $payment_type = $_GET['payment_type'];
// $order_id = $_GET['merchant_order_id'];


// Insertar información en la base de datos
$db = new DataBase();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$estado = 'Solicitado';
if(isset($_GET['status'])){
  switch($_GET['status']){
    case 'approved':
      $estado = 'Confirmado';
      break;
    case 'rejected':
    case 'cancelled':
    case 'refunded':
    case 'charged_back':
      $estado = 'Rechazado';
      break;
  }
}

if ($productos != null) {

  $idCliente= $_SESSION['id'];
      
  // // // //Agregar a la BASE DE DATOS   ////////
  date_default_timezone_set('America/Montevideo');
  $fecha_hoy = date("Y-m-d H:i:s");

  if($idCliente){
    $con->beginTransaction();

    try{
      $query = $con->prepare("INSERT INTO pedido (Fecha, IDCliente) VALUES (:fecha, :id_cliente)");
      $query->bindParam(':fecha', $fecha_hoy, PDO::PARAM_STR);
      $query->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
      $query->execute();

      $idPedido = $con->lastInsertId();

      $query3 = $con->prepare("INSERT INTO estado_pedido (ID, Estado, Fecha) VALUES (:id, :Estado,:Fecha)");
      $query3->bindParam(':id', $idPedido, PDO::PARAM_INT);
      $query3->bindParam(':Estado', $estado, PDO::PARAM_INT);
      $query3->bindParam(':Fecha', $fecha_hoy, PDO::PARAM_INT);
      $query3->execute();

      foreach ($productos as $clave => $cantidad) {

        $sql = $con->prepare("SELECT  id,Nombre,Precio,descuento, $cantidad AS cantidad FROM menu WHERE id=? AND Habilitacion='Habilitado'");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
      }
     
      foreach ($lista_carrito as $producto) {
        $_id = $producto['id'];
        $nombre = $producto['Nombre'];
        $precio = $producto['Precio'];
        $descuento = $producto['descuento'];
        $cantidad = $producto['cantidad'];
  
        $query2 = $con->prepare("INSERT INTO pedido_encarga_menu (IDMenu, IDPedido,Cantidad,Descripcion) VALUES (:idmenu, :idpedido,:cantidad,:descripcion)");
        $query2->bindParam(':idmenu', $_id, PDO::PARAM_STR);   
        $query2->bindParam(':idpedido', $idPedido, PDO::PARAM_INT);
        $query2->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $query2->bindParam(':descripcion', $detallesPedido, PDO::PARAM_INT);
        $query2->execute();
  
        $restarCantidad = $con->prepare("UPDATE menu SET Stock = Stock - :cantidad WHERE ID = :id");
        $restarCantidad->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $restarCantidad->bindParam(':id', $_id, PDO::PARAM_INT);
        $restarCantidad->execute();
  
       
    }
    $con->commit();
  }catch(Error $e){
    echo "Error al insertar.";
    $con->rollBack();
  }
  }
}

    unset($_SESSION['carrito']);
    header('Location: ../index.php');
    exit();
  


?>