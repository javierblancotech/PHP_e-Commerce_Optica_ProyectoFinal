<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Login Modelo
 */
class LoginModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  function insertarRegistro($data){
    $r = false;
    if ($this->validaCorreo($data["email"])) {
      $clave = hash_hmac("sha512", $data["clave1"], "mimamamemima");
      $sql = "INSERT INTO usuarios VALUES(0,";
      $sql.= "'".$data["nombre"]."', ";
      $sql.= "'".$data["apellidoPaterno"]."', ";
      $sql.= "'".$data["apellidoMaterno"]."', ";
      $sql.= "'".$data["email"]."', ";
      $sql.= "'".$data["direccion"]."', ";
      $sql.= "'".$data["ciudad"]."', ";
      $sql.= "'".$data["comunidadautonoma"]."', ";
      $sql.= "'".$data["estado"]."', ";
      $sql.= "'".$data["codpos"]."', ";
      $sql.= "'".$data["pais"]."', ";
      $sql.= "'".$clave."')";
      $r = $this->db->queryNoSelect($sql);
    } 
    return $r;
  }

  function cambiarClaveAcceso($id, $clave){
    $r = false;
    $clave = hash_hmac("sha512", $clave, "mimamamemima");
    $sql = "UPDATE usuarios SET ";
    $sql.= "clave='".$clave."' ";
    $sql.= "WHERE id=".$id;
    $r = $this->db->queryNoSelect($sql);
    return $r;
  }

  function validaCorreo($email){
    $sql = "SELECT * FROM usuarios WHERE email='".$email."'";
    $data = $this->db->query($sql);
    return (count($data)==0)?true:false;
  }

  function verificar($usuario, $clave){
    $errores = array();
    $sql = "SELECT * FROM usuarios WHERE email='".$usuario."'";
    $clave = hash_hmac("sha512", $clave, "mimamamemima");
    $clave = substr($clave,0,200);
    //consulta
    $data = $this->db->query($sql);
    //validacion
    if (empty($data)) {
      array_push($errores,"No existe ese usuario, favor de verificarlo.");
    } else if($clave!=$data["clave"]){
      array_push($errores,"Clave de acceso erronea, favor de verificar.");
    }
    return $errores;
  }

  function getUsuarioCorreo($email){
    $sql = "SELECT * FROM usuarios WHERE email='".$email."'";
    $data = $this->db->query($sql);
    return $data;
  }

  function enviarCorreo($email){
    $data = $this->getUsuarioCorreo($email);
    //
    $id = $data["id"];
    $nombre = $data["nombre"]." ".$data["apellidoPaterno"]." ".$data["apellidoMaterno"];
    $msg = $nombre.", entra a la siguiente liga para cambiar tu clave de acceso a la tienda ...<br>";
    $msg.= "<a href='".RUTA."/login/cambiaclave/".$id."'>Cambia tu clave de acceso</a>";

    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type:text/html; charset=UTF-8\r\n"; 
    $headers .= "From: eCommerce\r\n"; 
    $headers .= "Repaly-to: picapiedra@tiendavirtual.com\r\n";

    $asunto = "Cambiar clave de acceso";

    return @mail($email,$asunto, $msg, $headers);
  }
}
?>