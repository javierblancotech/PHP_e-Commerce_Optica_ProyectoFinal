<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); 
print "<h2 class='text-center'>Sobre mi</h2>";
print "<div class='alert mt-3'>";
print "<img src='img/logo.png' class='rounded float-right'/>";
print "<p>Bienvenidos a Óptica Madriz. Somos un equipo de profesionales dedicados a cuidar de la salud visual de nuestros pacientes y ayudarles a encontrar las mejores soluciones para sus necesidades visuales.
</p>";
print "<p>En Óptica Madriz, nuestra prioridad es ofrecer un servicio personalizado y de calidad a cada uno de nuestros pacientes. Nuestros especialistas en salud visual tienen años de experiencia y están altamente capacitados para realizar exámenes de la vista completos y precisos, identificar cualquier problema visual y ofrecer las soluciones más adecuadas.</p>";
print "<p>Además, en Óptica Madriz contamos con una amplia selección de lentes, monturas y productos ópticos de las mejores marcas, para que nuestros pacientes puedan encontrar el estilo que mejor se adapte a sus necesidades y gustos. Nos esforzamos por estar a la vanguardia de las últimas tendencias y tecnologías en el mundo de la óptica, para brindar a nuestros pacientes las mejores opciones y garantizar la satisfacción en todo momento.</p>";
print "<p>En resumen, en Óptica Madriz, nos comprometemos a brindar un servicio de excelencia, ofreciendo a nuestros pacientes los mejores productos y soluciones para sus necesidades visuales, con el objetivo de mejorar su calidad de vida y cuidar de su salud visual. Esperamos verte pronto en nuestra óptica.</p>";

print "</div>";
print "<a href='".RUTA."tienda' class='btn btn-success'/>Regresar</a>";
include_once("piepagina.php"); ?>