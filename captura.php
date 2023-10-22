<?php

require 'config/config.php';
require 'config/conexion.php';
require 'vendor/autoload.php';
// require 'BACKPHP/pago.php';


$payment = $_GET['payment_id'];
$status = $_GET['status'];
$payment_type = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];
echo "<h3>Pago exitoso </h3>";
echo $payment. '<br>';
echo $status. '<br>';
echo $payment_type. '<br>';
echo $order_id. '<br>';


 

//Se borra todas las cosas del carrito cuando se aprueba la compra
unset($_SESSION['carrito']);






?>




<!-- Podria mandarlo a una seccion "Mis compras y ver el estado" -->
<a href="index.php" style="background-color: orange; padding: 10px; color: white; text-decoration: none; display: inline-block;">Volver</a>