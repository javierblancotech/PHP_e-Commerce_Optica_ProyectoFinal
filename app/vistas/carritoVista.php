<?php 

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php");
//
//Variables de trabajo
//
$verifica = false;
$subtotal = 0;
$envio = 0;
$descuento = 0;
$idUsuario = $datos["idUsuario"];
//
print "<h2 class='text-center'>Carrito de compras</h2>";
print "<form action='".RUTA."carrito/actualiza' method='POST'>";
print "<table class='table table-strped' width='100%'>";
print "<tr>";
print "<th width='12%'>Producto</th>";
print "<th width='58%'>Descripción</th>";
print "<th width='1.8%'>Cant.</th>";
print "<th width='10.12%'>Precio</th>";
print "<th width='10.12%'>Subtotal</th>";
print "<th width='1%'>&nbsp;</th>";
print "<th width='6.5%'>Borrar</th>";
print "</tr>";
//ciclo
for ($i=0; $i < count($datos["data"]); $i++) { 
  //Variables de trabajo
  $desc = "<b>".$datos["data"][$i]["nombre"]."</b>";
  $desc.= substr(html_entity_decode($datos["data"][$i]["descripcion"]),0,200);
  $nom = $datos["data"][$i]["nombre"];
  $num = $datos["data"][$i]["producto"];
  $can = $datos["data"][$i]["cantidad"];
  $pre = $datos["data"][$i]["precio"];
  $img = $datos["data"][$i]["imagen"];
  $des = $datos["data"][$i]["descuento"];
  $env = $datos["data"][$i]["envio"];
  $tot = $can*$pre;
  //
  print "<tr>";
  print "<td><img src='".RUTA."img/".$img."' width='105' alt'".$nom."'></td>";
  print "<td>".$desc."..</td>";
  print "<td class='text-right'>";
  print "<input type='number' name='c".$i."' class='text-right' ";
  print "value='".number_format($can,0)."' min='1' max='99'/>";
  print "<input type='hidden' name='i".$i."' value='".$num."'/>";
  print "</td>";
  print "<td class='text-right'>".number_format($pre,2)."€</td>";
  print "<td class='text-right'>".number_format($tot,2)."€</td>";
  print "<td>&nbsp;</td>";
  print "<td class='text-right'><a href='".RUTA."carrito/borrar/";
  print $num."/".$idUsuario."' class='btn btn-danger'>Borrar</a>";
  print "</tr>";
  //
  //Subtotales
  //
  $subtotal += $tot;
  $descuento += $des;
  $envio += $env;
}
$total = $subtotal + $envio - $descuento;
print "<input type='hidden' name='num' value='".$i."'/>";
print "<input type='hidden' name='idUsuario' value='".$datos["idUsuario"]."'/>";
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
print "<td><a href='".RUTA."tienda' class='btn btn-info' role='button'>Seguir comprando</a></td>";
print "<td><input type='submit' class='btn btn-info' role='button' value='Recalcular'/></td>";
if($verifica){
  print "<td><a href='".RUTA."carrito/gracias' class='btn btn-success' role='button'>Pagar</a></td>";
} else {
  print "<td><a href='".RUTA."carrito/checkout' class='btn btn-success' role='button'>Pagar</a></td>";
}
print "</tr>";
print "</table>";
print "</form>";
include_once("piepagina.php"); ?>