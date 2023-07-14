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
        case "webPrueba@gmail.com":
          location.href = "navegabilidad/homeCliente.php";
          break;

        case "empresaPrueba@gmail.com":
          location.href = "navegabilidad/homeCliente.php";
          break;

        case "admin@sisviansa.com":
          location.href = "navegabilidad/admin.php";
          break;

        case "gerentePrueba@sisviansa.com":
          location.href = "navegabilidad/gerente.php";
          break;

        case "inforPrueba@sisviansa.com":
          location.href = "navegabilidad/informatico.php";
          break;

        case "cocinaJefe@sisviansa.com":
          location.href = "navegabilidad/jefeCocina.php";
          break;

        case "atencion@sisviansa.com":
          location.href = "navegabilidad/atencionPublico.php";
          break;
          default:
            document.getElementById("loginForm").reset();
            alert("Usuario y/o Contraseñas incorrectos");
      }

    })
    .catch(function (error) {
      console.error("Error al enviar el resultado al servidor:", error);
    });
});
