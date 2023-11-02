document.getElementById('formulario').addEventListener('submit', function (event) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const rol = document.getElementById('rol').value;
    let valido = true;

    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const passwordRegex = /^.{6,17}$/;

    if (!emailRegex.test(email)) {
        document.getElementById(`grupo__email`).classList.remove("grupo__correcto");
        document.getElementById(`grupo__email`).classList.add("grupo__error");
        document.querySelector(`#grupo__email .grupo_input-error`).classList.add('grupo_input-error-activo');
        valido = false;
    } else {
        document.getElementById(`grupo__email`).classList.remove("grupo__error");
        document.getElementById(`grupo__email`).classList.add("grupo__correcto");
        document.querySelector(`#grupo__email .grupo_input-error`).classList.remove('grupo_input-error-activo');
    }

    if (!passwordRegex.test(password)) {
        document.getElementById(`grupo__password`).classList.remove("grupo__correcto");
        document.getElementById(`grupo__password`).classList.add("grupo__error");
        document.querySelector(`#grupo__password .grupo_input-error`).classList.add('grupo_input-error-activo');
        valido = false;
    } else {
        document.getElementById(`grupo__password`).classList.remove("grupo__error");
        document.getElementById(`grupo__password`).classList.add("grupo__correcto");
        document.querySelector(`#grupo__password .grupo_input-error`).classList.remove('grupo_input-error-activo');
    }

    // Validación del campo de Rol
    if (rol === "") {
        alert("Porfavor ingrese un rol");
        valido = false;
    } 

    if (!valido) {
        event.preventDefault();
        document.getElementById('botonAlerta').style.display = 'block';
    } else {
        document.getElementById('botonAlerta').style.display = 'none';
    }
});