<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */
 
/**
 * Administrador Modelo
 */
class AdmonModelo{
  private $db;

  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function verificarClave($data)
  {
    //Declaramos el arreglo
    $errores = array();

    //Encriptar
    $clave = hash_hmac("sha512", $data['clave'], LLAVE);

    //Enviamos el query
    $sql = "SELECT id, clave, status, baja FROM admon WHERE correo='".$data['usuario']."'";
    $data = $this->db->query($sql);

    //Verificación
    if (empty($data)) {
      array_push($errores, "No existe el usuario.");
    } else if($clave!=$data['clave']){
      array_push($errores, "La clave de acceso no es correcta.");
    } else if($data['status']==0){
      array_push($errores, "El usuario está desactivado.");
    } else if($data['baja']==1){
      array_push($errores, "El usuario está dado de baja.");
    } else if(count($data)>4){
      array_push($errores, "El correo electrónico esta duplicado.");
    } else {
      $sql = "UPDATE admon SET login_dt=NOW() WHERE id=".$data['id'];
      if (!$this->db->queryNoSelect($sql)) {
        array_push($errores, "Error al modificar la fecha del último acceso.");
      }
    }
    
    //Regresamos los errores
    return $errores;
  }
}
?>