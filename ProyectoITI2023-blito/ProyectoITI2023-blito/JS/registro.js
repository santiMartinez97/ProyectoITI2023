//formulario
var formulario = document.getElementById("formulario");
var respues = document.getElementById("respuesta");

//datos ingresados del html cliente web
const inputs = document.querySelectorAll('#formulario input');

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

    <article class="col-6">
      <label></label>
       <input type="text" name="nombre" id="nombre" class="form-control " placeholder="Nombre" required>
      <article>
      <p id="warnings" class="warnings"></p>
    </article>  
    </article>
      
      
      <article class="col-6">
       <label></label>
       <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido"  required> 
       <article>
        <p id="warningsApellido" class="warnings"></p>
      </article> 
      </article>
      
      <article class="col-8">
          <label></label>
          <input type="number" name="ci" id="ci" class="form-control" placeholder="Documento" required>
          <article>
            <p id="warningsCi" class="warnings"></p>
          </article> 
      </article >
      
      <article class="col-7">
          <label></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
          <article>
            <p id="warningsEmail" class="warnings"></p>
          </article> 
      </article>
      
      <article class="col-5">
      
          <label></label>
          <input type="password" name="password" id="pass"  class="form-control" placeholder="Contraseña"      requiered> 
          <article>
            <p id="warningsPassword" class="warnings"></p>
          </article> 
      </article>
      
      <article class="col-8">
          <label></label>
          <input type="number" name="telefono" id="telefono" class="form-control"  placeholder="Telefono" required>
          <article>
            <p id="warningsTelefono" class="warnings"></p>
          </article> 
      </article>
      
      
      <article class="col-7">
          
          <label></label>
          <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" required>
          <article>
            <p id="warningsCalle" class="warnings"></p>
          </article> 
      </article>
      
      
      <article class="col-5">
          <label></label>
          <input type="number" name="numero" id="numero"  class="form-control" placeholder="Numero" required>
          <article>
            <p id="warningsNumero" class="warnings"></p>
          </article> 
      </article>
      
      
      <article class="col-6">
          <label></label>
          <input type="text" name="esquina" id="esquina" class="form-control" placeholder="Esquina" required>
          <article>
            <p id="warningsEsquina" class="warnings"></p>
          </article>        
      </article>
      
      <article class="col-6">
          <label></label>
          <input type="text" name="barrio" id="barrio" class="form-control" placeholder="Barrio" required> <br>
          <article>
            <p id="warningsBarrio" class="warnings"></p>
          </article> 
      </article>

      <article class="col-12 text-center">
        <button class="btn btn-primary " id="enviar"  type="submit" >Enviar</button> 
      </article>

</article>
     
 </form>
        `;

    var nombre = document.getElementById("nombre");
    var apellido = document.getElementById("apellido");
    var ci = document.getElementById("ci");
    var email = document.getElementById("email");
    var password = document.getElementById("pass");
    var telefono = document.getElementById("telefono");
    var calle = document.getElementById("calle");
    var numero = document.getElementById("numero");
    var esquina = document.getElementById("esquina");
    var barrio = document.getElementById("barrio");
        
      //span de los warnings
    var parrafo = document.getElementById("warnings");
    var parrafoApellido = document.getElementById("warningsApellido");
    var parrafoCi = document.getElementById("warningsCi");
    var parrafoEmail = document.getElementById("warningsEmail");
    var parrafoPassword = document.getElementById("warningsPassword");    
    var parrafoTelefono = document.getElementById("warningsTelefono");
    var parrafoCalle = document.getElementById("warningsCalle");
    var parrafoNumero = document.getElementById("warningsNumero");
    var parrafoEsquina = document.getElementById("warningsEsquina");
    var parrafoBarrio = document.getElementById("warningsBarrio");
        
    var formularioWeb = document.getElementById("formularioWeb");
   
  formularioWeb.addEventListener("submit", function (e) {
  e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.

      //warnings 
  var warnings = "";
  var warningsApellido = "";
  var warningsCi = "";
  var warningsEmail = "";
  var warningsPassword = "";
  var warningsTelefono = "";
  var warningsCalle = ""; 
  var warningsNumero = "";
  var warningsEsquina = "";
  var warningsBarrio = "";
//expresiones regulares  
  var confirmarEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var confirmarNombre = /^[a-zA-ZÀ-ÿ\s]{2,40}$/; // Letras y espacios con acentos.
  var confirmarApellido = /^[a-zA-ZÀ-ÿ\s]{2,40}$/; //letras y espacion con acentos
	var confirmarCi =  /^.{8}$/; // 8 digitos
  var confirmarPassword = /^.{6,17}$/; // 6 a 17 digitos.
	var confirmarEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; //valida email
	var confirmarTelefono = /^09\d{7}$/; // 9 numeros.
  var confimrarCalle = /^[a-zA-ZÀ-ÿ\s]{2,30}$/; //\d{2}
  var confirmarNumero = /^.{3,4}$/; //numero casa
  var confirmarEsquina = /^[a-zA-ZÀ-ÿ\s]{2,30}$/;
  var confirmarBarrio = /^[a-zA-ZÀ-ÿ\s]{2,30}$/;
  

  var confirmar = false;
//validacion de datos web 
  if(!confirmarNombre.test(nombre.value)){
    warnings += 'El nombre no es valido';
    confirmar = true;
    nombre.classList.add("error");
  }
  else{
    nombre.classList.remove("error");
  }

  if(!confirmarApellido.test(apellido.value)){
    warningsApellido += 'El apellido no es valido <br>';
    confirmar = true;
    apellido.classList.add("error");
  }
  else {
    apellido.classList.remove("error");  
  }
  // https://github.com/profeluisfagundez/dgetp-utu/blob/main/programacion_web/PHP_basico/estructura_match/index.php
  if(parseInt(ci.value) < 0 || !confirmarCi.test(ci.value)){
    warningsCi += 'La cedula de identidad no es valida <br>';
    confirmar = true;
    ci.classList.add("error");
  }
  else{
    ci.classList.remove("error");
  }

  if(!confirmarEmail.test(email.value)){
    warningsEmail += 'El email no es valido <br>';
    confirmar = true;
    email.classList.add("error");
  }
  else{
    email.classList.remove("error");
  }

  if(!confirmarPassword.test(password.value)){
    warningsPassword += 'La contrasena es poca segura <br>';
    confirmar = true;
    password.classList.add("error");
  }
  else {
    password.classList.remove("error");
  }
  if(parseInt(telefono.value) < 0 || !confirmarTelefono.test(telefono.value)){
    warningsTelefono += 'El telefono no es valido <br>';
    confirmar = true;
    telefono.classList.add("error");
  }
  else{
    telefono.classList.remove("error");
  }
  if(!confimrarCalle.test(calle.value)){
    warningsCalle += 'La calle no es valida <br>';
    confirmar = true;
    calle.classList.add("error");
  }
  else{
    calle.classList.remove("error");
  }

  if(parseInt(numero.value) < 0 || !confirmarNumero.test(numero.value)){
    warningsNumero += 'El numero de casa no es valido <br>';
    confirmar = true;
    numero.classList.add("error");
  }
  else{
    numero.classList.remove("error");
  }

  if(!confirmarEsquina.test(esquina.value)){
    warningsEsquina += 'La esquina no es valida';
    confirmar = true;
    esquina.classList.add("error");
  }
  else {
    esquina.classList.remove("error");
  }
  if(!confirmarBarrio.test(barrio.value)){
    warningsBarrio += 'El barrio no es valido ';
    confirmar = true;
    barrio.classList.add("error");
  }
  else {
    barrio.classList.remove("error");
  }
  if (confirmar) {
    parrafo.innerHTML = warnings;
    parrafoApellido.innerHTML = warningsApellido;
    parrafoCi.innerHTML = warningsCi;
    parrafoEmail.innerHTML = warningsEmail;
    parrafoPassword.innerHTML = warningsPassword;
    parrafoTelefono.innerHTML = warningsTelefono;
    parrafoCalle.innerHTML = warningsCalle;
    parrafoNumero.innerHTML = warningsNumero;
    parrafoEsquina.innerHTML = warningsEsquina;
    parrafoBarrio.innerHTML = warningsBarrio;
  }
  else {
      var dataWeb = new FormData(formularioWeb); // hay que validar para que el formulario no venga vacio
      let url = 'BACKPHP/registroClienteWeb.php';
      fetch(url, {
        method: "POST",
        body: dataWeb,
      });

      document.getElementById("formularioWeb").reset();
      alerta();
  }
});
  } else if (tipoUsuario === "empresa") {
    camposExtras.innerHTML = `
       
    <form id="formularioEmpresa" class="row no-gutters ">          

    <article class="col-8">
      <label></label>
       <input type="number" name="rut" id="rut" class="form-control " placeholder="RUT" required>
       <article>
          <p id="warnings" class="warnings"></p>
       </article> 
       </article>
      
      <article class="col-8">
       <label></label>
       <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Nombre Empresa"  required> 
       <article>
          <p id="warningsEmpresa" class="warnings"></p>
       </article>
       </article>
         
      <article class="col-7">
          <label></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
          <article>
          <p id="warningsEmail" class="warnings"></p>
      </article>
      </article>
      
      <article class="col-5">
          <label></label>
          <input type="password" name="password" id="pass"  class="form-control" placeholder="Contraseña"      requiered> 
          <article>
          <p id="warningsPassword" class="warnings"></p>
       </article>
      </article>
      
      <article class="col-8">
          <label></label>
          <input type="number" name="telefono" id="telefono" class="form-control"  placeholder="Telefono" required>
          <article>
          <p id="warningsTelefono" class="warnings"></p>
      </article>      
      </article>
      
      
      <article class="col-7">
 
          <label></label>
          <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" required>
          <article>
          <p id="warningsCalle" class="warnings"></p>
       </article>
      </article>
      
      
      <article class="col-5">
          <label></label>
                  <input type="number" name="numero" id="numero"  class="form-control" placeholder="Numero" required>
                  <article>
                  <p id="warningsNumero" class="warnings"></p>
               </article>
      </article>
      
      
      <article class="col-6">
          <label></label>
          <input type="text" name="esquina" id="esquina" class="form-control" placeholder="Esquina" required>
          <article>
          <p id="warningsEsquina" class="warnings"></p>
       </article>
      </article>
      
      <article class="col-6">
          <label></label>
          <input type="text" name="barrio" id="barrio" class="form-control" placeholder="Barrio" required> <br>
          <article>
          <p id="warningsBarrio" class="warnings"></p>
        </article>
      </article>



      <article class="col-12 text-center">
        <button class="btn btn-primary " id="enviar" type="submit" >Enviar</button> 
    </article>

</article>

 </form>
      
        `;
        var rut = document.getElementById("rut");
        var empresa = document.getElementById("empresa");
        var email = document.getElementById("email");
        var password = document.getElementById("pass");
        var telefono = document.getElementById("telefono");
        var calle = document.getElementById("calle");
        var numero = document.getElementById("numero");
        var esquina = document.getElementById("esquina");
        var barrio = document.getElementById("barrio");
        
        //article de los warnings
        var parrafo = document.getElementById("warnings");
        var parrafoEmpresa = document.getElementById("warningsEmpresa");
        var parrafoEmail = document.getElementById("warningsEmail");
        var parrafoPassword = document.getElementById("warningsPassword");
        var parrafoTelefono = document.getElementById("warningsTelefono");
        var parrafoCalle = document.getElementById("warningsCalle");
        var parrafoNumero = document.getElementById("warningsNumero");
        var parrafoEsquina = document.getElementById("warningsEsquina");
        var parrafoBarrio = document.getElementById("warningsBarrio");
        
        var formularioEmpresa = document.getElementById("formularioEmpresa");
    formularioEmpresa.addEventListener("submit", function (e) {
    e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.

      //warnings 
    var warnings = "";
    var warningsEmpresa = "";
    var warningsEmail = "";
    var warningsPassword = "";
    var warningsTelefono = "";
    var warningsCalle = ""; 
    var warningsNumero = "";
    var warningsEsquina = "";
    var warningsBarrio = "";
//expresiones regulares

    var confirmarEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var confirmarEmpresa= /^[a-zA-ZÀ-ÿ\s]{2,40}$/; // Letras y espacios con acentos.
    var confirmarRut =  /^.{12}$/; // 8 digitos
    var confirmarPassword = /^.{6,17}$/; // 6 a 17 digitos.
    var confirmarEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; //valida email
    var confirmarTelefono = /^09\d{7}$/; // 9 numeros.
    var confimrarCalle = /^[a-zA-ZÀ-ÿ\s]{2,30}$/; //\d{2}
    var confirmarNumero = /^.{3,4}$/; //numero casa
    var confirmarEsquina = /^[a-zA-ZÀ-ÿ\s]{2,30}$/;
    var confirmarBarrio = /^[a-zA-ZÀ-ÿ\s]{2,30}$/;

    var confirmar = false;
//validacion de datos Empresa

  if(!confirmarEmpresa.test(empresa.value)){
    warningsEmpresa += 'El nombre no es valido';
    confirmar = true;
    empresa.classList.add("error");
  }
  else{
    empresa.classList.remove("error");
  }
// https://github.com/profeluisfagundez/dgetp-utu/blob/main/programacion_web/PHP_basico/estructura_match/index.php
  if(parseInt(rut.value) < 0 || !confirmarRut.test(rut.value)){
    warnings += 'El rut no es valido';
    confirmar = true;
    rut.classList.add("error");
  }
  else{
    rut.classList.remove("error");
  }

  if(!confirmarEmail.test(email.value)){
    warningsEmail += 'El email no es valido <br>';
    confirmar = true;
    email.classList.add("error");
  }
  else{
    email.classList.remove("error");
  }

  if(!confirmarPassword.test(password.value)){
    warningsPassword += 'La contrasena es poca segura <br>';
    confirmar = true;
    password.classList.add("error");
  }
  else {
    password.classList.remove("error");
  }

  if(parseInt(telefono.value) < 0 || !confirmarTelefono.test(telefono.value)){
    warningsTelefono += 'El telefono no es valido <br>';
    confirmar = true;
    telefono.classList.add("error");
  }
  else{
    telefono.classList.remove("error");
  }

  if(!confimrarCalle.test(calle.value)){
    warningsCalle += 'La calle no es valida <br>';
    confirmar = true;
    calle.classList.add("error");
  }
  else{
    calle.classList.remove("error");
  }

  if(parseInt(numero.value) < 0 || !confirmarNumero.test(numero.value)){
    warningsNumero += 'El numero de casa no es valido <br>';
    confirmar = true;
    numero.classList.add("error");
  }
  else{
    numero.classList.remove("error");
  }

  if(!confirmarEsquina.test(esquina.value)){
    warningsEsquina += 'La esquina no es valida';
    confirmar = true;
    esquina.classList.add("error");
  }
  else {
    esquina.classList.remove("error");
  }

  if(!confirmarBarrio.test(barrio.value)){
    warningsBarrio += 'El barrio no es valido ';
    confirmar = true;
    barrio.classList.add("error");
  }
  else {
    barrio.classList.remove("error");
  }

  if (confirmar) {
    parrafo.innerHTML = warnings;
    parrafoEmpresa.innerHTML = warningsEmpresa;
    parrafoEmail.innerHTML = warningsEmail;
    parrafoPassword.innerHTML = warningsPassword;
    parrafoTelefono.innerHTML = warningsTelefono;
    parrafoCalle.innerHTML = warningsCalle;
    parrafoNumero.innerHTML = warningsNumero;
    parrafoEsquina.innerHTML = warningsEsquina;
    parrafoBarrio.innerHTML = warningsBarrio;
  }
  else{
      var dataWebEmpresa = new FormData(formularioEmpresa); // hay que validar para que el formulario no venga vacio
      let url = 'BACKPHP/registroClienteEmpresa.php';
      fetch(url, {
        method: "POST",
        body: dataWebEmpresa,
      });

      document.getElementById("formularioEmpresa").reset();
      alerta();
   }});}
  }

