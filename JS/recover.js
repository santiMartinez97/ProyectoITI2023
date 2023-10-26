var formulario = document.getElementById("loginForm");

let noEncontrado = `<article class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fa-solid fa-triangle-exclamation"></i> Email no encontrado.</article>`;
let correoEnviado = `<article class="alert alert-success d-flex align-items-center" role="alert">
<i class="fa-solid fa-check"></i> El correo de recuperación ha sido enviado. Por favor, revise su casilla en su correo electrónico.</article>`;

formulario.addEventListener("submit", function (e) {
  e.preventDefault();
  document.getElementById('loader-div').style.display = "block"; // Mostrar carga

  let datos = new FormData(formulario);
    let url = 'BACKPHP/recover.php';
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
          document.getElementById("mensajeSalida").innerHTML = correoEnviado;
          document.getElementById('loader-div').style.display = "none"; // Ocultar carga
          break;

        case "not found":
          document.getElementById("mensajeSalida").innerHTML = noEncontrado;
          document.getElementById('loader-div').style.display = "none"; // Ocultar carga
          break;

        default:
          console.log(data);
          document.getElementById('loader-div').style.display = "none"; // Ocultar carga
      }

    })
    .catch(function (error) {
      console.error("Error al enviar el resultado al servidor:", error);
    });
});
