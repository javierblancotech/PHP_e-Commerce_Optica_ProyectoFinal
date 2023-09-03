<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Admon Inicio Modelo
 */
class AdmonInicioModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }
}
?>