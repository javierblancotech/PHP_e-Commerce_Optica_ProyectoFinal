<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<h1 class="text-center">Lista de usuarios</h1>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Modifica</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td>".$datos["data"][$i]["id"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["nombre"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["correo"]."</td>";
      print "<td><a href='".RUTA."admonUsuarios/cambio/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."admonUsuarios/baja/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  
</div><!--card-->
<a href="<?php print RUTA; ?>admonUsuarios/alta" class="btn btn-success">
  Dar de alta un usuario</a>
<?php include_once("piepagina.php"); ?>