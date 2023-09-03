<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/*
 * Control maneja la URL y lanza los procesos
 el primer elemento es el objeto o controlador
 el segundo elemento es el metodo o accion
 el tercero y posteriores son los parametros
 */
class Control{
  protected $controlador = "Login";
  protected $metodo = "caratula";
  protected $parametros = [];
  
  function __construct(){
    $url = $this->separarURL();
    
    if($url!="" && file_exists("../app/controladores/".ucwords($url[0]).".php")){
      $this->controlador = ucwords($url[0]);
      unset($url[0]);
    }
    //Cargando la clase del controlador
    require_once("../app/controladores/".ucwords($this->controlador).".php");
    //Instanciando la clase controlador
    $this->controlador = new $this->controlador;

    if (isset($url[1])) {
      if (method_exists($this->controlador, $url[1])) {
        $this->metodo = $url[1];
        unset($url[1]);
      }
    }
    //
    $this->parametros = $url ? array_values($url):[];

    call_user_func_array(
      [$this->controlador,$this->metodo], 
      $this->parametros
    );
    
  }

  function separarURL(){
    $url = "";
    if(isset($_GET["url"])){
      //eliminamos el caracter final
      $url = rtrim($_GET["url"],"/");
      $url = rtrim($_GET["url"],"\\");
      //Limpiamos caracteres no propios para la URL
      $url = filter_var($url, FILTER_SANITIZE_URL);
      //Separamos
      $url = explode("/",$url);
    }
    return $url;
  }
}