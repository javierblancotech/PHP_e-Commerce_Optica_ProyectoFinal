<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Modelo Usuarios Admon.
 */
class AdmonUsuariosModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function insertarDatos($data){
    $clave = hash_hmac("sha512", $data["clave1"], LLAVE);
    $sql = "INSERT INTO admon VALUES(0,";
    $sql.= "'".$data['nombre']."', ";
    $sql.= "'".$data['usuario']."', ";
    $sql.= "'".$clave."', ";
    $sql.= "1, "; // clave
    $sql.= "0, "; //baja
    $sql.= "'', "; //fecha del ultimo login
    $sql.= "'', "; //fecha del baja
    $sql.= "'', "; //fecha del modificacion
    $sql.= "(NOW()))"; //fecha del ultimo login
    return $this->db->queryNoSelect($sql);
  }

  public function getUsuarios(){
    $sql = "SELECT * FROM admon WHERE baja=0";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getLlaves($tipo){
    $sql = "SELECT * FROM llaves WHERE tipo='".$tipo."' ORDER BY indice DESC";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getUsuarioId($id){
    $sql = "SELECT * FROM admon WHERE id=".$id;
    $data = $this->db->query($sql);
    return $data;
  }

  public function bajaLogica($id){
    $errores = array();
    $sql = "UPDATE admon SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
    if(!$this->db->queryNoSelect($sql)){
      array_push($errores,"Error al modificar el registro para baja.");
    }
    return $errores;
  }

  public function modificaUsuario($data){
    $errores = array();
    $sql = "UPDATE admon SET ";
    $sql.= "correo='".$data["correo"]."', ";
    $sql.= "nombre='".$data["nombre"]."', ";
    $sql.= "modificado_dt=(NOW()), ";
    $sql.= "status=".$data["status"];
    if(!empty($data['clave1'] && !empty($data['clave2']))){
      $clave = hash_hmac("sha512", $data["clave1"], LLAVE);
      $sql.= ", clave='".$clave."'";
    }
    $sql.= " WHERE id=".$data["id"];
    if(!$this->db->queryNoSelect($sql)){
      array_push($errores,"Existió un error al actualizar el registro.");
    }
    return $errores;
  }
}

?>