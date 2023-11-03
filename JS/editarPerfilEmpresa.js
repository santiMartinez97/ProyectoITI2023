var formulario = document.getElementById("formularioEmpresa");
const inputs = document.querySelectorAll('#formularioEmpresa input');
var botonId = document.getElementById("botonAlerta");
var errorRepeticion = document.getElementById("errorRepeticion");

const expresionesRegulares = {
  email : /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
  empresa : /^[a-zA-ZÀ-ÿ\s]{2,40}$/, // Letras y espacios con acentos.
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
  telefono : false, 
  calle : false,
  numero : false,
  esquina : false,
  barrio : false
}

const validarFormulario = (e) => {
  switch (e.target.name) {
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


document.addEventListener('DOMContentLoaded', function() {
  validarCamposIniciales();
});

function validarCamposIniciales() {
  inputs.forEach((input) => {
    validarCampos(expresionesRegulares[input.name], input, input.name);
  });
}


formulario.addEventListener('submit', (e) => {
  e.preventDefault(); 

  if (validacionCampos.empresa && validacionCampos.email && validacionCampos.telefono &&  
      validacionCampos.calle && validacionCampos.numero && validacionCampos.esquina && validacionCampos.barrio) {

    var datos = new FormData(formulario); 
    let url = 'EnviarPerfilActualizadoEmpresa.php';
    botonId.classList.remove("grupo_input-error-activo");

    fetch(url, {
      method: "POST",
      body: datos,
    }).then(function(res){
      if (!res.ok) {
        throw new Error('La solicitud fetch falló');
      }
      return res.json();
    }).then(function(data){
    
      console.log('Solicitud completada con éxito:', data);
      
      
    }).catch(function(error) {
      console.error('Error:', error);

    });
    
  } else {
    botonId.classList.add("grupo_input-error-activo");
  }
  alerta();
});

function alerta(){

  swal('¡Datos actualizados correctamente!');
  
  }
  