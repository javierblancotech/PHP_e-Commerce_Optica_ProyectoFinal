<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

include_once("encabezado.php"); ?>
        <h1 class="text-center">Artículos más vendidos</h1>
        <div class="card p-4 bg-light">
          <?php
            $ren = 0;
            for ($i=0; $i < count($datos["data"]); $i++) { 
              if ($ren==0) {
                print "<div class='row'>";
              }
              print "<div class='card pt-2 col-sm-3'>";
              print "<img src='img/".$datos['data'][$i]["imagen"]."' ";
              print "class='img-responsive' style='width:100%; height:140px;' ";
              print "alt='".$datos['data'][$i]["nombre"]."'/>";
              print "<p><a href='".RUTA."admonProductos/producto/";
              print $datos['data'][$i]["id"]."'>";
              print $datos['data'][$i]["nombre"]."</a></p>";
              print "</div>";
              $ren++;
              if ($ren==4) {
                $ren = 0;
                print "</div>";
              }
            }
            print "<br>";
            print '<h1 class="text-center">Artículos nuevos</h1>';
            print '<div class="card p-4 bg-light">';
            $ren = 0;
            for ($i=0; $i < count($datos["nuevos"]); $i++) { 
              if ($ren==0) {
                print "<div class='row'>";
              }
              print "<div class='card pt-2 col-sm-3'>";
              print "<img src='img/".$datos['nuevos'][$i]["imagen"]."' ";
              print "class='img-responsive' style='width:100%; height:140px;' ";
              print "alt='".$datos['nuevos'][$i]["nombre"]."'/>";
              print "<p><a href='".RUTA."admonProductos/producto/";
              print $datos['nuevos'][$i]["id"]."'>";
              print $datos['nuevos'][$i]["nombre"]."</a></p>";
              print "</div>";
              $ren++;
              if ($ren==4) {
                $ren = 0;
                print "</div>";
              }
            }
          ?>
        </div><!--card-->
<?php include_once("piepagina.php"); ?>