<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador Login
 */
class Tienda extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("TiendaModelo");
  }

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      //Leer los productos mas vendidos
      //
      $data = $this->getMasVendidos();
      //
      //Leer los productos nuevos
      //
      $nuevos = $this->getNuevos();
      //
      $datos = [
        "titulo" => "Bienvenid@ a nuestra tienda",
        "data" => $data,
        "nuevos" => $nuevos,
        "menu" => true
      ];
      $this->vista("tiendaVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }

  function logout(){
    session_start();
    if (isset($_SESSION["usuario"])) {
      $sesion = new Sesion();
      $sesion->finalizarLogin();
    }
    header("location:".RUTA);
  }

  public function getMasVendidos()
  {
    $data = array();
    require_once "AdmonProductos.php";
    $productos = new AdmonProductos();
    $data = $productos->getMasVendidos();
    unset($productos);
    return $data;
  }

  public function getNuevos()
  {
    $data = array();
    require_once "AdmonProductos.php";
    $productos = new AdmonProductos();
    $data = $productos->getNuevos();
    unset($productos);
    return $data;
  }
}
?>