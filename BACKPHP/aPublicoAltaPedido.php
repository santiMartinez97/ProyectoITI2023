<?php
require_once '../config/conexion.php';
require_once '../Clases/pedido.php';
require_once '../Clases/estadopedido.php';
require_once '../Clases/pedido_encarga_menu.php';
require_once '../Clases/listadostock.php';

$db = new DataBase();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar si se han enviado menús
    if (!isset($_POST["menu"]) || !is_array($_POST["menu"]) || count($_POST["menu"]) === 0) {
        header("Location: ../navegabilidad/atencionPublicoPedidos.php?confirmacion=2");
    }

    // Verificar si se han especificado cantidades para cada menú
    foreach ($_POST["menu"] as $menu) {
        $cantidad_name = "cantidad_" . $menu;
        if (!isset($_POST[$cantidad_name]) || empty($_POST[$cantidad_name])) {
            header("Location: ../navegabilidad/atencionPublicoPedidos.php?confirmacion=3");
        }
    }

  // Recibir los datos del formulario
  $cliente = $_POST["cliente"];
  $descripcion = $_POST["descripcion"];
  
  // Inicializar un array para almacenar los menús y sus cantidades
  $menus_y_cantidades = array();

  // Recorrer los datos del formulario para obtener los menús y sus cantidades
  foreach ($_POST as $name => $value) {
    if (strpos($name, 'cantidad_') === 0) {
      $menu_id = substr($name, strlen('cantidad_'));
      $cantidad = (int)$value;

      // Agregar el menú y su cantidad al array
      $menus_y_cantidades[$menu_id] = $cantidad;
    }
  }

  // Insertaremos en pedido
  $pedido = new Pedido($con);
  // Creamos una fecha
  date_default_timezone_set('America/Montevideo');
  $fecha = date('Y-m-d H:i:s',time());
  //Insertamos y obtenemos ID
  $idPedido = $pedido->crearPedido($fecha, $cliente);

  // Insertamos en pedido_encarga_menu y bajamos stock
  $pedidoEncarga = new Pedido_Encarga_Menu($con);
  $stock = new Stock();

  foreach($menus_y_cantidades as $idMenu => $cantidad){
    $quitarStock = $stock->quitarStockPorId($idMenu, $cantidad);
    if(!$quitarStock && count($menus_y_cantidades) === 1){
        $pedido->borrarPedido($idPedido);
        header("Location: ../navegabilidad/atencionPublicoPedidos.php?confirmacion=0");
    }
    $pedidoEncarga->insertarPedidoMenu($idMenu, $idPedido, $cantidad, $descripcion);
  }

  // Insertamos en estadoPedido
  $estadoPedido = new EstadoPedido($con);
  $estadoPedido->agregarEstado($idPedido, $fecha, 'Solicitado');

  // Aquí, solo mostramos una salida de ejemplo
  echo "Cliente: " . $cliente . "<br>";
  echo "Pedido:<br>";
  foreach ($menus_y_cantidades as $menu_id => $cantidad) {
    echo "Menú ID: " . $menu_id . ", Cantidad: " . $cantidad . "<br>";
  }

  // Después de insertar los datos en la base de datos, redirige a la página de origen con un mensaje de confirmación
  header("Location: ../navegabilidad/atencionPublicoPedidos.php?confirmacion=1");

}
?>