<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Manejo de la base de datos MySQL
 */
class MySQLdb{
  private $host = "localhost";
  private $usuario = "root";
  private $clave = ""; //XAMPP la clave es vacía, y en MAMP es "root"
  private $db = "ecommerce";
  private $puerto = ""; //MAMP en Windows necesitamos el puerto
  private $conn;
  
  function __construct()
  {
    $this->conn = mysqli_connect($this->host, 
      $this->usuario, 
      $this->clave,
      $this->db);

    if (mysqli_connect_errno()) {
      printf("Error en la conexión a la base de datos %s",
      mysqli_connect_errno());
      exit();
    } else {
      //print "Conexión exitosa"."<br>";
    }

    if (!mysqli_set_charset($this->conn, "utf8")) {
      printf("Error en la conversión de caracteress %s",
      mysqli_connect_error());
      exit();
    } else {
      //print "El conjunto de caracteres es: ".mysqli_character_set_name($this->conn)."<br>";
    }
  } //fin constructora

  //Query regresa un solo registro en un arreglo asociado
  function query($sql){
    $data = array();
    $r = mysqli_query($this->conn, $sql);
    if($r){
      if(mysqli_num_rows($r)>0){
        $data = mysqli_fetch_assoc($r);
      }
    }
    return $data;
  }

  function querySelect($sql){
    $data = array();
    $r = mysqli_query($this->conn, $sql);
    if($r){
      while($row = mysqli_fetch_assoc($r)){
        array_push($data, $row);
      }
    }
    return $data;
  }

  //Query regresa un valor booleano
  function queryNoSelect($sql){
    $r = mysqli_query($this->conn, $sql);
    return $r;
  }

  public function cerrar()
  {
    mysqli_close($this->conn);
  }
}
?>