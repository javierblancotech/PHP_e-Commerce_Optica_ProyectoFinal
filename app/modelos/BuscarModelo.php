<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Buscar Modelo
 */
class BuscarModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  function getProductosBuscar($buscar){
    $sql = "SELECT * FROM productos WHERE ";
    $sql.= "uso LIKE '%".$buscar."%' OR ";
    $sql.= "dioptrias LIKE '%".$buscar."%' OR ";
    $sql.= "nombre LIKE '%".$buscar."%' OR ";
    $sql.= "descripcion LIKE '%".$buscar."%'";
    //
    $data = $this->db->querySelect($sql);
    return $data; 
  }
}
?>