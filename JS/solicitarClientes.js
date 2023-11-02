$(document).ready(function() {
    function cargarListaComun() {
        $.ajax({
            url: '../BACKPHP/solicitarClientes.php',
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
            url: '../BACKPHP/solicitarEmpresas.php',
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

    $('#tipoCliente').on('change', function() {
        let cliente = $('#tipoCliente').val();
        cliente == "comun" ? cargarListaComun() : cargarListaEmpresa();
    });

    // Carga la lista inicial al cargar la página
    cargarListaComun();
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
        
    document.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("habilitar-btn")) {
            var clientId = e.target.getAttribute("data-client-id");
            $.ajax({
                    url: '../BACKPHP/solicitaConfirma.php', // Debes asegurarte de que esta URL sea correcta
                    type: 'POST',
                    data: { clientId: clientId },
                    success: function (response) {
                        alert("Solicitud enviada al administrador para habilitar al cliente con ID: " + clientId);
                    },
                    error: function (xhr, status, error) {
                        alert("Hubo un error al enviar la solicitud al administrador: " + error);
                    }
                });
            }
        });
    

    //////////////////////////////////////////////////////////////////////////////////////////////
});