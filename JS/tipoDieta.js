function filtrarDieta(str) {
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