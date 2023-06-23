var formulario = document.getElementById("loginForm");

formulario.addEventListener('submit', function(e){
    e.preventDefault();

    let datos = new FormData(formulario);

    fetch('loginphp.php', {
        method: 'POST',
        body: datos
    })
    .then(function(res){
        return res.json();
    })
    .then(function(data){
        alert(data);
    })
    .catch(function(error){
        console.error('Error al enviar el resultado al servidor:', error);
    });
});