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
      <li class="breadcrumb-item">Iniciar sesión</li>
      <li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
      <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
      <li class="breadcrumb-item"><a href="#">Verifica datos</a></li>
    </ol>
  </nav>
  <h2>Checkout | Iniciar sesión</h2>
  <form class="text-left">
    <div class="form-group">
      <label for="correo">* Correo electrónico</label>
      <input type="email" name="correo" class="form-control" required placeholder="Escribe tu correo electrónico">
    </div>
    <div class="form-group">
      <label for="clave">* Clave de acceso</label>
      <input type="password" name="clave" class="form-control" required placeholder="Escribe tu clave de acceso">
    </div>
    <div class="form-group">
      <a href="<?php print RUTA; ?>carrito/direccion" class="btn btn-success">Enviar</a>
    </div>
  </form>
</div>
<?php include_once("piepagina.php"); ?>