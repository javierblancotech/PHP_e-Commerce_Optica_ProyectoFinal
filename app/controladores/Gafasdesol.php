<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador Gafas de sol
 */
class Gafasdesol extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("GafasdesolModelo");
  }

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      //Leer los productos mas vendidos
      //
      $data = $this->getGafasdesol();
      //
      $datos = [
        "titulo" => "Gafas de sol",
        "activo" => "gafasdesol",
        "data" => $data,
        "menu" => true
      ];
      $this->vista("gafasdesolVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }

  public function getGafasdesol()
  {
    $data = array();
    $data = $this->modelo->getGafasdesol();
    return $data;
  }
}
?>