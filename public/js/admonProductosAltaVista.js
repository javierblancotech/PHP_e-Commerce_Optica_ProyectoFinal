window.onload = function() {
  document.getElementById("lentillas").style.display = "none";
  document.getElementById("gafasdesol").style.display = "none";

  //detectamos el cambio en el select
  document.getElementById("tipo").onchange = function() {
    if (this.value==1) {
      document.getElementById("lentillas").style.display = "none";
      document.getElementById("gafasdesol").style.display = "block";
    } else if(this.value==2) {
      document.getElementById("lentillas").style.display = "block";
      document.getElementById("gafasdesol").style.display = "none";
    } else {
      document.getElementById("lentillas").style.display = "none";
      document.getElementById("gafasdesol").style.display = "none";
    }
  }
}