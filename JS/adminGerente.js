
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


////////// MODIFICAR MENÚ Y VALIDAR ////////////

let modalTarget;
let formulario;
let inputs;
let botonId;
let validacionCampos;

const expresionesRegulares = {
    menu : /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜ\s,.\s]{2,30}$/, // Letras y espacios con acentos.
    precio : /^\d{2,6}$/, // digitos
    descuento : /^\d{1,2}$/, //digitos
    stock : /^\d{1,4}$/, // digitos
    stockMinimo : /^\d{1,4}$/, // digitos.
    stockMaximo : /^\d{1,4}$/, // digitos.
    descripcion : /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜ\s,.\s]{2,500}$/, //\d{2}
}

const validarFormulario = (e) => {
    switch (e.attr('name')) {
      case "menu":
        validarCampos(expresionesRegulares.menu, e, 'menu');
      break;
      case "precio":
        validarCampos(expresionesRegulares.precio, e, 'precio');      
      break;
      case "descuento":
        validarCampos(expresionesRegulares.descuento, e, 'descuento');      
      break;
      case "stock":
        validarCampos(expresionesRegulares.stock, e, 'stock');
      break;
      case "stockMinimo":
        validarCampos(expresionesRegulares.stockMinimo, e, 'stockMinimo');
      break;
      case "stockMaximo":
        validarCampos(expresionesRegulares.stockMaximo, e, 'stockMaximo');
      break;
      case "descripcion":
        validarCampos(expresionesRegulares.descripcion, e, 'descripcion');
      break;
      case "imagen":
        validarImagen(e);
      break;
    }
}

const validarCampos = (expresion, input, campo) => {
    if (expresion.test(input.val())) {
        input.parent().parent().removeClass("grupo__error");
        input.parent().parent().addClass("grupo__correcto");
        input.next("p").removeClass("grupo_input-error-activo");
        validacionCampos[campo] = true;
    }
    else {
        input.parent().parent().removeClass("grupo__correcto");
        input.parent().parent().addClass("grupo__error");
        input.next("p").addClass("grupo_input-error-activo");
        validacionCampos[campo] = false;
    }
}

// Verificar si se ha subido un archivo.
const validarImagen = (input) => {
    let image = $(input)[0].files;
    console.log(image);
    if (image.length === 1) {;
      if (!esImagenValida(image) || image[0].size > 1024 * 1024) {
        input.parent().parent().removeClass("grupo__correcto");
        input.parent().parent().addClass("grupo__error");
        input.next("p").addClass("grupo_input-error-activo");
        validacionCampos['imagen'] = false;
        return;
      } 
    }
    input.parent().parent().removeClass("grupo__error");
    input.next("p").removeClass("grupo_input-error-activo");
    validacionCampos['imagen'] = true;
  }
  
  const esImagenValida = file => {
    // Verifica si el archivo tiene una extensión de imagen válida
    var fileType = file[0]["type"];
    var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
    return $.inArray(fileType, validImageTypes) > -1
  }

$(document).ready(function() {
    // Al hacer click en un botón "modificar"
    $(".botonModificar").on("click", function(){
        // Obtiene el valor del atributo data-target del botón
        modalTarget = $(this).data("target");

        // Selecciona el formulario dentro del modal correspondiente
        formulario = $(modalTarget).find("form");

        // Obtiene todos los input dentro del formulario
        inputs = $(modalTarget).find('input, select');

        // Obtiene el mensaje de alerta
        botonId = $(modalTarget).find(".botonAlerta");

        validacionCampos = {
            menu : true,
            precio : true,
            descuento : true,
            stock : true,
            stockMinimo : true,
            stockMaximo : true, 
            descripcion : true,
            imagen : true
        };

        inputs.on("keyup blur", function(e){
            validarFormulario($(this));
        });
    });

    $('.submit-button').click(function(e) {
        e.preventDefault();
        if (validacionCampos.menu && validacionCampos.precio && validacionCampos.descuento && validacionCampos.stock && validacionCampos.stockMinimo && validacionCampos.stockMaximo && validacionCampos.descripcion && validacionCampos.imagen){
            // Encuentra el formulario padre del botón clickeado
            let form = $(this.form);
            // Creamos un FormData de ese form
            let formData = new FormData(form[0]);
            let fileInput = document.getElementById("imagen");
            if(fileInput){
                let imageFile = fileInput.files[0];
                formData.append("imagen", imageFile);
            }
            

            // Envía la información al servidor PHP
        $.ajax({
            type: 'POST',
            url: '../navegabilidad/ActualizarMenu.php',
            data: formData,
            processData: false, // Evitar procesamiento de datos
            contentType: false, // Evitar configuración de tipo de contenido
            success: function(response) {
                if (response === 'success') {
                    // Refresca la página
                    location.reload();
                } else {
                    alert('Error al modificar el menú.');
                }
            }
        });

        }else{
            botonId.addClass("grupo_input-error-activo");
        }
    });
  });
  