
<?php//* 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de cocina | NutriBento</title>
    <link rel="stylesheet" href="../CSS/jefeDeCocina.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Jefe de cocina</h1>
        <a href="cerrar_session.php">Cerrar sesion</a>
    </header>
    
    <br>

    <h2>Listado de pedidos</h2>

    <!-- Lista de pedidos -->
    <article class="pedidos">
    <table>
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pedido 1</td>
                    <td>Zapallito a la polla</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
        <div>
            <button class="botonAceptar">Terminar</button>
        </div>
        <div>
            <button class="botonDesechar">Desechar</button>
        </div>
    </article>

    <footer>
    <section>
      <h3>Jefe de cocina</h3>
    </section>
    </footer>
</body>
</html>