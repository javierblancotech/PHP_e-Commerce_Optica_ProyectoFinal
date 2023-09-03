<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<h1 class="text-center">Ventas detalle</h1>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>Nombre</th>
    <th>Fecha</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Descuento</th>
    <th>Envío</th>
    <th>Total</th>

  </tr>
  </thead>
  <tbody>
    <?php
    $tot = 0;
    $des = 0;
    $env = 0;
    $cos = 0;
    $can = 0;
    for($i=0; $i<count($datos['data']); $i++){
      $total = ($datos["data"][$i]["precio"]*$datos["data"][$i]["cantidad"]) - $datos["data"][$i]["descuento"] + $datos["data"][$i]["envio"];
      print "<tr>";
      print "<td>".$datos["data"][$i]["nombre"]."</td>";
      print "<td>".$datos["data"][$i]["fecha"]."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["precio"],2)."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["cantidad"],2)."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["descuento"],2)."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["envio"],2)."</td>";
      print "<td class='text-right'>".number_format($total,2)."</td>";
      print "</tr>";
      $tot+= $total;
      $des+= $datos["data"][$i]["descuento"];
      $env+= $datos["data"][$i]["envio"];
      $can+= $datos["data"][$i]["cantidad"];
    }
    print "<tr>";
    print "<td></td>";
    print "<td>Totales:</td>";
    print "<td></td>";
    print "<td class='text-right'>".number_format($can,2)."</td>";
    print "<td class='text-right'>".number_format($des,2)."</td>";
    print "<td class='text-right'>".number_format($env,2)."</td>";
    print "<td class='text-right'>".number_format($tot,2)."</td>";
    print "</tr>";
    ?>
  </tbody>
  </table>
  
</div><!--card-->
<a href="<?php print RUTA; ?>carrito/ventas" class="btn btn-success">
  Regresar</a>
<?php include_once("piepagina.php"); ?>