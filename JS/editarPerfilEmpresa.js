var formulario = document.getElementById("formularioEmpresa");
const inputs = document.querySelectorAll('#formularioEmpresa input');
var botonId = document.getElementById("botonAlerta");
var errorRepeticion = document.getElementById("errorRepeticion");

const expresionesRegulares = {
  email : /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
  empresa : /^[a-zA-ZÀ-ÿ\s]{2,40}$/, // Letras y espacios con acentos.
  rut : /^.{12}$/, 
  password : /^.{6,17}$/, // 6 a 17 digitos.
  emai : /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, //valida email
  telefono : /^2\d{7}$/, // 9 numeros.
  calle : /^[a-zA-ZÀ-ÿ\s]{2,30}$/, //\d{2}
  numero : /^.{3,4}$/, //numero casa
  esquina : /^[a-zA-ZÀ-ÿ\s]{2,30}$/,
  barrio : /^[a-zA-ZÀ-ÿ\s]{2,30}$/
}

const validacionCampos = {
  email : false,
  empresa : false,
  rut : false,
  telefono : false, 
  calle : false,
  numero : false,
  esquina : false,
  barrio : false
}

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "rut":
      validarCampos(expresionesRegulares.rut, e.target, 'rut');
    break;
    case "empresa":
      validarCampos(expresionesRegulares.empresa, e.target, 'empresa');
    break;
    case "email":
      validarCampos(expresionesRegulares.email, e.target, 'email');
    break;
    case "telefono":
      validarCampos(expresionesRegulares.telefono, e.target, 'telefono');
    break;
    case "calle":
      validarCampos(expresionesRegulares.calle, e.target, 'calle');   
    break;
    case "numero":
      validarCampos(expresionesRegulares.numero, e.target, 'numero');
    break;
    case "esquina":
      validarCampos(expresionesRegulares.esquina, e.target, 'esquina');
    break;
    case "barrio":
      validarCampos(expresionesRegulares.barrio, e.target, 'barrio');
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
  document.getElementById('loader-div').style.display = "block"; // Mostrar carga
if (validacionCampos.rut && validacionCampos.empresa && validacionCampos.email && validacionCampos.telefono &&  validacionCampos.calle && validacionCampos.numero && validacionCampos.esquina && validacionCampos.barrio){
  var datos = new FormData(formulario); 
    let url = 'EnviarPerfilActualizadoEmpresa.php';
    botonId.classList.remove("grupo_input-error-activo");
    errorRepeticion.classList.remove("grupo_input-error-activo");
  fetch(url, {
    method: "POST",
    body: datos,
  }).then(function(res){
    //console.log(res.text());
    return res.json();
  }).then(function(data){
    switch(data){
      case "Email y RUT repetidos":
        document.getElementById(`grupo__email`).classList.remove("grupo__correcto");
        document.getElementById(`grupo__email`).classList.add("grupo__error");
        document.querySelector(`#grupo__email .grupo_input-error`).classList.add('grupo_input-error-activo');
        validacionCampos["email"] = false;

        document.getElementById(`grupo__rut`).classList.remove("grupo__correcto");
        document.getElementById(`grupo__rut`).classList.add("grupo__error");
        document.querySelector(`#grupo__rut .grupo_input-error`).classList.add('grupo_input-error-activo');
        validacionCampos["rut"] = false;

        errorRepeticion.innerText = "El email y el RUT ingresado ya están en uso."
        errorRepeticion.classList.add("grupo_input-error-activo");
        document.getElementById('loader-div').style.display = "none"; // Ocultar carga
        break;
      
      case "Email repetido":
        document.getElementById(`grupo__email`).classList.remove("grupo__correcto");
        document.getElementById(`grupo__email`).classList.add("grupo__error");
        document.querySelector(`#grupo__email .grupo_input-error`).classList.add('grupo_input-error-activo');
        validacionCampos["email"] = false;

        errorRepeticion.innerText = "El email ingresado ya está en uso."
        errorRepeticion.classList.add("grupo_input-error-activo");
        document.getElementById('loader-div').style.display = "none"; // Ocultar carga
        break;

      case "RUT repetido":
        document.getElementById(`grupo__rut`).classList.remove("grupo__correcto");
        document.getElementById(`grupo__rut`).classList.add("grupo__error");
        document.querySelector(`#grupo__rut .grupo_input-error`).classList.add('grupo_input-error-activo');
        validacionCampos["rut"] = false;

        errorRepeticion.innerText = "El RUT ingresado ya está en uso."
        errorRepeticion.classList.add("grupo_input-error-activo");
        document.getElementById('loader-div').style.display = "none"; // Ocultar carga
        break;
        
      default:
        formulario.reset();
        document.getElementById('loader-div').style.display = "none"; // Ocultar carga
        alerta();
    }
  });
}
else {
  botonId.classList.add("grupo_input-error-activo");
  document.getElementById('loader-div').style.display = "none"; // Ocultar carga
}
});
  