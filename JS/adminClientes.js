$(document).ready(function() {
    // Función para cargar y mostrar clientes comunes
    function cargarListaComun() {
        $.ajax({
            url: '../BACKPHP/cargarClientesComunes.php',
            dataType: 'json',
            success: function(data) { //Recibe una lista de clientes comunes
                var listaHTML = '';
                for (var i = 0; i < data.length; i++) {
                    listaHTML += data[i];
                }
                $('#tablaClientes').html(listaHTML);
            },
            error: function(e,r,o){
                console.log(e.responseText);
            }
        });
    }

    // Función para cargar y mostrar clientes empresa
    function cargarListaEmpresa() {
        $.ajax({
            url: '../BACKPHP/cargarClientesEmpresa.php',
            dataType: 'json',
            success: function(data) { //Recibe una lista de clientes empresa
                var listaHTML = '';
                for (var i = 0; i < data.length; i++) {
                    listaHTML += data[i];
                }
                $('#tablaClientes').html(listaHTML);
            }
        });
    }

    // Asigna la función al selector
    $('#tipoCliente').on('change', function() {
        let cliente = $('#tipoCliente').val();
        cliente == "comun" ? cargarListaComun() : cargarListaEmpresa();
    });

    // Carga la lista inicial al cargar la página
    cargarListaComun();

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //Función para habilitar o deshabilitar a un cliente
    $(document).on('click', '.habilitar-btn', function() {
        var button = $(this);
        var clientId = button.closest('tr').data('client-id');
        var clientStatus = button.closest('tr').find('[data-client-status]').data('client-status');

        // Mostrar una confirmación al usuario
        var confirmMessage = '¿Está seguro de que desea ' + (clientStatus ? 'deshabilitar' : 'habilitar') + ' al cliente de ID ' + clientId + '?';

        if (window.confirm(confirmMessage)) {
            // Si el usuario hace clic en "Aceptar" en la confirmación, procede con la actualización
            clientStatus = !clientStatus;

            // Envía la información al servidor PHP
            $.ajax({
                type: 'POST',
                url: '../BACKPHP/habilitacionCliente.php',
                data: { clientId: clientId, clientStatus: clientStatus },
                success: function(response) {
                    if (response === 'success') {
                        // Cambia el texto y la clase del botón
                        if (clientStatus) {
                            button.text('Deshabilitar');
                            button.removeClass('botonAceptar').addClass('botonRechazar');
                        } else {
                            button.text('Habilitar');
                            button.removeClass('botonRechazar').addClass('botonAceptar');
                        }

                        // Actualiza la interfaz de usuario
                        button.closest('tr').find('[data-client-status]').data('client-status', clientStatus);
                        button.closest('tr').find('[data-client-status]').text(clientStatus ? 'Habilitado' : 'No habilitado');
                    } else {
                        alert('Error al actualizar el cliente.');
                    }
                }
            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////

    //Función para eliminar un cliente
    $(document).on('click', '.botonDesechar', function() {
        var button = $(this);
        var clientId = button.closest('tr').data('client-id');

        // Mostrar una confirmación al usuario
        var confirmMessage = '¿Está seguro de que desea eliminar al cliente de ID ' + clientId + '?';

        if (window.confirm(confirmMessage)) {
            // Envía la solicitud al servidor PHP para eliminar el cliente
            $.ajax({
                type: 'POST',
                url: '../BACKPHP/eliminarCliente.php',
                data: { clientId: clientId },
                success: function(response) {
                    if (response === 'success') {
                        // Elimina la fila correspondiente de la tabla
                        button.closest('tr').remove();
                    } else {
                        alert('Error al eliminar el cliente.');
                    }
                }
            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////

    //Función para modificar un cliente
    $(document).on('click', '.botonModificar', function(){
        alert("Próximamente...");
    });

});