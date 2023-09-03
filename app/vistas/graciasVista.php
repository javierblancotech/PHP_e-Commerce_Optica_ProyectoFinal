<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<div class="card" id="contenedor">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
      <li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
      <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
      <li class="breadcrumb-item">Verifica datos</li>
    </ol>
  </nav>
  <h2><?php print $datos["data"]["nombre"]; ?>:</h2>
  <h3>¡Gracias por confiar en Óptica Madriz! Esperamos volver a verle pronto. ¡Hasta la próxima!</h3>
  <br>
  <h3>Atentamente:</h3>
  <br>
  <h3>Óptica Madriz</h3>
  <br>
  <div class="form-group text-left">
    <label for="enviar"></label>
    <a href="<?php print RUTA; ?>tienda" class="btn btn-success" role="button">Regresar a la tienda</a>
  </div>
</div>
<?php include_once("piepagina.php"); ?>