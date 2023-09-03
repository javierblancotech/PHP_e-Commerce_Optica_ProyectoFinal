<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Lentillas Modelo
 */
class LentillasModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function getLentillas(){
    $sql = "SELECT * FROM productos WHERE baja=0 AND tipo=2";
    $data = $this->db->querySelect($sql);
    return $data;
  }
}
?>