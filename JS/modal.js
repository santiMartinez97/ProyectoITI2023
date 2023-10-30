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