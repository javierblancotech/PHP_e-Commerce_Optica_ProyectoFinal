<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * 
 */
class Controlador{
  
  function __construct(){}

  public function modelo($modelo){
    require_once("../app/modelos/".$modelo.".php");
    return new $modelo();
  }

  public function vista($vista, $datos=[]){
    if (file_exists("../app/vistas/".$vista.".php")) {
      require_once("../app/vistas/".$vista.".php");
    } else {
      die("La vista no existe...");
    }
    
  }
}
?>