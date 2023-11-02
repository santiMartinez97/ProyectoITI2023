document.addEventListener('DOMContentLoaded', function () {
    const selectViandas = document.getElementById('viandas');
    const agregarViandaButton = document.getElementById('agregarVianda');
    const quitarViandaButton = document.getElementById('quitarVianda');
    const viandasSeleccionadas = document.getElementById('viandasSeleccionadas');
  
    const viandas = [];
  
    agregarViandaButton.addEventListener('click', function () {
      const selectedOption = selectViandas.options[selectViandas.selectedIndex];
      if (selectedOption && selectedOption.value !== '') {
        viandas.push(selectedOption.value);
        updateViandasSeleccionadas();
      }
    });
  
    quitarViandaButton.addEventListener('click', function () {
      if (viandas.length > 0) {
        viandas.pop();
        updateViandasSeleccionadas();
      }
    });
  
    function updateViandasSeleccionadas() {
      viandasSeleccionadas.textContent = viandas.join(', ');
    }
  });