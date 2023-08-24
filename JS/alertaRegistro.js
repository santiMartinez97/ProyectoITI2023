function alerta(){

    swal('Acceso requerido', 'Por favor, regístrese o inicie sesión antes de proceder con la compra. Gracias por su interés.', 'error');
    
    }


document.addEventListener("DOMContentLoaded", function() {
  // Obtener el botón por su ID
  var comprarBtn = document.getElementById("comprarBtn");

  // Agregar el evento de clic al botón
  comprarBtn.addEventListener("click", function() {
    // Mostrar una alerta cuando se hace clic en el botón
    alerta();
  });
});


document.addEventListener("DOMContentLoaded", function() {
    // Obtener el botón por su ID
    var carritoBtn = document.getElementById("carritoBtn");
  
    // Agregar el evento de clic al botón
    carritoBtn.addEventListener("click", function() {
      // Mostrar una alerta cuando se hace clic en el botón
      alerta();
    });
  });