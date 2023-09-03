<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<div class="card p-3" id="contenedor">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
      <li class="breadcrumb-item">Datos de envío</li>
      <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
      <li class="breadcrumb-item"><a href="#">Verifica datos</a></li>
    </ol>
  </nav>
<h2>Datos de envío</h2>
<p>Favor de verificar los siguientes datos para su envío:</p>
<form action="<?php print RUTA; ?>carrito/formaPago/" method="POST">
    <div class="form-group text-left">
      <label for="nombre">* Nombre:</label>
      <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Escriba su nombre" 
      value='<?php isset($datos["data"]["nombre"])? print $datos["data"]["nombre"]:""; ?>' />
    </div>

    <div class="form-group text-left">
      <label for="apellidoPaterno">* Apellido Paterno:</label>
      <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" required placeholder="Escriba su apellido paterno" value='<?php isset($datos["data"]["apellidoPaterno"])? print $datos["data"]["apellidoPaterno"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="apellidoMaterno">Apellido Materno:</label>
      <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escriba su apellido materno" value='<?php isset($datos["data"]["apellidoMaterno"])? print $datos["data"]["apellidoMaterno"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="email">* Correo electrónico:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Escriba su correo electrónico" value='<?php isset($datos["data"]["email"])? print $datos["data"]["email"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="direccion">* Dirección:</label>
      <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escriba su dirección" required value='<?php isset($datos["data"]["direccion"])? print $datos["data"]["direccion"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="ciudad">* Ciudad:</label>
      <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Escriba su ciudad" required value='<?php isset($datos["data"]["ciudad"])? print $datos["data"]["ciudad"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="estado">* Estado:</label>
      <input type="text" name="estado" id="estado" class="form-control" placeholder="Escriba su estado" required value='<?php isset($datos["data"]["estado"])? print $datos["data"]["estado"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="comunidadautonoma">* Comunidad Autónoma:</label>
      <input type="text" name="comunidadautonoma" id="comunidadautonoma" class="form-control" placeholder="Escriba su Comunidad Autónoma" required value='<?php isset($datos["data"]["comunidadautonoma"])? print $datos["data"]["comunidadautonoma"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="codpos">* Código Postal:</label>
      <input type="text" name="codpos" id="codpos" class="form-control" placeholder="Escriba su código postal" required value='<?php isset($datos["data"]["codpos"])? print $datos["data"]["codpos"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="pais">* País:</label>
      <input type="text" name="pais" id="pais" class="form-control" placeholder="Escriba su país" required value='<?php isset($datos["data"]["pais"])? print $datos["data"]["pais"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="enviar"></label>
      <input type="submit" value="Continuar"  class="btn btn-success" role="button"/>
    </div>
</form>
</div>
<?php include_once("piepagina.php"); ?>