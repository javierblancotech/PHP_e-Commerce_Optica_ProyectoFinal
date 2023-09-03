<?php 
/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<h1 class="text-center">Lista de productos</h1>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id</th>
    <th>Tipo</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Modificar</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      $tipo = $datos["data"][$i]["tipo"]-1;
      print "<tr>";
      print "<td>".$datos["data"][$i]["id"]."</td>";
      print "<td class='text-left'>".$datos["tipoProducto"][$tipo]['cadena']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["nombre"]."</td>";
      print "<td class='text-left'>".substr(html_entity_decode($datos["data"][$i]["descripcion"]),0,60);
      if (strlen($datos["data"][$i]["descripcion"])>60) {
        print "...";
      }
      print "</td>";
      //
      print "<td><a href='".RUTA."admonProductos/cambio/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      //
      print "<td><a href='".RUTA."admonProductos/baja/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  
</div><!--card-->
<a href="<?php print RUTA; ?>admonProductos/alta" class="btn btn-success">
  Dar de alta un producto</a>
<?php include_once("piepagina.php"); ?>