$(document).ready(function() {
    // Función para cargar y mostrar clientes comunes
    function cargarListaComun() {
        $.ajax({
            url: '../BACKPHP/cargarPersonal.php',
            dataType: 'json',
            success: function(data) { //Recibe una lista 
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
    // Carga la lista inicial al cargar la página
    cargarListaComun();

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    
   
    //////////////////////////////////////////////////////////////////////////////////////////////

    //Función para eliminar un cliente
    $(document).on('click', '.botonDesechar', function() {
        var button = $(this);
        var clientId = button.closest('tr').data('client-id');
        var clientEmail = button.closest('tr').find('td:eq(1)').text(); //Busca el email en la fila correspondiente

        // Mostrar una confirmación al usuario
        var confirmMessage = '¿Está seguro de que desea eliminar al cliente de ID ' + clientId + '?';

        if (window.confirm(confirmMessage)) {
            // Envía la solicitud al servidor PHP para eliminar el cliente
            $.ajax({
                type: 'POST',
                url: '../BACKPHP/eliminarPersonal.php',
                data: { clientId: clientId, clientEmail: clientEmail },
                success: function(response) {
                    if (response === 'success') {
                        // Elimina la fila correspondiente de la tabla
                        button.closest('tr').remove();
                    }else if (response === 'Error: No se puede eliminar.') {
                        alert('Error, no se puede eliminar el cliente. No se pueden eliminar clientes con pedidos o compras.');
                    }else {
                        //console.log(response);
                        alert('Error al eliminar el cliente.');
                    }
                }
            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////

    //Función para modificar un cliente
    $(document).on('click', '.botonModificar', function(){
       
            var fila = $(this).closest('tr');
            var clientId = fila.data('client-id');
            var clientEmail = fila.find('td:eq(1)').text();
            var puesto = fila.find('td:eq(2)').text();
    
            $("#modId").val(clientId);
            $("#modEmail").val(clientEmail);
            $("#modPuesto").val(puesto);
           

        
        

       
    });

});