<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script src="<?php print RUTA; ?>js/admonProductosAltaVista.js"></script>
<h1 class="text-center">
  <?php
  if (isset($datos["subtitulo"])) {
    print $datos["subtitulo"];
  }
  ?>
</h1>
<div class="card p-4 bg-light">
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>admonProductos/alta/" method="POST">
    <div class="form-group text-left">
      <label for="usuario">* Tipo de producto:</label>
      <select class="form-control" name="tipo" id="tipo"
      <?php
      if (isset($datos["baja"])) {
        print "disabled ";
      }
      ?>
      >
        <option value="void">Selecciona el tipo de producto</option>
        <?php
          for ($i=0; $i < count($datos["tipoProducto"]); $i++) { 
            print "<option value='".$datos["tipoProducto"][$i]["indice"]."'";
            if(isset($datos["data"]["tipo"])){
              if($datos["data"]["tipo"]==$datos["tipoProducto"][$i]["indice"]){
                print " selected ";
              }
            }
            print ">".$datos["tipoProducto"][$i]["cadena"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="nombre">* Nombre del producto:</label>
      <input type="text" name="nombre" class="form-control" required
      placeholder="Escribe el nombre del producto."
      value="<?php 
      print isset($datos['data']['nombre'])?$datos['data']['nombre']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print "disabled ";
      }
      ?>
      >
    </div>
    <div class="form-group text-left">
      <label for="content">* Descripción:</label>
      <textarea name="content" id="editor" rows="10"
      <?php
        if (isset($datos["baja"])) {
          print " disabled ";
        }
      ?>
      >
      <?php
        if(isset($datos['data']['descripcion'])){
          print $datos['data']['descripcion']; 
        }
      ?>
      </textarea>
    </div>

    <div id="lentillas">
     

    </div>

    <div id="gafasdesol">
    <div class="form-group text-left">
      <label for="marca">* Marca:</label>
      <input type="text" name="marca" class="form-control" 
      placeholder="Escribe la marca de gafa de sol que quieres"
      value="<?php 
      print isset($datos['data']['marca'])?$datos['data']['marca']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

      
      

    </div>

    <div class="form-group text-left">
      <label for="precio">* Precio del producto:</label>
      <input type="text" name="precio" class="form-control" 
      pattern="^(\d|-)?(\d|,)*\.?\d*$" 
      placeholder="Escribe el precio del producto sin comas ni símbolos." required
      value="<?php 
      print isset($datos['data']['precio'])?$datos['data']['precio']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="descuento">Descuento del producto:</label>
      <input type="text" name="descuento" class="form-control" 
      pattern="^(\d|-)?(\d|,)*\.?\d*$" 
      placeholder="Escribe el descuento del producto sin comas ni símbolos." 
      value="<?php 
      print isset($datos['data']['descuento'])?$datos['data']['descuento']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="envio">Costo del envío del producto:</label>
      <input type="text" name="envio" class="form-control" 
      pattern="^(\d|-)?(\d|,)*\.?\d*$" 
      placeholder="Escribe el costo del envio del producto sin comas ni símbolos." 
      value="<?php 
      print isset($datos['data']['envio'])?$datos['data']['envio']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="imagen">* Imagen del producto:</label>
      <input type="file" name="imagen" id="imagen" accept="image/jpeg"/
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <?php
      if (isset($datos['data']['imagen'])) {
        print "<p>".$datos['data']['imagen']."</p>";
      }
      ?>
    </div>

    <div class="form-group text-left">
      <label for="fecha">* Fecha del producto:</label>
      <input type="date" name="fecha" class="form-control"
      placeholder="Fecha de creación o control del producto (DD/MM/AAAA)." 
      value="<?php 
      print isset($datos['data']['fecha'])?$datos['data']['fecha']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="relacion1">Producto relacionado:</label>
      <select class="form-control" name="relacion1" id="relacion1"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
        <option value="void">Selecciona el producto relacionado</option>
        <?php
        for ($i=0; $i < count($datos["catalogo"]); $i++) { 
            print "<option value='".$datos["catalogo"][$i]["id"]."'";
            if(isset($datos["data"]["relacion1"])){
              if($datos["data"]["relacion1"]==$datos["catalogo"][$i]["id"]){
                print " selected ";
              }
            }
            print ">".$datos["catalogo"][$i]["nombre"]."</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="relacion2">Producto relacionado:</label>
      <select class="form-control" name="relacion2" id="relacion2"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
        <option value="void">Selecciona el producto relacionado</option>
        <?php
        for ($i=0; $i < count($datos["catalogo"]); $i++) { 
            print "<option value='".$datos["catalogo"][$i]["id"]."'";
            if(isset($datos["data"]["relacion2"])){
              if($datos["data"]["relacion2"]==$datos["catalogo"][$i]["id"]){
                print " selected ";
              }
            }
            print ">".$datos["catalogo"][$i]["nombre"]."</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="relacion3">Producto relacionado:</label>
      <select class="form-control" name="relacion3" id="relacion3"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
        <option value="void">Selecciona el producto relacionado</option>
        <?php
        for ($i=0; $i < count($datos["catalogo"]); $i++) { 
            print "<option value='".$datos["catalogo"][$i]["id"]."'";
            if(isset($datos["data"]["relacion2"])){
              if($datos["data"]["relacion2"]==$datos["catalogo"][$i]["id"]){
                print " selected ";
              }
            }
            print ">".$datos["catalogo"][$i]["nombre"]."</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="status">Estatus del producto:</label>
      <select class="form-control" name="status" id="status" 
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
        <option value="void">Selecciona el status del producto</option>
        <?php
          for ($i=0; $i < count($datos["statusProducto"]); $i++) { 
            print "<option value='".$datos["statusProducto"][$i]["indice"]."'";
            if(isset($datos["data"]["status"])){
              if($datos["data"]["status"]==$datos["statusProducto"][$i]["indice"]){
                print " selected ";
              }
            }
            print ">".$datos["statusProducto"][$i]["cadena"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-check text-left">
      <input type="checkbox" name="masvendido" id="masvendido" class="form-check-input" 
      <?php 
      if(isset($datos['data']['masvendido'])){
        if($datos['data']['masvendido']=="1") print " checked ";
      }
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <label for="masvendido" class="form-check-label">Producto más vendido</label>
    </div>

    <div class="form-check text-left">
      <input type="checkbox" name="nuevo" id="nuevo" class="form-check-input"
      <?php 
      if(isset($datos['data']['nuevos'])){
        if($datos['data']['nuevos']=="1") print " checked ";
      }
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      ><label for="nuevo" class="form-check-label">Producto  nuevo</label>
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="
      <?php
        if (isset($datos['data']['id'])) {
          print $datos['data']['id'];
        } else {
          print "";
        }
      ?>
      ">
      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>admonProductos/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>admonProductos" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>admonProductos" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>