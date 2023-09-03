<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Login Carrito
 */
class CarritoModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function verificaProducto($idProducto, $idUsuario)
  {
    $sql = "SELECT * FROM carrito WHERE idUsuario=".$idUsuario." ";
    $sql.= "AND idProducto=".$idProducto;
    $r = $this->db->querySelect($sql);
    return count($r);
  }

  public function agregaProducto($idProducto, $idUsuario)
  {
    $sql = "SELECT * FROM productos WHERE id=".$idProducto;
    $data = $this->db->query($sql);

    $sql = "INSERT INTO carrito ";
    $sql.= "SET estado=0, "; //carrito abierto
    $sql.= "idProducto=".$idProducto.", ";
    $sql.= "idUsuario=".$idUsuario.", ";
    $sql.= "descuento=".$data["descuento"].", ";
    $sql.= "envio=".$data["envio"].", ";
    $sql.= "cantidad=1, ";
    $sql.= "fecha=(NOW())";
    //
    return $this->db->queryNoSelect($sql);
  }

  public function getCarrito($idUsuario)
  {
    $sql = "SELECT c.idUsuario as usuario, ";
    $sql.= "c.idProducto as producto, ";
    $sql.= "c.cantidad as cantidad, ";
    $sql.= "c.envio as envio, ";
    $sql.= "c.descuento as descuento, ";
    $sql.= "p.precio as precio, ";
    $sql.= "p.imagen as imagen, ";
    $sql.= "p.descripcion as descripcion, ";
    $sql.= "p.nombre as nombre ";
    $sql.= "FROM carrito as c, productos as p ";
    $sql.= "WHERE idUsuario='".$idUsuario."' AND ";
    $sql.= "estado=0 AND ";
    $sql.= "c.idProducto=p.id";
    //
    return $this->db->querySelect($sql);
  }

  public function actualiza($idUsuario, $idProducto, $cantidad)
  {
    $sql = "UPDATE carrito ";
    $sql.= "SET cantidad=".$cantidad." ";
    $sql.= "WHERE idUsuario=".$idUsuario." AND ";
    $sql.= "idProducto=".$idProducto;
    return $this->db->queryNoSelect($sql);
  }

  public function borrar($idProducto, $idUsuario)
  {
    $sql = "DELETE FROM carrito WHERE idUsuario=".$idUsuario." AND ";
    $sql.= "idProducto=".$idProducto;
    return $this->db->queryNoSelect($sql);
  }

  public function cierraCarrito($idUsuario,$estado)
  {
    $sql = "UPDATE carrito ";
    $sql.= "SET estado=".$estado.", ";
    $sql.= "fecha=(NOW()) ";
    $sql.= "WHERE idUsuario=".$idUsuario." AND ";
    $sql.= "estado=0";
    return $this->db->queryNoSelect($sql);
  }

  public function ventas()
  {
    $sql = "SELECT SUM(p.precio*c.cantidad) as costo, ";
    $sql.= "SUM(c.descuento) as descuento, ";
    $sql.= "SUM(c.envio) as envio, ";
    $sql.= "c.fecha as fecha, c.idUsuario as idUsuario ";
    $sql.= "FROM carrito as c, productos as p ";
    $sql.= "WHERE c.idProducto=p.id AND ";
    $sql.= "c.estado=1 ";
    $sql.= "GROUP BY DATE(c.fecha), c.idUsuario";
    return $this->db->querySelect($sql);
  }

  public function detalle($fecha, $idUsuario)
  {
    $sql = "SELECT p.precio as precio, c.cantidad as cantidad, ";
    $sql.= "c.descuento as descuento, ";
    $sql.= "c.envio as envio, ";
    $sql.= "c.fecha as fecha, ";
    $sql.= "p.nombre as nombre ";
    $sql.= "FROM carrito as c, productos as p ";
    $sql.= "WHERE c.idProducto=p.id AND ";
    $sql.= "c.estado=1 AND ";
    $sql.= "DATE(c.fecha)='".$fecha."' AND ";
    $sql.= "c.idUsuario=".$idUsuario;
    return $this->db->querySelect($sql);
  }

  public function ventasxdia()
  {
    $sql = "SELECT SUM(p.precio * c.cantidad) - ";
    $sql.= "SUM(c.descuento) + SUM(c.envio) as venta, ";
    $sql.= "c.fecha as fecha ";
    $sql.= "FROM carrito as c, productos as p ";
    $sql.= "WHERE c.idProducto=p.id AND c.estado=1 ";
    $sql.= "GROUP BY DATE(c.fecha)";
    return $this->db->querySelect($sql);
  }
}
?>