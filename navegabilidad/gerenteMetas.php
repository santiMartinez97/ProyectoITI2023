<?php
// PROTEGER LA PAGINA SIN ANTES INICIAR SESSION//
session_start();
if(!isset($_SESSION['gerente'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}

include '../BACKPHP/consultas.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/gerente.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
</head>
<body class="bodyGerente">

    <header>
        <div class="gerente-section">
            <h1>Gerente</h1>
            <a class="enlace" href="gerente.php">Alta de menú</a>
            <a class="enlace" href="gerenteBajaModi.php">Baja y modificación de menú</a>
            <a class="enlace" href="gerenteDieta.php">Gestión dietas</a>
            <a class="enlace" href="gerenteEstadisticas.php">Estadísticas</a>
            <a class="enlace" href="gerenteStock.php">Stock</a>
            <a class="enlace" href="gerenteViandas.php">Ver viandas</a>
          </div>
        <div class="baja-section">
          <a class ="enlace" href="cerrar_session.php">Cerrar Sesión</a>
        </div>
    </header>

    <main class="mainMetas">
        <form id="seguimiento-form">
            <label for="tipo-dato">Tipo de Dato:</label>
            <select id="tipo-dato" name="tipo-dato">
                <option value="recaudacion">Recaudación</option>
                <option value="viandas">Producción de Viandas</option>
            </select>
            <label for="periodo">Periodo de Tiempo:</label>
            <select id="periodo" name="periodo">
                <option value="hoy">Hoy</option>
                <option value="semana">Semana</option>
                <option value="mes">Mes</option>
                <option value="trimestre">Trimestre</option>
                <option value="semestre">Semestre</option>
                <option value="anual">Año</option>
            </select>
            <label for="meta">Meta a Alcanzar:</label>
            <input type="number" id="meta" name="meta">
            <button type="button" onclick="calcularProgreso()">Calcular Progreso</button>
        </form>

        <div id="progreso-container">
            <div id="recaudacion-hoy-progress" class="data-container hiddenMetas">
                <p>Recaudación - Hoy:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="recaudacion-hoy-bar" class="progress bar"></div>
                    </div>
                    <p id="recaudacion-hoy-label" class="progress-label"></p>
                </div>
            </div>
            <div id="recaudacion-semana-progress" class="data-container hiddenMetas">
                <p>Recaudación - Semana:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="recaudacion-semana-bar" class="progress bar"></div>
                    </div>
                    <p id="recaudacion-semana-label" class="progress-label"></p>
                </div>
            </div>
            <div id="recaudacion-mes-progress" class="data-container hiddenMetas">
                <p>Recaudación - Mes:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="recaudacion-mes-bar" class="progress bar"></div>
                    </div>
                    <p id="recaudacion-mes-label" class="progress-label"></p>
                </div>
            </div>
            <div id="recaudacion-trimestre-progress" class="data-container hiddenMetas">
                <p>Recaudación - Trimestre:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="recaudacion-trimestre-bar" class="progress bar"></div>
                    </div>
                    <p id="recaudacion-trimestre-label" class="progress-label"></p>
                </div>
            </div>
            <div id="recaudacion-semestre-progress" class="data-container hiddenMetas">
                <p>Recaudación - Semestre:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="recaudacion-semestre-bar" class="progress bar"></div>
                    </div>
                    <p id="recaudacion-semestre-label" class="progress-label"></p>
                </div>
            </div>
            <div id="recaudacion-anual-progress" class="data-container hiddenMetas">
                <p>Recaudación - Anual:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="recaudacion-anual-bar" class="progress bar"></div>
                    </div>
                    <p id="recaudacion-anual-label" class="progress-label"></p>
                </div>
            </div>
            <div id="viandas-hoy-progress" class="data-container hiddenMetas">
                <p>Producción de Viandas - Hoy:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="viandas-hoy-bar" class="progress bar"></div>
                    </div>
                    <p id="viandas-hoy-label" class="progress-label"></p>
                </div>
            </div>
            <div id="viandas-semana-progress" class="data-container hiddenMetas">
                <p>Producción de Viandas - Semana:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="viandas-semana-bar" class="progress bar"></div>
                    </div>
                    <p id="viandas-semana-label" class="progress-label"></p>
                </div>
            </div>
            <div id="viandas-mes-progress" class="data-container hiddenMetas">
                <p>Producción de Viandas - Mes:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="viandas-mes-bar" class="progress bar"></div>
                    </div>
                    <p id="viandas-mes-label" class="progress-label"></p>
                </div>
            </div>
            <div id="viandas-trimestre-progress" class="data-container hiddenMetas">
                <p>Producción de Viandas - Trimestre:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="viandas-trimestre-bar" class="progress bar"></div>
                    </div>
                    <p id="viandas-trimestre-label" class="progress-label"></p>
                </div>
            </div>
            <div id="viandas-semestre-progress" class="data-container hiddenMetas">
                <p>Producción de Viandas - Semestre:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="viandas-semestre-bar" class="progress bar"></div>
                    </div>
                    <p id="viandas-semestre-label" class="progress-label"></p>
                </div>
            </div>
            <div id="viandas-anual-progress" class="data-container hiddenMetas">
                <p>Producción de Viandas - Anual:</p>
                <div class="bar-container">
                    <div class="borde-barra">
                        <div id="viandas-anual-bar" class="progress bar"></div>
                    </div>
                    <p id="viandas-anual-label" class="progress-label"></p>
                </div>
            </div>
        </div>
    </main>

    <script>
        function calcularProgreso() {
            const tipoDato = document.getElementById("tipo-dato").value;
            const periodo = document.getElementById("periodo").value;
            const meta = parseFloat(document.getElementById("meta").value);
            

            if (isNaN(meta) || meta <= 0) {
                alert("Ingrese una meta válida.");
                return;
            }

            const progresoContainer = document.getElementById(`${tipoDato}-${periodo}-progress`);
            progresoContainer.classList.remove("hiddenMetas");

            // Obtener la barra de progreso seleccionada
            const barra = document.getElementById(`${tipoDato}-${periodo}-bar`);

            // Obtener ubicación de salida de datos
            const salida = document.getElementById(`${tipoDato}-${periodo}-label`);

            // Establecer el valor alcanzado según la selección
            let valorAlcanzado = 0;
            if (tipoDato === "recaudacion" && periodo === "hoy") {
                valorAlcanzado = <?php echo $recaudacionHoy; ?>;
            } else if (tipoDato === "recaudacion" && periodo === "semana") {
                valorAlcanzado = <?php echo $recaudacionSemana; ?>;
            } else if (tipoDato === "recaudacion" && periodo === "mes") {
                valorAlcanzado = <?php echo $recaudacionMes; ?>;
            } else if (tipoDato === "recaudacion" && periodo === "trimestre") {
                valorAlcanzado = <?php echo $recaudacionTrimestre; ?>;
            } else if (tipoDato === "recaudacion" && periodo === "semestre") {
                valorAlcanzado = <?php echo $recaudacionSemeste; ?>;
            } else if (tipoDato === "recaudacion" && periodo === "anual") {
                valorAlcanzado = <?php echo $recaudacionAnio; ?>;
            } else if (tipoDato === "viandas" && periodo === "hoy") {
                valorAlcanzado = <?php echo $produccionHoy; ?>;
            } else if (tipoDato === "viandas" && periodo === "semana") {
                valorAlcanzado = <?php echo $produccionSemana; ?>;
            } else if (tipoDato === "viandas" && periodo === "mes") {
                valorAlcanzado = <?php echo $produccionMes; ?>;
            } else if (tipoDato === "viandas" && periodo === "trimestre") {
                valorAlcanzado = <?php echo $produccionTrimestre; ?>;
            } else if (tipoDato === "viandas" && periodo === "semestre") {
                valorAlcanzado = <?php echo $produccionSemestre; ?>;
            } else if (tipoDato === "viandas" && periodo === "anual") {
                valorAlcanzado = <?php echo $produccionAnio; ?>;
            }

            // Calcular el porcentaje de progreso
            const porcentajeProgreso = (valorAlcanzado / meta) * 100;
    
            // Actualizar la barra de progreso con el valor precargado y la meta
            barra.style.width = `${porcentajeProgreso}%`;
            salida.textContent = tipoDato === 'recaudacion' ? `Alcanzado: $${valorAlcanzado} / Meta: $${meta}` : `Alcanzado: ${valorAlcanzado} / Meta: ${meta}` ;
        }
    </script>
</body>
</html>