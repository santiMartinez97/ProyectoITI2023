var formulario = document.getElementById("FrnINS");

const inputs = document.querySelectorAll('#FrnINS input');

var botonId = document.getElementById("botonAlerta");
var errorRepeticion = document.getElementById("errorRepeticion");

const expresionesRegulares = {
  menu : /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜ\s,.\s]{2,30}$/, // Letras y espacios con acentos.
  precio : /^\d{2,6}$/, // digitos
  descuento : /^\d{1,2}$/, //digitos
  stock : /^\d{1,4}$/, // digitos
  stockMinimo : /^\d{1,4}$/, // digitos.
  stockMaximo : /^\d{1,4}$/, // digitos.
  descripcion : /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜ\s,.\s]{2,500}$/, //\d{2}
}

const validacionCampos = {
  menu : false,
  precio : false,
  descuento : false,
  stock : false,
  stockMinimo : false,
  stockMaximo : false, 
  descripcion : false,
  imagen : false
}

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "menu":
      validarCampos(expresionesRegulares.menu, e.target, 'menu');
    break;
    case "precio":
      validarCampos(expresionesRegulares.precio, e.target, 'precio');      
    break;
    case "descuento":
      validarCampos(expresionesRegulares.descuento, e.target, 'descuento');      
    break;
    case "stock":
      validarCampos(expresionesRegulares.stock, e.target, 'stock');
    break;
    case "stockMinimo":
      validarCampos(expresionesRegulares.stockMinimo, e.target, 'stockMinimo');
    break;
    case "stockMaximo":
      validarCampos(expresionesRegulares.stockMaximo, e.target, 'stockMaximo');
    break;
    case "descripcion":
      validarCampos(expresionesRegulares.descripcion, e.target, 'descripcion');
    break;
    case "imagen":
      validarImagen();
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
    validacionCampos['campo'] = false;
  }
}

// Verificar si se ha subido un archivo.
const validarImagen = () => {
  let fileInput = document.getElementById("imagen");
  if (fileInput.files.length > 0) {
    let imageFile = fileInput.files[0];
    if (esImagenValida(imageFile) && imageFile.size <= 1024 * 1024) {
      document.getElementById(`grupo__imagen`).classList.remove("grupo__error");
      document.getElementById(`grupo__imagen`).classList.add("grupo__correcto");
      document.querySelector(`#grupo__imagen .grupo_input-error`).classList.remove('grupo_input-error-activo');
      validacionCampos['imagen'] = true;
    } else {
      document.getElementById(`grupo__imagen`).classList.remove("grupo__correcto");
      document.getElementById(`grupo__imagen`).classList.add("grupo__error");
      document.querySelector(`#grupo__imagen .grupo_input-error`).classList.add('grupo_input-error-activo');
      validacionCampos['imagen'] = false;
    }
  }
}

const esImagenValida = file => {
  // Verifica si el archivo tiene una extensión de imagen válida
  const extensionesValidas = ["jpg", "jpeg", "png", "gif"];
  const extension = file.name.split(".").pop().toLowerCase();
  return extensionesValidas.includes(extension);
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
  e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.
if (validacionCampos.menu && validacionCampos.precio && validacionCampos.descuento && validacionCampos.stock && validacionCampos.stockMinimo && validacionCampos.stockMaximo && validacionCampos.descripcion && validacionCampos.imagen){
    var datos = new FormData(formulario); 
    let fileInput = document.getElementById("imagen");
    let imageFile = fileInput.files[0];
    datos.append("imagen", imageFile);
    let url = '../persistencia/altaMenu.php';
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

swal('¡Menú publicado exitosamente!', 'Ya se encuentra publicado en el sitio web.', 'success');

}