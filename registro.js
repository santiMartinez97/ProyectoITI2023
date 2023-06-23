var formulario = document.getElementById("formulario");
var respues = document.getElementById("respuesta");


formulario.addEventListener("submit", function (e) {
  e.preventDefault(); // Evitar que se ejecute lo que viene por defecto en el navegador.

  var datos = new FormData(formulario); // hay que validar para que el formulario no venga vacio


  fetch("registroClienteWeb.php", {
    method: "POST",
    body: datos,
  });

  document.getElementById("formulario").reset();
  alerta();
  
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
