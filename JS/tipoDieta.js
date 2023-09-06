function filtrarDieta(str) {
  var select = document.getElementById('tipo_dieta');  
  var selectedValue = select.value;
  if (selectedValue === 'todos') {
    // Si se selecciona "Mostrar Todo", recarga la página
    location.reload();
  }
    if (str == "") {
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("listaMenus").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","../JS/getmenu.php?q="+str,true);
      xmlhttp.send();
    }
  }