<?php
require '../config/conexion.php';

//-------------------PREPARAMOS LOS DATOS A MOSTRAR-------------------------- //
$db = new DataBase();
$con = $db->conectar();

// Clientes registrados en la web
$nClientes = $con->prepare('SELECT COUNT(*) FROM cliente');
$nClientes->execute();
$nClientes = $nClientes->fetchColumn();

// Clientes empresa
$nClientesEmpresa = $con->prepare('SELECT COUNT(*) FROM clienteempresa');
$nClientesEmpresa->execute();
$nClientesEmpresa = $nClientesEmpresa->fetchColumn();

// Clientes comúnes
$nClientesComunes = $con->prepare('SELECT COUNT(*) FROM clientecomun');
$nClientesComunes->execute();
$nClientesComunes = $nClientesComunes->fetchColumn();

// Dieta más seguida por los clientes y el porcentaje
$dietaMasDemandada = $con->prepare('SELECT D.Tipo AS NombreDeDieta, C.conteo AS CantidadDeClientes
FROM dieta D
JOIN (
  SELECT IDdieta, COUNT(*) AS conteo
  FROM clientesiguedieta
  GROUP BY clientesiguedieta.IDdieta
  ORDER BY conteo DESC
  LIMIT 1
) AS C ON D.ID = C.IDdieta;');
$dietaMasDemandada->execute();
$dietaMasDemandada = $dietaMasDemandada->fetchAll(PDO::FETCH_ASSOC);
$nombreDietaMasDemanda = $dietaMasDemandada[0]['NombreDeDieta'];
$porcentajeClienteDieta = $dietaMasDemandada[0]['CantidadDeClientes'] * 100 / $nClientes;

// Cuántas viandas hay en cada estado
$conteoEstadosVianda = $con->prepare('SELECT ev.Estado, COUNT(*) AS CantidadViandas FROM Estado_Vianda ev INNER JOIN ( SELECT IDVianda, MAX(Fecha) AS FechaMaxima FROM Estado_Vianda GROUP BY IDVianda ) ultimos_estados ON ev.IDVianda = ultimos_estados.IDVianda AND ev.Fecha = ultimos_estados.FechaMaxima GROUP BY ev.Estado;');
$conteoEstadosVianda->execute();
$conteoEstadosVianda = $conteoEstadosVianda->fetchAll(PDO::FETCH_ASSOC);

$solicitadas = 0; $enStock = 0; $enProduccion = 0; $envasado = 0; $entregado = 0; $devuelto = 0; $desechado = 0;

foreach($conteoEstadosVianda as $row){
    switch($row['Estado']){
        case 'Solicitado':
            $solicitadas = $row['CantidadViandas'];
            break;
        case "En stock":
            $enStock = $row['CantidadViandas'];
            break;
        case "En producción":
            $enProduccion = $row['CantidadViandas'];
            break;
        case "Envasado":
            $envasado = $row['CantidadViandas'];
            break;
        case "Entregado":
            $entregado = $row['CantidadViandas'];
            break;
        case "Devuelto":
            $devuelto = $row['CantidadViandas'];
            break;
        case "Desechado":
            $desechado = $row['CantidadViandas'];
            break;
    }
}
// Cuántas viandas se solicitan por día
$solicitadasPorDia = $con->prepare("SELECT DATE(Fecha) AS Fecha, COUNT(*) AS CantidadViandasSolicitadas
FROM Estado_Vianda
WHERE Estado = 'Solicitado'
GROUP BY DATE(Fecha);");
$solicitadasPorDia->execute();
$solicitadasPorDia = $solicitadasPorDia->fetchAll(PDO::FETCH_ASSOC);

// Cuántas viandas se producen por día y total
$producidasPorDia = $con->prepare("SELECT DATE(Fecha) AS Fecha, COUNT(*) AS CantidadViandasProducidas
FROM Estado_Vianda
WHERE Estado = 'En producción'
GROUP BY DATE(Fecha);");
$producidasPorDia->execute();
$producidasPorDia = $producidasPorDia->fetchAll(PDO::FETCH_ASSOC);

$producidasTotal = $con->prepare("SELECT COUNT(*) AS TotalViandasEnProduccion
FROM Estado_Vianda
WHERE Estado = 'En producción';");
$producidasTotal->execute();
$producidasTotal = $producidasTotal->fetchColumn();

// ¿Cuáles son los diferentes tipos de menús estándar y como están conformados?

// ¿Cuáles son los diferentes menús a medida?


// ¿Cuál es la producción de la cocina por semana y por mes?
$producidasPorSemana = $con->prepare("SELECT DATE_FORMAT(Fecha, '%Y-%u') AS Semana, COUNT(*) AS CantidadViandasEnProduccion
FROM Estado_Vianda
WHERE Estado = 'En producción'
GROUP BY Semana;
");
$producidasPorSemana->execute();
$producidasPorSemana = $producidasPorSemana->fetchAll(PDO::FETCH_ASSOC);

$producidasPorMes = $con->prepare("SELECT DATE_FORMAT(Fecha, '%Y-%m') AS Mes, COUNT(*) AS CantidadViandasEnProduccion
FROM Estado_Vianda
WHERE Estado = 'En producción'
GROUP BY Mes;");
$producidasPorMes->execute();
$producidasPorMes = $producidasPorMes->fetchAll(PDO::FETCH_ASSOC);

// Cuantos menús tiene cada dieta
$menusPorDieta = $con->prepare("SELECT D.Tipo AS TipoDieta, COUNT(M.ID) AS CantidadMenus
FROM Dieta D
LEFT JOIN Menu_Sigue_Dieta MSD ON D.ID = MSD.IDDieta
LEFT JOIN Menu M ON MSD.IDMenu = M.ID
GROUP BY D.Tipo;");
$menusPorDieta->execute();
$menusPorDieta = $menusPorDieta->fetchAll(PDO::FETCH_ASSOC);

// Recaudado por día
$recaudadoPorDia = $con->prepare("SELECT DATE(EP.Fecha) AS Fecha, SUM(M.Precio * (1 - (M.Descuento / 100)) * PEM.Cantidad) AS Recaudado
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Entregado'
GROUP BY Fecha;
");
$recaudadoPorDia->execute();
$recaudadoPorDia = $recaudadoPorDia->fetchAll(PDO::FETCH_ASSOC);

// Recaudado por semana
$recaudadoPorSemana = $con->prepare("SELECT DATE_FORMAT(EP.Fecha, '%Y-%u') AS Semana, SUM(M.Precio * (1 - (M.Descuento / 100)) * PEM.Cantidad) AS Recaudado
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Entregado'
GROUP BY Semana;
");
$recaudadoPorSemana->execute();
$recaudadoPorSemana = $recaudadoPorSemana->fetchAll(PDO::FETCH_ASSOC);

// Recaudado por mes
$recaudadoPorMes = $con->prepare("SELECT DATE_FORMAT(EP.Fecha, '%Y-%m') AS Mes, SUM(M.Precio * (1 - (M.Descuento / 100)) * PEM.Cantidad) AS Recaudado
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Entregado'
GROUP BY Mes;
");
$recaudadoPorMes->execute();
$recaudadoPorMes = $recaudadoPorMes->fetchAll(PDO::FETCH_ASSOC);

// Total de pedidos
$nPedidos = $con->prepare("SELECT COUNT(*) AS TotalPedidos FROM Pedido;");
$nPedidos->execute();
$nPedidos = $nPedidos->fetchColumn();

// Total de pedidos por fecha
$pedidosPorFecha = $con->prepare("SELECT DATE(Fecha) AS Fecha, COUNT(*) AS TotalPedidos
FROM Pedido
GROUP BY DATE(Fecha);
");
$pedidosPorFecha->execute();
$pedidosPorFecha = $pedidosPorFecha->fetchAll(PDO::FETCH_ASSOC);

// Total de pedidos por semana
$pedidosPorSemana = $con->prepare("SELECT DATE_FORMAT(Fecha, '%Y-%u') AS Semana, COUNT(*) AS TotalPedidos FROM Pedido GROUP BY Semana;
");
$pedidosPorSemana->execute();
$pedidosPorSemana = $pedidosPorSemana->fetchAll(PDO::FETCH_ASSOC);

// Total de pedidos por mes
$pedidosPorMes = $con->prepare("SELECT DATE_FORMAT(Fecha, '%Y-%m') AS Mes, COUNT(*) AS TotalPedidos FROM Pedido GROUP BY Mes;
");
$pedidosPorMes->execute();
$pedidosPorMes = $pedidosPorMes->fetchAll(PDO::FETCH_ASSOC);

// Total de ventas por menú
$ventasPorMenu = $con->prepare("SELECT M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE PEM.IDPedido IN (SELECT ID FROM Estado_Pedido WHERE Estado = 'Entregado')
GROUP BY M.ID, M.Nombre
ORDER BY TotalStockVendido DESC;
");
$ventasPorMenu->execute();
$ventasPorMenu = $ventasPorMenu->fetchAll(PDO::FETCH_ASSOC);

// Total de ventas por día por menú
$ventasMenuPorFecha = $con->prepare("SELECT DATE(EP.Fecha) AS Fecha, M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
INNER JOIN Estado_Pedido EP ON PEM.IDPedido = EP.ID
WHERE EP.Estado = 'Entregado'
GROUP BY Fecha, M.ID, M.Nombre
ORDER BY Fecha, TotalStockVendido DESC;
");
$ventasMenuPorFecha->execute();
$ventasMenuPorFecha = $ventasMenuPorFecha->fetchAll(PDO::FETCH_ASSOC);

// Total de ventas por semana por menú
$ventasMenuPorSemana = $con->prepare("SELECT DATE_FORMAT(EP.Fecha, '%Y-%u') AS Semana, M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
INNER JOIN Estado_Pedido EP ON PEM.IDPedido = EP.ID
WHERE EP.Estado = 'Entregado'
GROUP BY Semana, M.ID, M.Nombre
ORDER BY Semana, TotalStockVendido DESC;");
$ventasMenuPorSemana->execute();
$ventasMenuPorSemana = $ventasMenuPorSemana->fetchAll(PDO::FETCH_ASSOC);

// Total de ventas por mes por menú
$ventasMenuPorMes = $con->prepare("SELECT DATE_FORMAT(EP.Fecha, '%Y-%m') AS Mes, M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
INNER JOIN Estado_Pedido EP ON PEM.IDPedido = EP.ID
WHERE EP.Estado = 'Entregado'
GROUP BY Mes, M.ID, M.Nombre
ORDER BY Mes, TotalStockVendido DESC;");
$ventasMenuPorMes->execute();
$ventasMenuPorMes = $ventasMenuPorMes->fetchAll(PDO::FETCH_ASSOC);

?>