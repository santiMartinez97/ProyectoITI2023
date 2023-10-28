var formulario = document.getElementById("FrnINS");

const inputs = document.querySelectorAll('#FrnINS input');

var botonId = document.getElementById("botonAlerta");
var errorRepeticion = document.getElementById("errorRepeticion");

const expresionesRegulares = {
  nombre : /^[a-zA-Z0-9-ZáéíóúüÁÉÍÓÚÜ\s]{2,30}$/, // Letras y espacios con acentos.
  vidaUtil : /^\d{1,2}$/, //letras y espacion con acentos
  cantidad : /^\d{1,2}$/, //letras y espacion con acentos    
  descripcion : /^[a-zA-Z0-9-ZáéíóúüÁÉÍÓÚÜ\s]{2,500}$/, //\d{2}
}

const validacionCampos = {
  nombre : false,
  vidaUtil : false,
  cantidad : false,
  descripcion : false,
}

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "nombre":
      validarCampos(expresionesRegulares.nombre, e.target, 'nombre');
    break;
    case "vidaUtil":
      validarCampos(expresionesRegulares.vidaUtil, e.target, 'vidaUtil');      
    break;
    case "cantidad":
      validarCampos(expresionesRegulares.cantidad, e.target, 'cantidad');      
    break;
    case "descripcion":
      validarCampos(expresionesRegulares.descripcion, e.target, 'descripcion');
    break;
  }
}

const validarCampos = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    document.getElementById(`grupo__${campo}`).classList.remove("grupo__error");
    document.getElementById(`grupo__${campo}`).classList.add("grupo__correcto");
    document.querySelector(`#grupo__${campo} .grupo_input-error`).classList.remove('grupo_input-error-activo');
    validacionCampos[campo] = true;
  }
  else {
    document.getElementById(`grupo__${campo}`).classList.remove("grupo__correcto");
    document.getElementById(`grupo__${campo}`).classList.add("grupo__error");
    document.querySelector(`#grupo__${campo} .grupo_input-error`).classList.add('grupo_input-error-activo');
    validacionCampos[campo] = false;
  }
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
  e.preventDefault(); 
if (validacionCampos.nombre && validacionCampos.vidaUtil && validacionCampos.cantidad && validacionCampos.descripcion){
  var datos = new FormData(formulario); 
    let url = '../persistencia/altaViandas.php';
    alerta(); 
    botonId.classList.remove("grupo_input-error-activo");
    errorRepeticion.classList.remove("grupo_input-error-activo");
  fetch(url, {
    method: "POST",
    body: datos,
  }).then(function(res){
    formulario.reset();
    return res.json(); 
  })
  
}
else {
  botonId.classList.add("grupo_input-error-activo");
}

});

function alerta(){

swal('¡Viandas publicadas exitosamente!', 'Ya se encuentra publicado en la base de datos', 'success');

}