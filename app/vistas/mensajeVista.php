<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); 
print "<h2 class='text-center'>".$datos["subtitulo"]."</h2>";
print "<div class='alert ".$datos["color"]." mt-3'>";
print "<h4>".$datos["texto"]."</h4>";
print "</div>";
print "<a href='".RUTA.$datos["url"]."' class='btn ".$datos["colorBoton"]."'/>";
print $datos["textoBoton"]."</a>";
include_once("piepagina.php"); ?>