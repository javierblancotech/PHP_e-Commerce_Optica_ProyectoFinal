<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<h2 class="text-center">Registro</h2>
<form action="<?php print RUTA; ?>login/registro/" method="POST">
    <div class="form-group text-left">
      <label for="nombre">* Nombre:</label>
      <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Escriba su nombre" 
      value='<?php isset($datos["data"]["nombre"])? print $datos["data"]["nombre"]:""; ?>' />
    </div>

    <div class="form-group text-left">
      <label for="apellidoPaterno">* Primer Apellido:</label>
      <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" required placeholder="Escriba su primer apellido" value='<?php isset($datos["data"]["apellidoPaterno"])? print $datos["data"]["apellidoPaterno"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="apellidoMaterno">Segundo Apellido:</label>
      <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escriba su segudo apellido" value='<?php isset($datos["data"]["apellidoMaterno"])? print $datos["data"]["apellidoMaterno"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="email">* Correo electrónico:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Escriba su correo electrónico" value='<?php isset($datos["data"]["email"])? print $datos["data"]["email"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="clave1">* Clave de acceso:</label>
      <input type="password" name="clave1" id="clave1" class="form-control" placeholder="Escriba su clave de acceso" required value='<?php isset($datos["data"]["clave1"])? print $datos["data"]["clave1"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="clave2">* Repetir clave de acceso:</label>
      <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Verifique su clave de acceso" required value='<?php isset($datos["data"]["clave2"])? print $datos["data"]["clave2"]:""; ?>'/>
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
      <label for="estado">* Comunidad Autónoma:</label>
      <input type="text" name="estado" id="estado" class="form-control" placeholder="Escriba su comunidad autónoma" required value='<?php isset($datos["data"]["estado"])? print $datos["data"]["estado"]:""; ?>'/>
    </div>

    <div class="form-group text-left">
      <label for="comunidadautonoma">* Provincia:</label>
      <input type="text" name="comunidadautonoma" id="comunidadautonoma" class="form-control" placeholder="Escriba su provincia" required value='<?php isset($datos["data"]["comunidadautonoma"])? print $datos["data"]["comunidadautonoma"]:""; ?>'/>
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
      <input type="submit" value="Enviar datos"  class="btn btn-success" role="button"/>
      <a href="<?php print RUTA; ?>login/" class="btn btn-info">Regresar</a>
    </div>
</form>
<?php include_once("piepagina.php"); ?>