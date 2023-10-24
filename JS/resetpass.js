var formulario = document.getElementById("loginForm");

let noCoincide = `<article class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fa-solid fa-triangle-exclamation"></i> Las contraseñas ingresadas no coinciden.</article>`;
let cambioExitoso = `<article class="alert alert-success d-flex align-items-center" role="alert">
<i class="fa-solid fa-check"></i> La contraseña ha sido modificada con éxito. Ya puede intentar iniciar sesión.</article>`;
let passNoAceptable = `<article class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fa-solid fa-triangle-exclamation"></i> Las contraseña debe tener entre 6 y 17 caracteres.</article>`;

const passVal = /^.{6,17}$/; // 6 a 17 digitos.

formulario.addEventListener("submit", function (e) {
    e.preventDefault();
  
    let datos = new FormData(formulario);

    if(!passVal.test(datos.get('pass'))){
      document.getElementById("mensajeSalida").innerHTML = passNoAceptable;
    }else if(datos.get('pass') != datos.get('passConfirm')){
        document.getElementById("mensajeSalida").innerHTML = noCoincide;
    }else{
        let url = 'BACKPHP/resetpass.php';
        fetch(url, {
          method: "POST",
          body: datos,
        })
          .then(function (res) {
            return res.json();
          })
          .then(function (data) {
            switch (data) {
      
              case "success":
                document.getElementById("mensajeSalida").innerHTML = cambioExitoso;
                break;
      
              default:
                console.log(data);
            }
      
          })
          .catch(function (error) {
            console.error("Error al enviar el resultado al servidor:", error);
          });
    }
    
  });
  