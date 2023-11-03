// SUBIR DIETA

const altaDieta = event => {
    event.preventDefault();
    let idDieta = $("#id-dieta").val();
    let nombreDieta = $("#nombre-dieta").val();
    let descripcion = $("#descripcion-dieta").val();

    if (!nombreDieta || !descripcion) {
        alert("Por favor, complete todos los campos requeridos.");
        return;
    }

    $.ajax({
        type: 'POST',
        url: '../BACKPHP/altaDieta.php',
        data: { idDieta : idDieta, nombreDieta : nombreDieta, descripcion : descripcion },
        success: function(response) {
            switch(response){
                case 'Success':
                    location.reload();
                    break;
                case 'Repetido':
                    $(".error-message").css('visibility','visible');
                    break;
                case 'Error':
                    alert("Error al subir. Intente más tarde o contacte con informático.");
                    break;
                default:
                    console.log(response);
            }
        }
    });
};

$("#subirDieta").click(altaDieta);

// RESETEAR FORMULARIO

$("#resetButton").click(function(){
    $('#id-dieta').val("");
    $('#nombre-dieta').val("");
    $('#descripcion-dieta').val("");
    $('#subirDieta').text('Agregar Dieta');
})

// MODIFICAR Y ELIMINAR DIETA

$(document).ready(function(){
    $(".edit").click(function(){
        let idDieta = $(this).closest('tr').find('td:eq(0)').text();
        let nombreDieta = $(this).closest('tr').find('td:eq(1)').text();
        let descripcion = $(this).closest('tr').find('td:eq(2)').text();

        $('#id-dieta').val(idDieta);
        $('#nombre-dieta').val(nombreDieta);
        $('#descripcion-dieta').val(descripcion);
        $('#subirDieta').text('Modificar Dieta');

        $('html, body').scrollTop($('#dieta-form').offset().top);
    });

    $(".delete").click(function(){
        let idDieta = $(this).closest('tr').find('td:eq(0)').text();

        // Mostrar una confirmación al usuario
        var confirmMessage = '¿Está seguro de que desea eliminar la dieta de ID ' + idDieta + '?';

        if (window.confirm(confirmMessage)){
            $.ajax({
                type: 'POST',
                url: '../BACKPHP/bajaDieta.php',
                data: { idDieta : idDieta },
                success: function(response) {
                    switch(response){
                        case 'Success':
                            location.reload();
                            break;
                        case 'Error':
                            alert("Error al eliminar. Intente más tarde o contacte con informático.");
                            break;
                        default:
                            console.log(response);
                    }
                }
            });
        }
    })
});