document.getElementById('formulario').addEventListener('submit', function (event) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const rol = document.getElementById('rol').value;
    let valido = true;

    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const passwordRegex = /^.{6,17}$/;

    if (!emailRegex.test(email)) {
        // ... código de manejo de error para el campo de email ...
        valido = false;
    } else {
        // ... código de manejo de éxito para el campo de email ...
    }

    if (!passwordRegex.test(password)) {
        // ... código de manejo de error para el campo de password ...
        valido = false;
    } else {
        // ... código de manejo de éxito para el campo de password ...
    }

    // Validación del campo de Rol
    if (rol === "") {
        alert("Por favor ingrese un rol");
        valido = false;
    } 

    if (valido) {
        // Si todos los campos son válidos, enviar el formulario
        event.preventDefault();
        

        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
        document.getElementById('rol').value = '';

        // Crear un objeto FormData para enviar los datos
        const formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        formData.append('rol', rol);

        // Enviar la solicitud POST
        fetch('../navegabilidad/regInformatico.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log(response);  // Ver la respuesta del servidor
            return response.text();  // Intentar obtener el texto de la respuesta
        })
        .then(data => {
            console.log(data);  // Ver el texto de la respuesta
            try {
                const jsonData = JSON.parse(data);
                if (jsonData.error) {
                    alerta('¡Email repetido!');
                } else {
                    alerta('¡Perfil registrado correctamente!');
                } 
            } catch (error) {
                console.error('Error al parsear JSON:', error);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        event.preventDefault();
        document.getElementById('botonAlerta').style.display = 'block';
    }
});

function alerta(mesaje){

    swal(mesaje);
    
    }