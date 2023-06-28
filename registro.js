var formulario = document.getElementById("formulario");
var respues = document.getElementById("respuesta");

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
var parrafo = document.getElementById("warnings");

formulario.addEventListener("submit", function (e) {
  e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.
 
  var warnings = ""; 
  var confirmarEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var confirmarNombre = /^[a-zA-ZÀ-ÿ\s]{2,40}$/; // Letras y espacios con acentos.
  var confirmarApellido = /^[a-zA-ZÀ-ÿ\s]{2,40}$/; //letras y espacion con acentos
	var confirmarCi =  /^.{8}$/; // 8 digitos
  var confirmarPassword = /^.{6,17}$/; // 6 a 17 digitos.
	var confirmarEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; //valida email
	var confirmarTelefono =  /^.{9}$/; // 9 numeros.
  var confimrarCalle = /^[a-zA-ZÀ-ÿ\s]{2,30}$/; //\d{2}
  var confirmarNumero = /^.{3,4}$/; //numero casa
  var confirmarEsquina = /^[a-zA-ZÀ-ÿ\s]{2,30}$/;
  var confirmarBarrio = /^[a-zA-ZÀ-ÿ\s]{2,30}$/;
  

  var confirmar = false;
 
  if(!confirmarNombre.test(nombre.value)){
    warnings += 'El nombre no es valido <br>';
    confirmar = true;
    nombre.classList.add("error");
  }
  else{
    nombre.classList.remove("error");
  }

  if(!confirmarApellido.test(apellido.value)){
    warnings += 'El apellido no es valido <br>';
    confirmar = true;
    apellido.classList.add("error");
  }
  else {
    apellido.classList.remove("error");  
  }
  // https://github.com/profeluisfagundez/dgetp-utu/blob/main/programacion_web/PHP_basico/estructura_match/index.php
  if(parseInt(ci.value) < 0 || !confirmarCi.test(ci.value)){
    warnings += 'La cedula de identidad no es valida <br>';
    confirmar = true;
    ci.classList.add("error");
  }
  else{
    ci.classList.remove("error");
  }

  if(!confirmarEmail.test(email.value)){
    warnings += 'El email no es valido <br>';
    confirmar = true;
    email.classList.add("error");
  }
  else{
    email.classList.remove("error");
  }

  if(!confirmarPassword.test(password.value)){
    warnings += 'La contrasena es poca segura porfavor ingrese otra con 7 o mas digitos <br>';
    confirmar = true;
    password.classList.add("error");
  }
  else {
    password.classList.remove("error");
  }
  if(parseInt(telefono.value) < 0 || !confirmarTelefono.test(telefono.value)){
    warnings += 'El telefono no es valido <br>';
    confirmar = true;
    telefono.classList.add("error");
  }
  else{
    telefono.classList.remove("error");
  }
  if(!confimrarCalle.test(calle.value)){
    warnings += 'La calle no es valida <br>';
    confirmar = true;
    calle.classList.add("error");
  }
  else{
    calle.classList.remove("error");
  }

  if(parseInt(numero.value) < 0 || !confirmarNumero.test(numero.value)){
    warnings += 'El numero de casa no es valido <br>';
    confirmar = true;
    numero.classList.add("error");
  }
  else{
    numero.classList.remove("error");
  }

  if(!confirmarEsquina.test(esquina.value)){
    warnings += 'La esquina no es valida <br>';
    confirmar = true;
    esquina.classList.add("error");
  }
  else {
    esquina.classList.remove("error");
  }
  if(!confirmarBarrio.test(barrio.value)){
    warnings += 'El barrio no es valido <br>';
    confirmar = true;
    barrio.classList.add("error");
  }
  else {
    barrio.classList.remove("error");
  }
  if (confirmar) {
    parrafo.innerHTML = warnings;
  }
  else {
  var datos = new FormData(formulario); // hay que validar para que el formulario no venga vacio
  fetch("registroClienteWeb.php", {
    method: "POST",
    body: datos,
  
  });
  
  document.getElementById("formulario").reset();
  alerta();
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
    
    <form id="formularioWeb" class="row no-gutters">          

    <div class="col-6">
      <label></label>
       <input type="text" name="nombre" id="nombre" class="form-control " placeholder="Nombre" required>
      </div>
      
      <div class="col-6">
       <label></label>
       <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido"  required> 
      </div>
      
      <div class="col-8">
          <label></label>
          <input type="number" name="ci" id="ci" class="form-control" placeholder="Documento" required>
      
      </div >
      
      <div class="col-7">
          <label></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
      </div>
      
      <div class="col-5">
      
          <label></label>
          <input type="password" name="password" id="pass"  class="form-control" placeholder="Contraseña"      requiered> 
          
      </div>
      
      <div class="col-8">
          <label></label>
          <input type="number" name="telefono" id="telefono" class="form-control"  placeholder="Telefono" required>
      </div>
      
      
      <div class="col-5">
          
          <label></label>
          <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" required>
      
      </div>
      
      
      <div class="col-7">
          <label></label>
                  <input type="number" name="numero" id="numero"  class="form-control" placeholder="Numero" required>
              
      </div>
      
      
      <div class="col-6">
          <label></label>
          <input type="text" name="esquina" id="esquina" class="form-control" placeholder="Esquina" required>
          
      </div>
      
      <div class="col-6">
          <label></label>
                  <input type="text" name="barrio" id="barrio" class="form-control" placeholder="Barrio" required> <br>
      </div>



      <div class="col-12 text-center">
        <button class="btn btn-primary " id="enviar" type="submit" >Enviar</button> 
    </div>




</div>


 </form>
        `;

    var formularioWeb = document.getElementById("formularioWeb");
    formularioWeb.addEventListener("submit", function (e) {
      e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.

      var dataWeb = new FormData(formularioWeb); // hay que validar para que el formulario no venga vacio

      fetch("registroClienteWeb.php", {
        method: "POST",
        body: dataWeb,
      });

      document.getElementById("formularioWeb").reset();
      alerta();
    });
  } else if (tipoUsuario === "empresa") {
    camposExtras.innerHTML = `
       
    <form id="formularioEmpresa" class="row no-gutters ">          

    <div class="col-8">
      <label></label>
       <input type="number" name="rut" id="rut" class="form-control " placeholder="RUT" required>
      </div>
      
      <div class="col-8">
       <label></label>
       <input type="text" name="empresa" id="empresa" class="form-control" placeholder="NombreEmpresa"  required> 
      </div>
      
     

      <div class="col-7">
          <label></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
      </div>
      
      <div class="col-5">
      
          <label></label>
          <input type="password" name="password" id="pass"  class="form-control" placeholder="Contraseña"      requiered> 
          
      </div>
      
      <div class="col-8">
          <label></label>
          <input type="number" name="telefono" id="telefono" class="form-control"  placeholder="Telefono" required>
      </div>
      
      
      <div class="col-7">
          
          <label></label>
          <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" required>
      
      </div>
      
      
      <div class="col-5">
          <label></label>
                  <input type="number" name="numero" id="numero"  class="form-control" placeholder="Numero" required>
              
      </div>
      
      
      <div class="col-6">
          <label></label>
          <input type="text" name="esquina" id="esquina" class="form-control" placeholder="Esquina" required>
          
      </div>
      
      <div class="col-6">
          <label></label>
                  <input type="text" name="barrio" id="barrio" class="form-control" placeholder="Barrio" required> <br>
      </div>



      <div class="col-12 text-center">
        <button class="btn btn-primary " id="enviar" type="submit" >Enviar</button> 
    </div>




</div>

     

 </form>
      
        `;

    var formularioEmpresa = document.getElementById("formularioEmpresa");

    formularioEmpresa.addEventListener("submit", function (e) {
      e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.

      var dataWebEmpresa = new FormData(formularioEmpresa); // hay que validar para que el formulario no venga vacio

      fetch("registroClienteEmpresa.php", {
        method: "POST",
        body: dataWebEmpresa,
      });

      document.getElementById("formularioEmpresa").reset();
      alerta();
    });
  }
}






