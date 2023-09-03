<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
<h1 class="text-center">Ventas por dia x usuario</h1>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id</th>
    <th>Fecha</th>
    <th>Costo</th>
    <th>Descuento</th>
    <th>Envío</th>
    <th>Total</th>
    <th>Detalle</th>
  </tr>
  </thead>
  <tbody>
    <?php
    $tot = 0;
    $des = 0;
    $env = 0;
    $cos = 0;
    for($i=0; $i<count($datos['data']); $i++){
      $total = $datos["data"][$i]["costo"] - $datos["data"][$i]["descuento"] + $datos["data"][$i]["envio"];
      print "<tr>";
      print "<td>".$datos["data"][$i]["idUsuario"]."</td>";
      print "<td>".$datos["data"][$i]["fecha"]."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["costo"],2)."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["descuento"],2)."</td>";
      print "<td class='text-right'>".number_format($datos["data"][$i]["envio"],2)."</td>";
      print "<td class='text-right'>".number_format($total,2)."</td>";
 
      print "<td><a href='".RUTA."carrito/detalle/".substr($datos["data"][$i]["fecha"],0,10)."/".$datos["data"][$i]["idUsuario"]."' class='btn btn-info'>Detalle</a></td>";
      print "</tr>";
      $tot+= $total;
      $des+= $datos["data"][$i]["descuento"];
      $env+= $datos["data"][$i]["envio"];
      $cos+= $datos["data"][$i]["costo"];
    }
    print "<tr>";
    print "<td></td>";
    print "<td>Totales:</td>";
    print "<td class='text-right'>".number_format($cos,2)."</td>";
    print "<td class='text-right'>".number_format($des,2)."</td>";
    print "<td class='text-right'>".number_format($env,2)."</td>";
    print "<td class='text-right'>".number_format($tot,2)."</td>";
    print "<td></td>";
    print "</tr>";
    ?>
  </tbody>
  </table>
  
</div><!--card-->

<?php include_once("piepagina.php"); ?>