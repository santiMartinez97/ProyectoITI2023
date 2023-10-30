function validarFormulario() {
    var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var nombreRegex = /^[a-zA-ZáéíóúüÁÉÍÓÚÜ\s]{2,15}$/;
    var apellidoRegex = /^[a-zA-ZáéíóúüÁÉÍÓÚÜ\s]{2,15}$/;
    var ciRegex = /^\d{8}(\.\d+)?$/;
    var telefonoRegex = /^09\d{7}$/;
    var direccionRegex = /^[a-zA-Z0-9\s-]{2,80}$/;

    var email = document.getElementById("modEmail").value;
    var nombre = document.getElementById("modNombre").value;
    var apellido = document.getElementById("modApellido").value;
    var ci = document.getElementById("modCi").value;
    var telefono = document.getElementById("modTelefono").value;
    var calle = document.getElementById("modDireccion").value;

    if (!emailRegex.test(email)) {
        alert("Por favor, ingrese un email válido.");
        return false;
    }

    if (!nombreRegex.test(nombre)) {
        alert("Por favor, ingrese un nombre válido.");
        return false;
    }

    if (!apellidoRegex.test(apellido)) {
        alert("Por favor, ingrese un apellido válido.");
        return false;
    }

    if (!ciRegex.test(ci)) {
        alert("Por favor, ingrese un número de CI válido.");
        return false;
    }

    if (!telefonoRegex.test(telefono)) {
        alert("Por favor, ingrese un número de teléfono válido.");
        return false;
    }

    if (!direccionRegex.test(calle)) {
        alert("Por favor, ingrese una dirección válida.");
        return false;
    }

    return true;
}

function validarFormularioEmpresa() {
    var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var empresaRegex = /^[a-zA-ZÀ-ÿ\s]{2,40}$/;
    var rutRegex = /^.{12}$/;
    var telefonoRegex = /^2\d{7}$/;
    var direccionRegex = /^[a-zA-Z0-9\s-]{2,30}$/; 

    var email = document.getElementById("modEmailE").value;
    var rut = document.getElementById("modRutE").value;
    var nombre = document.getElementById("modNombreE").value;
    var direccion = document.getElementById("modDireccionE").value;
    var telefono = document.getElementById("modTelefonoE").value;

    if (!emailRegex.test(email)) {
        alert("Por favor, ingrese un email válido.");
        return false;
    }

    if (!rutRegex.test(rut)) {
        alert("Por favor, ingrese un RUT válido (solo dígitos).");
        return false;
    }

    if (!empresaRegex.test(nombre)) {
        alert("Por favor, ingrese un nombre válido.");
        return false;
    }

    if (!direccionRegex.test(direccion)) {
        alert("Por favor, ingrese una dirección válida.");
        return false;
    }

    if (!telefonoRegex.test(telefono)) {
        alert("Por favor, ingrese un número de teléfono válido.");
        return false;
    }

    return true;
}


function validarFormularioMenu() {
    var menuRegex = /^[a-zA-Z0-9\sáéíóúüÁÉÍÓÚÜ]{2,30}$/;
    var precioRegex = /^\d{2,6}$/;
    var descuentoRegex = /^\d{1,2}$/;
    var stockRegex = /^\d{1,4}$/;
    var stockMinimoRegex = /^\d{1,4}$/;
    var stockMaximoRegex = /^\d{1,4}$/;
    var descripcionRegex = /^[a-zA-Z0-9\sáéíóúüÁÉÍÓÚÜ]{2,500}$/;
    
    var nombre = document.getElementById("nombreMenu").value;
    var precio = document.getElementById("precio").value;
    var descuento = document.getElementById("descuento").value;
    var stock = document.getElementById("stock").value;
    var stockMinimo = document.getElementById("stockmn").value;
    var stockMaximo = document.getElementById("stockmax").value;
    var descripcion = document.getElementById("descripcion").value;

    if (!menuRegex.test(nombre)) {
        alert("El campo de nombre no es válido.");
        return false;
    }

    if (!precioRegex.test(precio)) {
        alert("El campo de precio no es válido.");
        return false;
    }

    if (!descuentoRegex.test(descuento)) {
        alert("El campo de descuento no es válido.");
        return false;
    }

    if (!stockRegex.test(stock)) {
        alert("El campo de stock no es válido.");
        return false;
    }

    if (!stockMinimoRegex.test(stockMinimo)) {
        alert("El campo de stock mínimo no es válido.");
        return false;
    }

    if (!stockMaximoRegex.test(stockMaximo)) {
        alert("El campo de stock máximo no es válido.");
        return false;
    }

    if (!descripcionRegex.test(descripcion)) {
        alert("El campo de descripción no es válido.");
        return false;
    }

    return true;
}

function validarInformatico() {
    var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    var email = document.getElementById("modEmail").value;
    var puesto = document.getElementById('modPuesto').value;

    if (!emailRegex.test(email)) {
        alert("Por favor, ingrese un email válido.");
        return false;
    } 

    if (puesto === "") {
        alert("Por favor, seleccione un puesto.");
        return false;
    } 

    return true;
}