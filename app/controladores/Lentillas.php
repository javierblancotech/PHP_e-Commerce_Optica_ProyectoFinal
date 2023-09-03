<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador Lentillas
 */
class Lentillas extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("LentillasModelo");
  }

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      //Leer los productos mas vendidos
      //
      $data = $this->getLentillas();
      //
      $datos = [
        "titulo" => "Lentillas",
        "activo" => "Lentillas",
        "data" => $data,
        "menu" => true
      ];
      $this->vista("lentillasVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }

  public function getLentillas()
  {
    return $this->modelo->getLentillas();
  }
}
?>