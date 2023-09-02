$(document).ready(function() {
    // Función para cargar y actualizar la lista
    function cargarLista() {
        $.ajax({
            url: 'BACKPHP/cargarDietas.php',
            dataType: 'json',
            success: function(data) { //Recibe una lista de dietas
                var listaHTML = '';
                for (var i = 0; i < data.length; i++) {
                    listaHTML += data[i];
                }
                $('#dieta').append(listaHTML);
            }
        });
    }

    // Asigna la función al botón
    $('#tipo_usuario').on('change', function() {
        cargarLista();
    });

    // Carga la lista inicial al cargar la página
    cargarLista();
});