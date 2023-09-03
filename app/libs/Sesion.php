<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Manejar sesión
 */
class Sesion{
  private $login = false;
  private $usuario;
  
  function __construct()
  {
    session_start();
    if (isset($_SESSION["usuario"])) {
      $this->usuario = $_SESSION["usuario"];
      $this->login = true;
      //
      //Calculo del total del carrito
      //
      if (isset($_SESSION["usuario"]["id"])) {
        $idUsuario = $_SESSION["usuario"]["id"];
        $_SESSION["carrito"] = $this->totalCarrito($idUsuario)??0;
      } 
      //
    } else {
      unset($this->usuario);
      $this->login = false;
    }
  }

  public function iniciarLogin($usuario){
    if ($usuario) {
      $this->usuario = $_SESSION["usuario"] = $usuario;
      $this->login = true;
    }
  }

  public function finalizarLogin(){
    unset($_SESSION["usuario"]);
    unset($this->usuario);
    session_destroy();
    $this->login = false;
  }

  public function getLogin(){
    return $this->login;
  }

  public function getUsuario(){
    return $this->usuario;
  }

  public function totalCarrito($idUsuario)
  {
    $db = new MySQLdb();
    $sql = "SELECT SUM(p.precio * c.cantidad) - ";
    $sql.= "SUM(c.descuento) + SUM(c.envio) as tot ";
    $sql.= "FROM carrito as c, productos as p ";
    $sql.= "WHERE c.idUsuario = ".$idUsuario." AND ";
    $sql.= "c.idProducto=p.id AND c.estado=0";
    $data = $db->query($sql);
    $tot = $data["tot"]??0;
    $db->cerrar();
    return $tot;
  }
}

?>