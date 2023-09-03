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
      <li class="breadcrumb-item">Forma de pago</li>
      <li class="breadcrumb-item"><a href="#">Verifica datos</a></li>
    </ol>
  </nav>
  <h2>Forma de pago</h2>
  <form action="<?php print RUTA; ?>carrito/verificar" method="POST">
    <div class="radio">
      <label><input type="radio" name="pago" value="tc1">Tarjeta de crédito MasterCard</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="pago" value="tc2">Tarjeta de crédito Visa</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="pago" value="td">Tarjeta de débito</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="pago" value="efectivo">Efectivo</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="pago" value="bitcoins">Bitcoins</label>
    </div>
    <div class="form-group text-left">
      <label for="enviar"></label>
      <input type="submit" name="enviar" value="enviar" class="btn btn-success" role="button"/>
    </div>
  </form>
   </form>
</div>
<?php include_once("piepagina.php"); ?>