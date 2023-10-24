<?php

require '../config/config.php';
require '../config/conexion.php';
require '../vendor/autoload.php';
//Datos de compra-MercadoPago //
// $payment = $_GET['payment_id'];
// $status = $_GET['status'];
// $payment_type = $_GET['payment_type'];
// $order_id = $_GET['merchant_order_id'];
date_default_timezone_set('America/Montevideo');
$fecha = date(format: 'Y-m-d H:i:s');

// Insertar información en la base de datos
$db = new DataBase();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {

    $sql = $con->prepare("SELECT  id,Nombre,Precio,descuento, $cantidad AS cantidad FROM menu WHERE id=? AND Habilitacion='Habilitado'");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
  }
   }

   foreach ($lista_carrito as $producto) {
    $_id = $producto['id'];
    $nombre = $producto['Nombre'];
    $precio = $producto['Precio'];
    $descuento = $producto['descuento'];
    $cantidad = $producto['cantidad'];

      //POR SI HACEMOS LOS DATOS ESTADISTICOS////
        // $precio_desc = $precio - (($precio * $descuento) / 100);
        // $subtotal = $cantidad * $precio_desc;
        // // $total += $subtotal;

      $cliente   = $con->prepare("SELECT * FROM cliente ");
      $cliente-> execute();
      $cliente1 = $cliente->fetch(PDO::FETCH_ASSOC);
      
     if ($cliente1 && isset($cliente1['ID'])) {
     $idCliente = $cliente1['ID'];
  
     $query = $con->prepare("INSERT INTO pedido (Fecha, IDCliente) VALUES (:fecha, :id_cliente)");
     $query->bindParam(':fecha', $fecha, PDO::PARAM_STR);
     $query->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
     $query->execute();

     $idPedido = $con->lastInsertId();

      $query2 = $con->prepare("INSERT INTO pedido_encarga_menu (IDMenu, IDPedido,Cantidad) VALUES (:idmenu, :idpedido,:cantidad)");
      $query2->bindParam(':idmenu', $_id, PDO::PARAM_STR);   
      $query2->bindParam(':idpedido', $idPedido, PDO::PARAM_INT);
      $query2->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
      $query2->execute();

      $default='Solicitado';

      $query3 = $con->prepare("INSERT INTO estado_pedido (ID, Estado,Fecha) VALUES (:idpedido, :estado,:fecha)");
      $query3->bindParam(':idpedido', $idPedido, PDO::PARAM_STR);   
      $query3->bindParam(':estado', $default, PDO::PARAM_INT);
      $query3->bindParam(':fecha', $fecha, PDO::PARAM_INT);
      $query3->execute();


      $restarCantidad = $con->prepare("UPDATE menu SET Stock = Stock - :cantidad WHERE ID = :id");
      $restarCantidad->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
      $restarCantidad->bindParam(':id', $_id, PDO::PARAM_INT);
      $restarCantidad->execute();
}
    }

    unset($_SESSION['carrito']);
    header('Location: ../index.php');
    exit();
  


?>