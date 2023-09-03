<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

/**
 * Controlador administrativo
 */
class Admon extends Controlador{
  private $modelo;

  function __construct(){
    $this->modelo = $this->modelo("AdmonModelo");
  }

  public function caratula()
  {
    $datos = [
      "titulo" => "Administrativo",
      "menu" => false,
      "data" => []
    ];
    $this->vista("admonVista",$datos);
  }

  public function verifica()
  {
    //Inicio arreglo
    $errores = array();
    $data = array();

    //Recibimos los datos de la vista
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      
      //Limpiamos de datos
      $usuario = isset($_POST['usuario'])?$_POST['usuario']:"";
      $clave = isset($_POST['clave'])?$_POST['clave']:"";
      
      //Validaciones
      if(empty($usuario)){
        array_push($errores,"El usuario es requerdio.");
      }
      if(empty($clave)){
        array_push($errores,"La clave del usuario es requerdia.");
      }
      
      //Arreglo de datos
      $data = [
        "usuario" => $usuario,
        "clave" => $clave
      ];
      
      //Verificar errores
      if (empty($errores)) {

        //Ejecutar query
        $errores = $this->modelo->verificarClave($data);
        
        //No hay errores
        if (empty($errores)) {
          //Creamos la sesion
          $sesion = new Sesion();
          $sesion->iniciarLogin($data);
          
          //Abrimos admonInicio
          header("location:".RUTA."admonInicio");
        } 
      } 
    } 

    //enviamos errores a la vista
   $datos = [
      "titulo" => "Administrativo",
      "menu" => false,
      "admon" => true,
      "errores" => $errores,
      "data" => []
    ];
    $this->vista("admonVista",$datos);
  }
}

?>