<?php
session_start();
if(!isset($_SESSION['atencionPublico'])){
    echo '
    <script>
       alert("Por favor, debes iniciar sesión.");
       window.location = "../index.php";
    </script>

    ';
    session_destroy();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Público | NutriBento</title>
    <link rel="icon" href="../img/icono.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
    <link rel="stylesheet" href="../css/atencionalpublico.css">
</head>
<body>
     <!-- Header -->
     <header class="headerPresencial">
        <h1 class="h1tit">Bienvenido Personal</h1>
        <h2 class="h2tit">
        <a class="enlaceTitulo" href="atencionPublico.php">Menú principal</a>
        <a class="enlaceTitulo" href="atencionPublicoClientes.php">Visualizar clientes</a>
        <a class="enlaceTitulo" href="atencionPublicoMenu.php">Consultar menús</a>
        <a class="enlaceTitulo" href="atencionPublicoEstado.php">Visualizar estados</a> 
        <a class="enlaceTitulo" href="cerrar_session.php">Cerrar sesión</a>

        </h2>
    </header>

    <section>
   <article class="padre">
  <article class="hijo">
    <article class="container my-1">
          
      
        <h1 class="tituloPresencial text-center">Formulario de Alta</h1> <br>

    
            <article id="campos">
              
            <form id="formulario" class="row no-gutters ">          

              <!-- SEPARAMOS POR GRUPOS CADA CAMPO -->
              
              <!-- Grupo nombre -->
              <article class="col-6 grupo" id="grupo__nombre">
              
                <article class="grupo__input">  
                 <input type="text" name="nombre" id="nombre" class="formulario__input form-control" placeholder="Nombre">
                </article>       
                 <p class="grupo_input-error">Ingrese un nombre válido </p>
              </article>
                
                 <!-- Grupo apellido -->
                <article class="col-6 grupo" id="grupo__apellido">
               
                 <article class="grupo__input">
                  <input type="text" name="apellido" id="apellido" class="formulario__input form-control" placeholder="Apellido">
                 </article>   
                 <p class="grupo_input-error">Ingrese un apellido válido</p>
                </article> 
                
            
                 <!-- Grupo cedula -->
                <article class="col-8 grupo" id="grupo__ci">
                  
                    <article class="grupo__input">
                    <input type="number" name="ci" id="ci" class="formulario__input form-control" placeholder="Documento">
                    </article>  
                    <p class="grupo_input-error">Ingrese la cédula sin puntos ni guiones</p>
                </article >
                
                 <!-- Grupo telefono -->
                <article class="col-6 grupo" id="grupo__telefono">
                  
                    <article class="grupo__input">
                    <input type="number" name="telefono" id="telefono" class="formulario__input form-control"  placeholder="Teléfono">
                    </article>
                      <p class="grupo_input-error">Ingrese su número de teléfono </p> 
                </article>

                 <!-- Grupo calle -->
                <article class="col-7 grupo" id="grupo__calle">
                  
                    <article class="grupo__input">
                    <input type="text" name="calle" id="calle" class="formulario__input form-control" placeholder="Calle">
                    </article>
                      <p class="grupo_input-error">Ingrese una calle válida</p>
                </article>
                
                 <!-- Grupo numero -->
                <article class="col-5 grupo" id="grupo__numero">
                  
                    <article class="grupo__input">
                    <input type="number" name="numero" id="numero" class="formulario__input form-control" placeholder="Número">
                    </article>
                      <p class="grupo_input-error">N° de puerta invalido</p>
                </article>
                
                 <!-- Grupo esquina -->
                <article class="col-6 grupo" id="grupo__esquina">
                  
                    <article id="grupo__input">
                    <input type="text" name="esquina" id="esquina" class="formulario__input form-control" placeholder="Esquina">
                    </article>
                      <p class="grupo_input-error">Ingrese una esquina válida</p>        
                </article>
                
                 <!-- Grupo barrio -->
                <article class="col-6 grupo" id="grupo__barrio">
                  
                    <article  class="grupo__input">
                      <input type="text" name="barrio" id="barrio" class="formulario__input form-control" placeholder="Barrio"> 
                    </article> 
                      <p class="grupo_input-error">Ingrese un barrio válido</p>
                </article>

                <article class="col-12 text-center" >
                  <button class="btn btn-primary " id="enviar"  type="submit" >Enviar</button> 
                  
                  <p id="botonAlerta" class="grupo_input-error col-11 text-center">Complete correctamente los campos por favor.</p>
                  <p id="errorRepeticion" class="grupo_input-error col-11 text-center"></p>
                </article>       
        </article>
           </form>
    </article>
</article>
    <article class="mt-3 " id="respuesta">  </article>
</article>
</section>

    <footer>
    <section>
      <h3>Atención al Público</h3>
    </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="../JS/jquery-3.6.4.min.js"></script>
    <script src="../JS/altaClientePresencial.js"></script>
</body>
</html>