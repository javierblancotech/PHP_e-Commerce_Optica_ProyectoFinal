<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador Buscar
 */
class Buscar extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("BuscarModelo");
  }

  function caratula(){
    
  }

  public function producto()
  {
    $buscar = $_POST["buscar"]??"";
    if (!empty($buscar)) {
      //
      //Leer los productos mas vendidos
      //
      $data = $this->modelo->getProductosBuscar($buscar);
      //
      if(count($data)==0){
        $datos = [
          "titulo" => "No hay ningún artículo",
          "menu" => true,
          "errores" => [],
          "data" => [],
          "subtitulo" => "No hay artículos",
          "texto" => "No hay artículos con el criterio '".$buscar."'.",
          "color" => "alert-danger",
          "url" => "tienda",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
      } else {
        $datos = [
        "titulo" => "Productos buscados",
        "data" => $data,
        "menu" => true
          ];
        $this->vista("buscarVista",$datos);
      } 
    } else {
      header("location:".RUTA);
   }
      
  }
}
?>