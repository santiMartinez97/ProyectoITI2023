<?php
require '../config/conexion.php';

//-------------------PREPARAMOS LOS DATOS A MOSTRAR-------------------------- //
$db = new DataBase();
$con = $db->conectar();

function consultaAll($con, $query){
    $consulta = $con->prepare($query);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function consultaColumn ($con, $query){
    $consulta = $con->prepare($query);
    $consulta->execute();
    return $consulta->fetchColumn();
}

// Clientes registrados en la web
$nClientes = consultaColumn($con, 'SELECT COUNT(*) FROM cliente');

// Clientes empresa
$nClientesEmpresa = consultaColumn($con, 'SELECT COUNT(*) FROM clienteempresa');

// Clientes comúnes
$nClientesComunes = consultaColumn($con, 'SELECT COUNT(*) FROM clientecomun');

// Dieta más seguida por los clientes y el porcentaje
$dietaMasDemandada = consultaAll($con, 'SELECT D.Tipo AS NombreDeDieta, C.conteo AS CantidadDeClientes
FROM dieta D
JOIN (
  SELECT IDdieta, COUNT(*) AS conteo
  FROM clientesiguedieta
  GROUP BY clientesiguedieta.IDdieta
  ORDER BY conteo DESC
  LIMIT 1
) AS C ON D.ID = C.IDdieta;');
$nombreDietaMasDemanda = $dietaMasDemandada[0]['NombreDeDieta'];
$porcentajeClienteDieta = $dietaMasDemandada[0]['CantidadDeClientes'] * 100 / $nClientes;

// Cuántas viandas hay en cada estado
$conteoEstadosVianda = consultaAll($con, 'SELECT ev.Estado, COUNT(*) AS CantidadViandas FROM Estado_Vianda ev INNER JOIN ( SELECT IDVianda, MAX(Fecha) AS FechaMaxima FROM Estado_Vianda GROUP BY IDVianda ) ultimos_estados ON ev.IDVianda = ultimos_estados.IDVianda AND ev.Fecha = ultimos_estados.FechaMaxima GROUP BY ev.Estado;');

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
$solicitadasPorDia = consultaAll($con,"SELECT DATE(Fecha) AS Fecha, COUNT(*) AS CantidadViandasSolicitadas
FROM Estado_Vianda
WHERE Estado = 'Solicitado'
GROUP BY DATE(Fecha);");

// Cuántas viandas se producen por día y total
$producidasPorDia = consultaAll($con, "SELECT DATE(Fecha) AS Fecha, COUNT(*) AS CantidadViandasProducidas
FROM Estado_Vianda
WHERE Estado = 'Envasado'
GROUP BY DATE(Fecha);");

$producidasTotal = consultaColumn($con,"SELECT COUNT(*) AS TotalViandasEnProduccion
FROM Estado_Vianda
WHERE Estado = 'Envasado';");

// ¿Cuáles son los diferentes tipos de menús estándar y como están conformados?

// ¿Cuáles son los diferentes menús a medida?


// ¿Cuál es la producción de la cocina por semana y por mes?
$producidasPorSemana = consultaAll($con, "SELECT DATE_FORMAT(Fecha, '%Y-%u') AS Semana, COUNT(*) AS CantidadViandasEnProduccion
FROM Estado_Vianda
WHERE Estado = 'Envasado'
GROUP BY Semana;
");

$producidasPorMes = consultaAll($con,"SELECT DATE_FORMAT(Fecha, '%Y-%m') AS Mes, COUNT(*) AS CantidadViandasEnProduccion
FROM Estado_Vianda
WHERE Estado = 'Envasado'
GROUP BY Mes;");

// Cuantos menús tiene cada dieta
$menusPorDieta = consultaAll($con, "SELECT D.Tipo AS TipoDieta, COUNT(M.ID) AS CantidadMenus
FROM Dieta D
LEFT JOIN Menu_Sigue_Dieta MSD ON D.ID = MSD.IDDieta
LEFT JOIN Menu M ON MSD.IDMenu = M.ID
GROUP BY D.Tipo;");

// Recaudado por día
$recaudadoPorDia = consultaAll($con, "SELECT DATE(EP.Fecha) AS Fecha, SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS Recaudado FROM Estado_Pedido EP INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido INNER JOIN Menu M ON PEM.IDMenu = M.ID WHERE EP.Estado = 'Confirmado' GROUP BY DATE(EP.Fecha);
");

// Recaudado por semana
$recaudadoPorSemana = consultaAll($con, "SELECT DATE_FORMAT(EP.Fecha, '%Y-%u') AS Semana, SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS Recaudado FROM Estado_Pedido EP INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido INNER JOIN Menu M ON PEM.IDMenu = M.ID WHERE EP.Estado = 'Confirmado' GROUP BY Semana;
");

// Recaudado por mes
$recaudadoPorMes = consultaAll($con, "SELECT DATE_FORMAT(EP.Fecha, '%Y-%m') AS Mes, SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS Recaudado FROM Estado_Pedido EP INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido INNER JOIN Menu M ON PEM.IDMenu = M.ID WHERE EP.Estado = 'Confirmado' GROUP BY Mes;
");

// Total de pedidos
$nPedidos = consultaColumn($con, "SELECT COUNT(*) AS TotalPedidos FROM Pedido;");

// Total de pedidos por fecha
$pedidosPorFecha = consultaAll($con, "SELECT DATE(Fecha) AS Fecha, COUNT(*) AS TotalPedidos
FROM Pedido
GROUP BY DATE(Fecha);
");

// Total de pedidos por semana
$pedidosPorSemana = consultaAll($con, "SELECT DATE_FORMAT(Fecha, '%Y-%u') AS Semana, COUNT(*) AS TotalPedidos FROM Pedido GROUP BY Semana;
");

// Total de pedidos por mes
$pedidosPorMes = consultaAll($con, "SELECT DATE_FORMAT(Fecha, '%Y-%m') AS Mes, COUNT(*) AS TotalPedidos FROM Pedido GROUP BY Mes;
");

// Total de ventas por menú
$ventasPorMenu = consultaAll($con, "SELECT M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE PEM.IDPedido IN (SELECT ID FROM Estado_Pedido WHERE Estado = 'Confirmado')
GROUP BY M.ID, M.Nombre
ORDER BY TotalStockVendido DESC;
");

// Total de ventas por día por menú
$ventasMenuPorFecha = consultaAll($con, "SELECT DATE(EP.Fecha) AS Fecha, M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
INNER JOIN Estado_Pedido EP ON PEM.IDPedido = EP.ID
WHERE EP.Estado = 'Confirmado'
GROUP BY DATE(EP.Fecha), M.ID, M.Nombre
ORDER BY Fecha, TotalStockVendido DESC;
");

// Total de ventas por semana por menú
$ventasMenuPorSemana = consultaAll($con, "SELECT DATE_FORMAT(EP.Fecha, '%Y-%u') AS Semana, M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
INNER JOIN Estado_Pedido EP ON PEM.IDPedido = EP.ID
WHERE EP.Estado = 'Confirmado'
GROUP BY Semana, M.ID, M.Nombre
ORDER BY Semana, TotalStockVendido DESC;");

// Total de ventas por mes por menú
$ventasMenuPorMes = consultaAll($con, "SELECT DATE_FORMAT(EP.Fecha, '%Y-%m') AS Mes, M.ID AS IDMenu, M.Nombre AS NombreMenu, SUM(PEM.Cantidad) AS TotalStockVendido
FROM Pedido_Encarga_Menu PEM
INNER JOIN Menu M ON PEM.IDMenu = M.ID
INNER JOIN Estado_Pedido EP ON PEM.IDPedido = EP.ID
WHERE EP.Estado = 'Confirmado'
GROUP BY Mes, M.ID, M.Nombre
ORDER BY Mes, TotalStockVendido DESC;");

// --------------------CONSULTAS PARA METAS-----------------------

// Recaudación del día
$recaudacionHoy = consultaColumn($con, "SELECT SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS RecaudacionHoy
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Confirmado' AND DATE(EP.Fecha) = CURDATE();
");
$recaudacionHoy = $recaudacionHoy ? round($recaudacionHoy) : 0;

// Recaudación de la semana
$recaudacionSemana = consultaColumn($con, "SELECT SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS RecaudacionSemana
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Confirmado' AND YEARWEEK(EP.Fecha, 1) = YEARWEEK(CURDATE(), 1);
");
$recaudacionSemana = $recaudacionSemana ? round($recaudacionSemana) : 0;

// Recaudación del mes
$recaudacionMes = consultaColumn($con, "SELECT SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS RecaudacionMes
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Confirmado' AND YEAR(EP.Fecha) = YEAR(CURDATE()) AND MONTH(EP.Fecha) = MONTH(CURDATE());
");
$recaudacionMes = $recaudacionMes ? round($recaudacionMes) : 0;

// Recaudación del trimestre
$recaudacionTrimestre = consultaColumn($con, "SELECT SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS RecaudacionTrimestre
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Confirmado' AND YEAR(EP.Fecha) = YEAR(CURDATE()) AND QUARTER(EP.Fecha) = QUARTER(CURDATE());
");
$recaudacionTrimestre = $recaudacionTrimestre ? round($recaudacionTrimestre) : 0;

// Recaudación del semestre
$recaudacionSemeste = consultaColumn($con, "SELECT SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS RecaudacionSemestre
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Confirmado' AND YEAR(EP.Fecha) = YEAR(CURDATE()) AND QUARTER(EP.Fecha) <= IF(MONTH(CURDATE()) <= 6, 2, 4);");
$recaudacionSemeste = $recaudacionSemeste ? round($recaudacionSemeste) : 0;

// Recaudación del año
$recaudacionAnio = consultaColumn($con, "SELECT SUM(M.Precio * (1 - COALESCE(M.Descuento / 100, 0)) * PEM.Cantidad) AS RecaudacionAnio
FROM Estado_Pedido EP
INNER JOIN Pedido_Encarga_Menu PEM ON EP.ID = PEM.IDPedido
INNER JOIN Menu M ON PEM.IDMenu = M.ID
WHERE EP.Estado = 'Confirmado' AND YEAR(EP.Fecha) = YEAR(CURDATE());
");
$recaudacionAnio = $recaudacionAnio ? round($recaudacionAnio) : 0;

// Producción de viandas del día
$produccionHoy = consultaColumn($con, "SELECT COUNT(*) AS ProduccionHoy
FROM Estado_Vianda EV
WHERE EV.Estado = 'Envasado' AND DATE(EV.Fecha) = CURDATE();
");
$produccionHoy = $produccionHoy ? round($produccionHoy) : 0;

// Producción de viandas de la semana
$produccionSemana = consultaColumn($con, "SELECT COUNT(*) AS ProduccionSemana
FROM Estado_Vianda EV
WHERE EV.Estado = 'Envasado' AND YEARWEEK(EV.Fecha, 1) = YEARWEEK(CURDATE(), 1);
");
$produccionSemana = $produccionSemana ? round($produccionSemana) : 0;

// Producción de viandas del mes
$produccionMes = consultaColumn($con, "SELECT COUNT(*) AS ProduccionMes
FROM Estado_Vianda EV
WHERE EV.Estado = 'Envasado' AND YEAR(EV.Fecha) = YEAR(CURDATE()) AND MONTH(EV.Fecha) = MONTH(CURDATE());
");
$produccionMes = $produccionMes ? round($produccionMes) : 0;

// Producción de viandas del trimestre
$produccionTrimestre = consultaColumn($con, "SELECT COUNT(*) AS ProduccionTrimestre
FROM Estado_Vianda EV
WHERE EV.Estado = 'Envasado' AND YEAR(EV.Fecha) = YEAR(CURDATE()) AND QUARTER(EV.Fecha) = QUARTER(CURDATE());
");
$produccionTrimestre = $produccionTrimestre ? round($produccionTrimestre) : 0;

// Producción de viandas del semestre
$produccionSemestre = consultaColumn($con, "SELECT COUNT(*) AS ProduccionSemestre
FROM Estado_Vianda EV
WHERE EV.Estado = 'Envasado' AND YEAR(EV.Fecha) = YEAR(CURDATE()) AND QUARTER(EV.Fecha) <= IF(MONTH(CURDATE()) <= 6, 2, 4);
");
$produccionSemestre = $produccionSemestre ? round($produccionSemestre) : 0;

// Producción de viandas del año
$produccionAnio = consultaColumn($con, "SELECT COUNT(*) AS ProduccionAnio
FROM Estado_Vianda EV
WHERE EV.Estado = 'Envasado' AND YEAR(EV.Fecha) = YEAR(CURDATE());
");
$produccionAnio = $produccionAnio ? round($produccionAnio) : 0;

?>