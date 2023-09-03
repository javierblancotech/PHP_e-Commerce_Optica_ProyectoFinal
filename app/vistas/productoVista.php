<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); 
print "<h2 class='text-center'>".$datos["subtitulo"]."</h2>";
print "<img src='".RUTA."img/".$datos["data"]["imagen"]."' class='rounded float-right'/>";
//Gafas de Sol
if($datos["data"]["tipo"]==1){
  print "<h4>Descripción:</h4>";
  print "<p>".html_entity_decode($datos["data"]["descripcion"])."</p>";

  print "<h4>Marca:</h4>";
  print "<p>".$datos["data"]["marca"]."</p>";


  print "<h4>Precio (€):</h4>";
  print "<p>".number_format($datos["data"]["precio"],2)."€</p>";


} else if($datos["data"]["tipo"]==2){
  print "<h4>Marca:</h4>";
  print "<p>".$datos["data"]["marca"]."</p>";

  print "<h4>Precio (€):</h4>";
  print "<p>".number_format($datos["data"]["precio"],2)."€</p>";

  print "<h4>Resumen:</h4>";
  print "<p>".html_entity_decode($datos["data"]["descripcion"])."</p>";
}
$regresa = ($datos["regresa"]=="")? "tienda" : $datos["regresa"];
print "<a href='".RUTA.$regresa."' class='btn btn-success'/>Regresa</a>";
print "&nbsp";
print "<a href='".RUTA."carrito/agregaProducto/";
print $datos["data"]["id"]."/"; //id del prodcuto
print $datos["idUsuario"]."' "; //id del usuario
print "class='btn btn-success'/>Agregar al carrito</a>";
include_once("piepagina.php"); ?>