var formulario = document.getElementById("loginForm");

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
          alert("El usuario no se encuentra habilitado.");
          break;

        case "Bloqueado":
          document.getElementById("loginForm").reset();
          document.getElementById("enviar").disabled = true;
          alert("Limite de intentos excedido. Intente más tarde.");
          break;

        default:
          document.getElementById("loginForm").reset();
          alert("Usuario y/o Contraseñas incorrectos.");
      }

    })
    .catch(function (error) {
      console.error("Error al enviar el resultado al servidor:", error);
    });
});
