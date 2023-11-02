<!DOCTYPE html>
<html>
<body>

<?php

$q = intval($_GET['q']);

require '../config/config.php';
require '../config/conexion.php';

$db = new DataBase();
$con = $db->conectar();

// CREAR UNA CONSULTA PREPARADA
$sql = $con->prepare("SELECT id, Nombre, Precio
                      FROM menu
                      JOIN menu_sigue_dieta ON menu.ID = menu_sigue_dieta.IDMenu
                      WHERE menu_sigue_dieta.IDDieta = '$q' AND menu.Habilitacion = 'Habilitado'");
$sql-> execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row) {
    $imagen = "../imgCatalogo/". $row['id'] . "/img.jpg";
    if(!file_exists($imagen)){
        $imagen = "../imgCatalogo/noimg.jpg";
    }

echo '<article class="col">';
echo '<article class="card shadow-sm">'; 
echo '<a href="detalles.php?id=' . $row['id'] . '&token=' . hash_hmac('sha1', $row['id'], KEY_TOKEN) . '">';  
echo    '<img src="'.$imagen.'">';
echo   '</a>';
echo    '<article class="card-body">';
echo        '<h5 class="card-title">'.$row['Nombre'].'</h5>';
echo        '<p class="card-text">$ '.number_format( $row['Precio'],0, '.',',').'</p>';
echo        '<article class="d-flex justify-content-between align-items-center">';
echo            '<article class="btn-group">';
echo            '<!-- URL CON DISTINTO TOKEN -->';
echo            '</article>';
echo           '<a href="#" class="btn btn-success id="carritoBtn" d-flex justify-content-center align-items-center" onclick="agregarProducto('.$row['id'].',\''.hash_hmac('sha1', $row['id'], KEY_TOKEN).'\')">Agregar al Carrito</a>';
echo        '</article>';
echo    '</article>';
echo '</article>';
echo '</article >';
}

?>
<script>
 function agregarProducto(id,token){
                       let url = '../BACKPHP/carrito.php';
                      let formData = new FormData();
                      formData.append('id', id);
                      formData.append('token', token);


                      fetch(url, {
                          method: 'POST',
                          body: formData,
                          mode : 'cors'

                      }).then(response => response.json())
                      .then(data => {
                              if(data.ok){
                                  let elemento = document.getElementById("num_cart");
                                  elemento.innerHTML = data.numero;
                              }
                      })


}
</script>
</body>
</html>