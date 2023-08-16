//formulario
var formulario = document.getElementById("formulario");
var respues = document.getElementById("respuesta");

//datos ingresados del html cliente web
const inputs = document.querySelectorAll('#formulario input');

var botonId = document.getElementById("botonAlerta")

const expresionesRegulares = {
  email : /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
  nombre : /^[a-zA-ZÀ-ÿ]{2,40}$/, // Letras y espacios con acentos.
  apellido : /^[a-zA-ZÀ-ÿ]{2,40}$/, //letras y espacion con acentos
  ci : /^\d{8}(\.\d+)?$/, // 8 digitos
  password : /^.{6,17}$/, // 6 a 17 digitos.
  telefono : /^09\d{7}$/, // 9 numeros.
  calle : /^[a-zA-Z0-9\s]{2,30}$/, //\d{2}
  numero : /^\d{3,4}(\.\d+)?$/, //numero casa
  esquina : /^[a-zA-Z0-9\s]{2,30}$/,
  barrio : /^[a-zA-Z0-9\s]{2,30}$/
}

const validacionCampos = {
  email : false,
  nombre : false,
  apellido : false,
  ci : false,
  password : false,
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
    case "email":
      validarCampos(expresionesRegulares.email, e.target, 'email');
    break;
    case "password":
      validarCampos(expresionesRegulares.password, e.target, 'password');
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
if (validacionCampos.nombre && validacionCampos.apellido && validacionCampos.ci && validacionCampos.email && validacionCampos.telefono && validacionCampos.password && validacionCampos.calle && validacionCampos.numero && validacionCampos.esquina && validacionCampos.barrio){
  var datos = new FormData(formulario); 
    let url = 'BACKPHP/registroClienteWeb.php';
    botonId.classList.remove("grupo_input-error-activo");
  fetch(url, {
    method: "POST",
    body: datos,
  
  });
  
  formulario.reset();
  alerta();
}
else {
  botonId.classList.add("grupo_input-error-activo");
}
});

function alerta(){

swal('¡Formulario enviado exitosamente!', 'Se le notificara por correo electronico si cumple los requisitos para poder registrarse. Muchas gracias por querer ser parte de SISVIANSA ', 'success');

}

function web_empresa() {
  let tipoUsuario = document.getElementById("tipo_usuario").value;
  let camposExtras = document.getElementById("campos");
  camposExtras.innerHTML = "";

  if (tipoUsuario == "web") {
    camposExtras.innerHTML = `
    
  <form id="formularioWeb" class="row no-gutters ">          

  <!-- SEPARAMOS POR GRUPOS CADA CAMPO -->
              
  <!-- Grupo nombre -->
  <article class="col-6 grupo" id="grupo__nombre">
    <label></label>
    <article class="grupo__input">  
     <input type="text" name="nombre" id="nombre" class="formulario__input form-control" placeholder="Nombre">
    </article>       
     <p class="grupo_input-error">Ingrese un nombre valido </p>
  </article>
    
     <!-- Grupo apellido -->
    <article class="col-6" id="grupo__apellido">
     <label></label>
     <article class="grupo__input">
      <input type="text" name="apellido" id="apellido" class="formulario__input form-control" placeholder="Apellido">
     </article>   
     <p class="grupo_input-error">Ingrese un apellido valido</p>
    </article> 
    

     <!-- Grupo cedula -->
    <article class="col-8 grupo" id="grupo__ci">
        <label></label>
        <article class="grupo__input">
        <input type="number" name="ci" id="ci" class="formulario__input form-control" placeholder="Documento">
        </article>  
        <p class="grupo_input-error">Ingrese su cedula sin puntos ni guiones</p>
    </article >
    
     <!-- Grupo email -->
    <article class="col-7 grupo" id="grupo__email">
        <label></label>
        <article class="grupo__input">
        <input type="email" name="email" id="email" class="formulario__input form-control" placeholder="Email">
        </article> 
          <p class="grupo_input-error">Ingrese un email valido</p>
    </article>
    
     <!-- Grupo password -->
    <article class="col-5 grupo" id="grupo__password">
        <label></label>
        <article class="grupo__input">
        <input type="password" name="password" id="password"  class="formulario__input form-control" placeholder="Contraseña"> 
      </article>
          <p class="grupo_input-error">Ingrese una contraseña de 6 a 17 digitos</p> 
    </article>
    
     <!-- Grupo telefono -->
    <article class="col-8 grupo" id="grupo__telefono">
        <label></label>
        <article class="grupo__input">
        <input type="number" name="telefono" id="telefono" class="formulario__input form-control"  placeholder="Telefono">
        </article>
          <p class="grupo_input-error">Ingrese su numero de telefono </p> 
    </article>
    
     <!-- Grupo calle -->
    <article class="col-7 grupo" id="grupo__calle">
        <label></label>
        <article class="grupo__input">
        <input type="text" name="calle" id="calle" class="formulario__input form-control" placeholder="Calle">
        </article>
          <p class="grupo_input-error">Ingrese una calle valida</p>
    </article>
    
     <!-- Grupo numero -->
    <article class="col-5 grupo" id="grupo__numero">
        <label></label>
        <article class="grupo__input">
        <input type="number" name="numero" id="numero" class="formulario__input form-control" placeholder="Numero">
        </article>
          <p class="grupo_input-error">Ingrese un numero de puerta valido</p>
    </article>
    
     <!-- Grupo esquina -->
    <article class="col-6 grupo" id="grupo__esquina">
        <label></label>
        <article id="grupo__input">
        <input type="text" name="esquina" id="esquina" class="formulario__input form-control" placeholder="Esquina">
        </article>
          <p class="grupo_input-error">Ingrese una esquina valida</p>        
    </article>
    
     <!-- Grupo barrio -->
    <article class="col-6 grupo" id="grupo__barrio">
        <label></label>
        <article  class="grupo__input">
          <input type="text" name="barrio" id="barrio" class="formulario__input form-control" placeholder="Barrio"> 
        </article> 
          <p class="grupo_input-error">Ingrese un barrio valido</p>
    </article>

    <article class="col-12 text-center" >
      <button class="btn btn-primary " id="enviar"  type="submit" >Enviar</button> 
      <p id="botonAlerta" class="grupo_input-error">Complete bien los campos porfavor</p>
    </article>       
</article>
     
 </form>
        `;
      
  const inputs = document.querySelectorAll('#formularioWeb input');
  var botonId = document.getElementById("botonAlerta")
        
  const expresionesRegulares = {
    email : /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
    nombre : /^[a-zA-ZÀ-ÿ\s]{2,40}$/, // Letras y espacios con acentos.
    apellido : /^[a-zA-ZÀ-ÿ\s]{2,40}$/, //letras y espacion con acentos
    ci : /^\d{8}(\.\d+)?$/, // 8 digitos
    password : /^.{6,17}$/, // 6 a 17 digitos.
    telefono : /^09\d{7}$/, // 9 numeros.
    calle : /^[a-zA-ZÀ-ÿ\s]{2,30}$/, //\d{2}
    numero : /^\d{3,4}(\.\d+)?$/, //numero casa
    esquina : /^[a-zA-ZÀ-ÿ\s]{2,30}$/,
    barrio : /^[a-zA-ZÀ-ÿ\s]{2,30}$/
    }
        
  const validacionCampos = {
    email : false,
    nombre : false,
    apellido : false,
    ci : false,
    password : false,
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
      case "email":
        validarCampos(expresionesRegulares.email, e.target, 'email');
      break;
      case "password":
        validarCampos(expresionesRegulares.password, e.target, 'password');
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
  if (validacionCampos.nombre && validacionCampos.apellido && validacionCampos.ci && validacionCampos.email && validacionCampos.telefono && validacionCampos.password && validacionCampos.calle && validacionCampos.numero && validacionCampos.esquina && validacionCampos.barrio){
    var datos = new FormData(formulario); 
      let url = 'BACKPHP/registroClienteWeb.php';
      botonId.classList.remove("grupo_input-error-activo");
    fetch(url, {
      method: "POST",
      body: datos,
    
    });
    
    formulario.reset();
    alerta();
  }
  else {
    botonId.classList.add("grupo_input-error-activo");
  }
  });        
  } else if (tipoUsuario === "empresa") {
    camposExtras.innerHTML = `
       
    <form id="formularioEmpresa" class="row no-gutters ">          

    <!-- SEPARAMOS POR GRUPOS CADA CAMPO -->
              
  <!-- Grupo RUT -->
  <article class="col-6 grupo" id="grupo__rut">
    <label></label>
    <article class="grupo__input">  
     <input type="text" name="rut" id="rut" class="formulario__input form-control" placeholder="RUT">
    </article>       
     <p class="grupo_input-error">Ingrese un rut valido</p>
  </article>
    
     <!-- Grupo Nombre empresa-->
    <article class="col-6" id="grupo__empresa">
     <label></label>
     <article class="grupo__input">
      <input type="text" name="empresa" id="empresa" class="formulario__input form-control" placeholder="Nombre Empresa">
     </article>   
     <p class="grupo_input-error">Ingrese un nombre valido</p>
    </article> 
    
     <!-- Grupo email -->
    <article class="col-7 grupo" id="grupo__email">
        <label></label>
        <article class="grupo__input">
        <input type="email" name="email" id="email" class="formulario__input form-control" placeholder="Email">
        </article> 
          <p class="grupo_input-error">Ingrese un email valido</p>
    </article>
    
     <!-- Grupo password -->
    <article class="col-5 grupo" id="grupo__password">
        <label></label>
        <article class="grupo__input">
        <input type="password" name="password" id="password"  class="formulario__input form-control" placeholder="Contraseña"> 
      </article>
          <p class="grupo_input-error">Ingrese una contraseña de 6 a 17 digitos</p> 
    </article>
    
     <!-- Grupo telefono -->
    <article class="col-8 grupo" id="grupo__telefono">
        <label></label>
        <article class="grupo__input">
        <input type="number" name="telefono" id="telefono" class="formulario__input form-control"  placeholder="Telefono">
        </article>
          <p class="grupo_input-error">Ingrese su numero de telefono </p> 
    </article>
    
     <!-- Grupo calle -->
    <article class="col-7 grupo" id="grupo__calle">
        <label></label>
        <article class="grupo__input">
        <input type="text" name="calle" id="calle" class="formulario__input form-control" placeholder="Calle">
        </article>
          <p class="grupo_input-error">Ingrese una calle valida</p>
    </article>
    
     <!-- Grupo numero -->
    <article class="col-5 grupo" id="grupo__numero">
        <label></label>
        <article class="grupo__input">
        <input type="number" name="numero" id="numero" class="formulario__input form-control" placeholder="Numero">
        </article>
          <p class="grupo_input-error">Ingrese un numero de puerta valido</p>
    </article>
    
     <!-- Grupo esquina -->
    <article class="col-6 grupo" id="grupo__esquina">
        <label></label>
        <article id="grupo__input">
        <input type="text" name="esquina" id="esquina" class="formulario__input form-control" placeholder="Esquina">
        </article>
          <p class="grupo_input-error">Ingrese una esquina valida</p>        
    </article>
    
     <!-- Grupo barrio -->
    <article class="col-6 grupo" id="grupo__barrio">
        <label></label>
        <article  class="grupo__input">
          <input type="text" name="barrio" id="barrio" class="formulario__input form-control" placeholder="Barrio"> 
        </article> 
          <p class="grupo_input-error">Ingrese un barrio valido</p>
    </article>

    <article class="col-12 text-center" >
      <button class="btn btn-primary " id="enviar"  type="submit" >Enviar</button> 
      <p id="botonAlerta" class="grupo_input-error">Complete bien los campos porfavor</p>
    </article>       
</article>

 </form>
      
        `;

//formularioEmpresa
var formulario = document.getElementById("formularioEmpresa");
const inputs = document.querySelectorAll('#formularioEmpresa input');
var botonId = document.getElementById("botonAlerta")

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
  password : false,
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
    case "password":
      validarCampos(expresionesRegulares.password, e.target, 'password');
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
if (validacionCampos.rut && validacionCampos.empresa && validacionCampos.email && validacionCampos.telefono && validacionCampos.password && validacionCampos.calle && validacionCampos.numero && validacionCampos.esquina && validacionCampos.barrio){
  var datos = new FormData(formulario); 
    let url = 'BACKPHP/registroClienteWeb.php';
    botonId.classList.remove("grupo_input-error-activo");
  fetch(url, {
    method: "POST",
    body: datos,
  
  });
  
  formulario.reset();
  alerta();
}
else {
  botonId.classList.add("grupo_input-error-activo");
}
});
  }
}