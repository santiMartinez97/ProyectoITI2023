var formulario = document.getElementById("loginForm");

let datosIncorrectos = `<article class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fa-solid fa-circle-exclamation"></i> Usuario y/o contraseña incorrecto.</article>`;
let limiteExcedido = `<article class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fa-solid fa-lock"></i> Limite de intentos excedido. Intente más tarde.</article>`;
let usuarioNoHabilitado = `<article class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fa-solid fa-user-slash"></i> El usuario no se encuentra habilitado.</article>`;

formulario.addEventListener("submit", function (e) {
  e.preventDefault();

  let datos = new FormData(formulario);
    let url = 'BACKPHP/loginphp.php';
  fetch(url, {
    method: "POST",
    body: datos,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      switch (data) {
        case "cliente":
          location.href = "index.php";
          break;

        case "admin":
          location.href = "navegabilidad/admin.php";
          break;

        case "gerente":
          location.href = "navegabilidad/gerente.php";
          break;

        case "informatico":
          location.href = "navegabilidad/informatico.php";
          break;

        case "jefeCocina":
          location.href = "navegabilidad/jefeCocina.php";
          break;

        case "atencionPublico":
          location.href = "navegabilidad/atencionPublico.php";
          break;

        case "No habilitado":
          document.getElementById("loginForm").reset();
          document.getElementById("loginError").innerHTML = usuarioNoHabilitado;
          break;

        case "Bloqueado":
          document.getElementById("loginForm").reset();
          document.getElementById("enviar").disabled = true;
          document.getElementById("loginError").innerHTML = limiteExcedido;
          break;

        default:
          document.getElementById("loginForm").reset();
          document.getElementById("loginError").innerHTML = datosIncorrectos;
      }

    })
    .catch(function (error) {
      console.error("Error al enviar el resultado al servidor:", error);
    });
});
