<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Gafas de Sol Modelo
 */
class GafasdesolModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function getGafasdesol(){
    $sql = "SELECT * FROM productos WHERE baja=0 AND tipo=1";
    $data = $this->db->querySelect($sql);
    return $data;
  }
}
?>