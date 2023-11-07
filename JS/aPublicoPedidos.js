// Agregar campos de cantidad dinámicamente
document.getElementById('agregar-menu').addEventListener('click', function() {
    const menuSelect = document.getElementById('menu');
    const selectedMenus = menuSelect.selectedOptions;

    for (const menu of selectedMenus) {
      // Verificar si ya existe un campo para este menú
      if (!document.querySelector(`input[name="cantidad_${menu.value}"]`)) {
        const label = document.createElement('label');
        label.textContent = `Cantidad para ${menu.text}:`;

        const input = document.createElement('input');
        input.type = 'number';
        input.name = `cantidad_${menu.value}`;
        input.min = 1;
        input.max = menu.dataset.max;
        input.value = 1;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.addEventListener('click', function() {
          // Eliminar el campo de cantidad y el botón "Eliminar"
          label.remove();
          input.remove();
          deleteButton.remove();
        });

        const cantidadMenu = document.getElementById('cantidad-menu');
        cantidadMenu.appendChild(label);
        cantidadMenu.appendChild(input);
        cantidadMenu.appendChild(deleteButton);
      }
    }
});

document.getElementById('pedido-form').addEventListener('submit', function(event) {
  // Validar si al menos un menú está seleccionado
  const menuSelect = document.getElementById('menu');
  if (menuSelect.selectedOptions.length === 0) {
    alert("Debes seleccionar al menos un menú.");
    event.preventDefault(); // Prevenir el envío del formulario
    return;
  }

  // Validar si se ha especificado una cantidad para cada menú seleccionado
  const selectedMenus = menuSelect.selectedOptions;
  for (const menu of selectedMenus) {
    const cantidadInput = document.querySelector(`input[name="cantidad_${menu.value}"]`);
    if (!cantidadInput || cantidadInput.value.trim() === '') {
      alert(`Debes especificar una cantidad para el menú "${menu.text}".`);
      event.preventDefault(); // Prevenir el envío del formulario
      return;
    }
  }
});

// Mostrar un alert de confirmación si el parámetro 'confirmacion' está presente en la URL
    window.addEventListener("load", function() {
      const params = new URLSearchParams(window.location.search);
      if (params.get("confirmacion") === "1") {
        alert("Pedido confirmado.");
      }else if(params.get("confirmacion") === "0"){
        alert("Error, no hay suficiente stock.");
      }else if(params.get("confirmacion") === "2"){
        alert("Debes seleccionar al menos un menú.");
      }else if(params.get("confirmacion") === "3"){
        alert("Debes especificar una cantidad para el menú.");
      }
    });