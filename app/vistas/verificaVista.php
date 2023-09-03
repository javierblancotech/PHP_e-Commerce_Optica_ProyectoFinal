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
  <h2>Verifique los datos antes de continuar</h2>
<?php
  //
  //Variables de trabajo
  //
  $verifica = false;
  $subtotal = 0;
  $envio = 0;
  $descuento = 0;
  //
  print "Modo de pago: ".$datos["pago"]."<br>";
  print "Nombre: ".$datos["data"]["nombre"]." ".$datos["data"]["apellidoPaterno"]." ".$datos["data"]["apellidoMaterno"]."<br>";
  print "Direccion:"." ".$datos["data"]["direccion"]."<br>";
  print "Comunidad Autónoma: ".$datos["data"]["comunidadautonoma"]."<br>";
  print "Estado: ".$datos["data"]["estado"]."<br>";
  print "Ciudad: ".$datos["data"]["ciudad"]."<br>";
  print "País: ".$datos["data"]["pais"]."<br>";
  print "Código postal: ".$datos["data"]["codpos"]."<br>";
  //
  //desplegar el carrito
  //
  print "<table class='table table-strped' width='100%'>";
  print "<tr>";
  print "<th width='12%'>Producto</th>";
  print "<th width='58%'>Descripción</th>";
  print "<th width='1.8%'>Cant.</th>";
  print "<th width='10.12%'>Precio</th>";
  print "<th width='10.12%'>Subtotal</th>";
  print "<th width='1%'>&nbsp;</th>";
  print "</tr>";
  //ciclo
  for ($i=0; $i < count($datos["carrito"]); $i++) { 
    //Variables de trabajo
    $desc = "<b>".$datos["carrito"][$i]["nombre"]."</b>";
    $desc.= substr(html_entity_decode($datos["carrito"][$i]["descripcion"]),0,200);
    $nom = $datos["carrito"][$i]["nombre"];
    $num = $datos["carrito"][$i]["producto"];
    $can = $datos["carrito"][$i]["cantidad"];
    $pre = $datos["carrito"][$i]["precio"];
    $img = $datos["carrito"][$i]["imagen"];
    $des = $datos["carrito"][$i]["descuento"];
    $env = $datos["carrito"][$i]["envio"];
    $tot = $can*$pre;
    //
    print "<tr>";
    print "<td><img src='".RUTA."img/".$img."' width='105' alt'".$nom."'></td>";
    print "<td>".$desc."..</td>";
    print "<td class='text-right'>";
    print number_format($can,0);
    print "</td>";
    print "<td class='text-right'>".number_format($pre,2)."€</td>";
    print "<td class='text-right'>".number_format($tot,2)."€</td>";
    print "<td>&nbsp;</td>";
    print "</tr>";
    //
    //Subtotales
    //
    $subtotal += $tot;
    $descuento += $des;
    $envio += $env;
  }
  $total = $subtotal + $envio - $descuento;
  print "</table>";
  print "<hr>";
  //
  //Tabla de totales
  //
  print "<table width='100%' class='text-right'>";
  print "<tr>";
  print "<td width='79.85%'></td>";
  print "<td width='11.55%'>Subtotal:</td>";
  print "<td width='9.20%'>".number_format($subtotal,2)."€</td>";
  print "</tr>";

  print "<tr>";
  print "<td width='79.85%'></td>";
  print "<td width='11.55%'>Descuento:</td>";
  print "<td width='9.20%'>".number_format($descuento,2)."€</td>";
  print "</tr>";

  print "<tr>";
  print "<td width='79.85%'></td>";
  print "<td width='11.55%'>Envío:</td>";
  print "<td width='9.20%'>".number_format($envio,2)."€</td>";
  print "</tr>";

  print "<tr>";
  print "<td width='79.85%'></td>";
  print "<td width='11.55%'>Total:</td>";
  print "<td width='9.20%'>".number_format($total,2)."€</td>";
  print "</tr>";

  print "<tr>";
  print "<td></td>";
  print "<td></td>";
  print "<td><a href='".RUTA."carrito/gracias' class='btn btn-success' role='button'>Pagar</a></td>";
  print "</tr>";
  print "</table>";

?>
</div>
<?php include_once("piepagina.php"); ?>