<!DOCTYPE html>
<html>
<head>
  <title><?php print $datos["titulo"]; ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a href="<?php print RUTA."tienda"; ?>" class="navbar-brand">Tienda</a>
    <div class="collapse navbar-collapse" id="menu">
    <?php if ($datos["menu"]) {
      print "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
      print "<li class='nav-item'>";
      print "<a href='".RUTA."gafasdesol' class='nav-link ";
      if(isset($datos["activo"]) && $datos["activo"]=="gafasdesol") print "active";
      print "'>Gafas de Sol</a>";
      print "</li>";
      //
      print "<li class='nav-item'>";
      print "<a href='".RUTA."lentillas' class='nav-link ";
      if(isset($datos["activo"]) && $datos["activo"]=="lentillas") print "active";
      print "'>Lentillas</a>";
      print "</li>";
      //
      print "<li class='nav-item'>";
      print "<a href='".RUTA."sobremi' class='nav-link ";
      if(isset($datos["activo"]) && $datos["activo"]=="sobremi") print "active";
      print "'>Sobre mi</a>";
      print "</li>";
      //
      print "<li class='nav-item'>";
      
      if(isset($datos["activo"]) && $datos["activo"]=="contacto") print "active";
      print "";
      print "</li>";
      print "</ul>";
      //
      //Formulario lado derecho
      //
      print "<ul class='nav navbar-nav navbar-right'>";
      //
      if (isset($_SESSION["carrito"]) && $_SESSION["carrito"] > 0) {
        print "<li class='nav-item'>";
        print "<a href='".RUTA."carrito/caratula' class='nav-link'>";
        print "Carrito: ".number_format($_SESSION["carrito"],2)."€";
        print "</a>";
        print "</li>";
      }
      //
      print "<li class='nav-item'>";
      print "<a href='".RUTA."tienda/logout' class='nav-link'>Logout</a>";
      print "</li>";
      print "</ul>";
      ?>
      <form action="<?php print RUTA; ?>buscar/producto" class="form-inline"  method="POST">
        <input type="text" name="buscar" id="buscar" class="form-control" size="20" placeholder="Buscar un producto">
        <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
      </form>
      <?php
    }
    if(isset($datos["admon"])){
      if($datos["admon"]){
        print "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
        print "<li class='nav-item'>";
        print "<a href='".RUTA."admonUsuarios' class='nav-link'>Usuarios</a>";
        print "</li>";
        print "<li class='nav-item'>";
        print "<a href='".RUTA."admonProductos' class='nav-link'>Productos</a>";
        print "</li>";
        print "</li>";
        print "<li class='nav-item'>";
        print "<a href='".RUTA."carrito/ventas' class='nav-link'>Ventas</a>";
        print "</li>";
        print "</ul>";
      }
    }
    ?>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
      <?php
        if (isset($datos["errores"])) {
          if (count($datos["errores"])>0) {
            print "<div class='alert alert-danger mt-3'>";
            foreach ($datos["errores"] as $key => $valor) {
              print "<strong>* ".$valor."</strong><br>";
            }
            print "</div>";
          }
        }
      ?>