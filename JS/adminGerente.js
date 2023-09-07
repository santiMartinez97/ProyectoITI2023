
$(document).on('click', '.botonDesechar', function() {
    var button = $(this);
    var menuID = button.closest('tr').data('client-id');

    // Mostrar una confirmación al usuario
    var confirmMessage = '¿Está seguro de que desea eliminar al Menu de ID ' + menuID + '?';

    if (window.confirm(confirmMessage)) {
        // Envía la solicitud al servidor PHP para eliminar el cliente
        $.ajax({
            type: 'POST',
            url: '../BACKPHP/eliminarMenu.php',
            data: { menuID: menuID },
            success: function(response) {
                if (response === 'success') {
                    // Elimina la fila correspondiente de la tabla
                    button.closest('tr').remove();
                } else {
                    alert('Error al eliminar el cliente.');
                }
            },error: function(e){
                console.log(e);
            }
        });
    }
});


//////////////////// Habilitar o Deshabilitar //////////////////

 //Función para habilitar o deshabilitar a un cliente
 $(document).on('click', '.habilitar-btn', function() {
    location.reload();
    var button = $(this);
    var menuID = button.closest('tr').data('client-id');
    var menuStatus = button.closest('tr').find('[data-client-status]').data('client-status');

    // Mostrar una confirmación al usuario
    var confirmMessage = '¿Está seguro de que desea ' + (menuStatus ? 'deshabilitar' : 'habilitar') + ' al cliente de ID ' + menuID + '?';

    if (window.confirm(confirmMessage)) {
        // Si el usuario hace clic en "Aceptar" en la confirmación, procede con la actualización
        menuStatus = !menuStatus;
        

        // Envía la información al servidor PHP
        $.ajax({
            type: 'POST',
            url: '../BACKPHP/habilitacionMenu.php',
            data: { menuID: menuID, menuStatus: menuStatus },
            success: function(response) {
                if (response === 'success') {
                    // Cambia el texto y la clase del botón
                    if (menuStatus) {
                        button.text('Deshabilitar');
                        button.removeClass('botonAceptar').addClass('botonRechazar');
                    } else {
                        button.text('Habilitar');
                        button.removeClass('botonRechazar').addClass('botonAceptar');
                    }
        
                    // Actualiza la interfaz de usuario
                    button.closest('tr').find('[data-client-status]').data('client-status', menuStatus);
                    button.closest('tr').find('[data-client-status]').text(menuStatus ? 'Habilitado' : 'No habilitado');
        
                    // Recarga la página una vez que la solicitud se haya completado con éxito
                } else {
                    alert('Error al actualizar el cliente.');
                }
            }
        });
    }
});