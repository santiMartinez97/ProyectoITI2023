//formulario
var formulario = document.getElementById("formulario");
var respues = document.getElementById("respuesta");

//datos ingresados del html cliente web
const inputs = document.querySelectorAll('#formulario input');

var botonId = document.getElementById("botonAlerta");
var errorRepeticion = document.getElementById("errorRepeticion");

const expresionesRegulares = {
  nombre :/^[a-zA-ZáéíóúüÁÉÍÓÚÜ]{2,20}$/, // Letras y espacios con acentos.
  apellido :/^[a-zA-ZáéíóúüÁÉÍÓÚÜ]{2,20}$/, //letras y espacion con acentos
  ci : /^\d{8}(\.\d+)?$/, // 8 digitos
  telefono : /^09\d{7}$/, // 9 numeros.
  calle : /^[a-zA-Z0-9\s]{2,30}$/, //\d{2}
  numero : /^\d{3,4}(\.\d+)?$/, //numero casa
  esquina : /^[a-zA-Z0-9\s]{2,30}$/,
  barrio : /^[a-zA-Z0-9\s]{2,30}$/
}

const validacionCampos = {
    nombre : false,
    apellido : false,
    ci : false,
    telefono : false, 
    calle : false,
    numero : false,
    esquina : false,
    barrio : false
}
  
const validarFormulario = (e) => {
    switch (e.target.name) {
      case "nombre":
        validarCampos(expresionesRegulares.nombre, e.target, 'nombre');
      break;
      case "apellido":
        validarCampos(expresionesRegulares.apellido, e.target, 'apellido');      
      break;
      case "ci":
        validarCampos(expresionesRegulares.ci, e.target, 'ci');
      break;
      case "telefono":
        validarCampos(expresionesRegulares.telefono, e.target, 'telefono');
      break;
      case "calle":
        validarCampos(expresionesRegulares.calle, e.target, 'calle');   
      break;
      case "numero":
        validarCampos(expresionesRegulares.numero, e.target, 'numero');//valida
      break;
      case "esquina":
        validarCampos(expresionesRegulares.esquina, e.target, 'esquina');//valida
      break;
      case "barrio":
        validarCampos(expresionesRegulares.barrio, e.target, 'barrio');//valida
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
    e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.
  if (validacionCampos.nombre && validacionCampos.apellido && validacionCampos.ci && validacionCampos.telefono && validacionCampos.calle && validacionCampos.numero && validacionCampos.esquina && validacionCampos.barrio){
    var datos = new FormData(formulario); 
    let url = '../BACKPHP/altaClientePresencial.php';
    botonId.classList.remove("grupo_input-error-activo");
    errorRepeticion.classList.remove("grupo_input-error-activo");
    fetch(url, {
      method: "POST",
      body: datos,
    
    }).then(function(res){
        return res.json();
    }).then(function(data){
      switch(data){
        case "Cedula repetida":
          document.getElementById(`grupo__ci`).classList.remove("grupo__correcto");
          document.getElementById(`grupo__ci`).classList.add("grupo__error");
          document.querySelector(`#grupo__ci .grupo_input-error`).classList.add('grupo_input-error-activo');
          validacionCampos["ci"] = false;
  
          errorRepeticion.innerText = "La cédula ingresada ya está en uso."
          errorRepeticion.classList.add("grupo_input-error-activo");
          break;
  
        default:
          formulario.reset();
          alert("Cliente añadido correctamente.");
      }
    });
  }
  else {
    botonId.classList.add("grupo_input-error-activo");
  }
});