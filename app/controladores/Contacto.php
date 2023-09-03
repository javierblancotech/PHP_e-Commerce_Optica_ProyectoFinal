<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador Contacto
 */
class Contacto extends Controlador{
  private $modelo;

  function __construct(){}

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      //
      $datos = [
        "titulo" => "Contacto",
        "activo" => "contacto",
        "menu" => true
      ];
      $this->vista("contactoVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }

  public function enviar(){
    $errores = array();
    $data = array();
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      //
      //Recuperar la infromación
      //
      $correo = $_POST["correo"]??"";
      $nombre = $_POST["nombre"]??"";
      $observacion = $_POST["observacion"]??"";
      if ($correo=="") {
        array_push($errores,"El correo es requerido");
      }
      if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        array_push($errores,"El correo electrónico no es válido");
      }
      if ($nombre=="") {
        array_push($errores,"Su nombre es requerido");
      }
      if ($observacion=="") {
        array_push($errores,"Su observación es requerida");
      }
      if(count($errores)==0){
        //Mail del administrador
        $email = "info@mitienda.com";
        //
        //Enviar correo
        //
        $msg = $nombre." ha enviado una observación<br>";
        $msg.= $correo."<br>";
        $msg.= $observacion;

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type:text/html; charset=UTF-8\r\n"; 
        $headers .= "From: ".$nombre."\r\n"; 
        $headers .= "Replay-to: ".$correo."\r\n";

        $asunto = "Observación";

        if(@mail($email, $asunto, $msg, $headers)){
          $datos = [
          "titulo" => "Envío de observación",
          "menu" => true,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Gracias por su correo",
          "texto" => "En breve nos comunicaremos con usted...",
          "color" => "alert-success",
          "url" => "tienda",
          "colorBoton" => "btn-success",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        } else {
          $datos = [
          "titulo" => "Error en el envío del correo",
          "menu" => true,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Error en el envío del correo",
          "texto" => "Existió un problema al enviar el correo electrónico. Prueba por favor más tarde o comuníquese a nuestro servicio de soporte técnico.",
          "color" => "alert-danger",
          "url" => "tienda",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        }
      } else if(count($errores)){
        $datos = [
        "titulo" => "Contacto",
        "menu" => true,
        "errores" => $errores,
        "subtitulo" => "Envío de correo",
        "data" => []
        ];
        $this->vista("contactoVista",$datos);
      }
    }
  }
}
?>