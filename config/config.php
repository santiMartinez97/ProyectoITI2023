<?php

define("KEY_TOKEN", "APR.wqc-354*"); // TOKEN PARA CIFRADO DE INFO
define("TOKEN_MP", "TEST-2125607340523955-091718-56c00e78fc4510159b9ef26d94ded160-1350423149"); // Token de Mercado Pago
session_start();
$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>