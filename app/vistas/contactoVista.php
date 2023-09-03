<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); 
print "<h2 class='text-center'>Contacto</h2>";
?>
<div class="card p-4 bg-light">
<form action="<?php print RUTA.'contacto/enviar/'; ?>" method="POST">
  <div class="form-group text-left">
    <label for="nombre">* Nombre:</label>
    <input type="text" name="nombre" id="name" class="form-control" required placeholder="Escriba su nombre"/>
  </div>

  <div class="form-group text-left">
    <label for="correo">* Correo electrónico:</label>
    <input type="email" name="correo" id="correo" class="form-control" required placeholder="Escriba su correo electrónico"/>
  </div>

  <div class="form-group text-left">
    <label for="observacion">* Observación:</label>
    <textarea class="form-control" name="observacion" id="observacion"></textarea>
  </div>

  <div class="form-group text-left">
    <input type='submit' value='Enviar' class='btn btn-info'/>
    <a href='<?php print RUTA; ?>tienda' class='btn btn-info'>Regresar</a>
  </div>
</form>
</div>
<?php
include_once("piepagina.php"); 
?>