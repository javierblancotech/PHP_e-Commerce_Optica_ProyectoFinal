<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
        <h1 class="text-center">Cambia tu clave de acceso</h1>
        <div class="card p-4 bg-light">
  <form action="<?php print RUTA; ?>login/cambiaclave/" method="POST">
    <div class="form-group text-left">
      <label for="clave1">Clave acceso:</label>
      <input type="password" name="clave1" class="form-control">
    </div>

    <div class="form-group text-left">
      <label for="clave2">Repite la clave acceso:</label>
      <input type="password" name="clave2" class="form-control">
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" value="<?php print $datos['data']; ?>"/>
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA.'login/'; ?>" class='btn btn-info'">Regresar</a>
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>