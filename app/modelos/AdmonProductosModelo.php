<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Modelo Productos Admon.
 */
class AdmonProductosModelo{
  private $db;
  
  function __construct()
  {
    $this->db = new MySQLdb();
  }

  public function getProductos(){
    $sql = "SELECT * FROM productos WHERE baja=0";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getCatalogo(){
    $sql = "SELECT id, nombre, tipo FROM productos ";
    $sql.= "WHERE baja=0 AND status!=0 ";
    $sql.= "Order BY tipo, nombre";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getLlaves($tipo){
    $sql = "SELECT * FROM llaves WHERE tipo='".$tipo."' ";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getProductoId($id){
    $sql = "SELECT * FROM productos WHERE id=".$id;
    $data = $this->db->query($sql);
    return $data;
  }

  public function bajaLogica($id){
    $salida = true;
    $sql = "UPDATE productos SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
    if(!$this->db->queryNoSelect($sql)){
      $salida = false;
    }
    return $salida;
  }

  public function modificaProducto($data){
    $salida = false;
    if (!empty($data["id"])) {
     $sql = "UPDATE  productos SET ";                  //1. id
     $sql.= "tipo='".$data['tipo']."', ";              //2. tipo
     $sql.= "nombre='".$data['nombre']."', ";          //3. nombre
     $sql.= "descripcion='".$data['descripcion']."', ";//4. descripcion
     $sql.= "precio=".$data['precio'].", ";            //5. precio
     $sql.= "descuento=".$data['descuento'].", ";      //6. descuento 
     $sql.= "envio=".$data['envio'].", ";              //7. envio
     $sql.= "imagen='".$data['imagen']."', ";          //8. imagen
     $sql.= "fecha='".$data['fecha']."', ";            //9. fecha
     $sql.= "relacion1='".$data['relacion1']."', ";    //10. relacion1
     $sql.= "relacion2='".$data['relacion2']."', ";    //11. relacion2
     $sql.= "relacion3='".$data['relacion3']."', ";    //12. relacion3
     $sql.= "masvendido='".$data['masvendido']."', ";  //13. masvendido
     $sql.= "nuevos='".$data['nuevo']."', ";           //14. nuevos
     $sql.= "status='".$data['status']."', ";          //15. status
     $sql.= "baja=0, ";                                //16. baja
     //$sql.= "(NOW()), ";                             //17. fecha alta
     $sql.= "modificado_dt=(NOW()), ";                 //18. fecha modificado
     //$sql.= "'', ";                                  //19. fecha baja
     $sql.= "uso='".$data['uso']."', ";            //20. uso
     $sql.= "graduacion='".$data['graduacion']."', ";    //21. graduacion
     $sql.= "dioptrias=".$data['dioptrias'].", ";                  //22. dioptrias
     $sql.= "marca='".$data['marca']."', ";        //23. marca
     $sql.= "color='".$data['color']."', ";      //24. color
     $sql.= "colorlente='".$data['colorlente']."' ";     //25. colorlente
     $sql.= "WHERE id=".$data['id'];

     //Enviamos a la base de datos
     $salida = $this->db->queryNoSelect($sql);
    }
    
    return $salida;
  }

  public function altaProducto($data){
   $sql = "INSERT INTO productos VALUES(0,"; //1. id
   $sql.= "'".$data['tipo']."', ";           //2. tipo
   $sql.= "'".$data['nombre']."', ";          //3. nombre
   $sql.= "'".$data['descripcion']."', ";     //4. descripcion
   $sql.= $data['precio'].", ";               //5. precio
   $sql.= $data['descuento'].", ";            //6. descuento 
   $sql.= $data['envio'].", ";                //7. envio
   $sql.= "'".$data['imagen']."', ";          //8. imagen
   $sql.= "'".$data['fecha']."', ";           //9. fecha
   $sql.= "'".$data['relacion1']."', ";       //10. relacion1
   $sql.= "'".$data['relacion2']."', ";       //11. relacion2
   $sql.= "'".$data['relacion3']."', ";       //12. relacion3
   $sql.= "'".$data['masvendido']."', ";      //13. masvendido
   $sql.= "'".$data['nuevo']."', ";           //14. nuevos
   $sql.= "'".$data['status']."', ";          //15. status
   $sql.= "0, ";                              //16. baja
   $sql.= "(NOW()), ";                        //17. fecha alta
   $sql.= "'', ";                             //18. fecha modificado
   $sql.= "'', ";                             //19. fecha baja
   $sql.= "'".$data['uso']."', ";           //20. uso
   $sql.= "'".$data['graduacion']."', ";       //21. graduacion
   $sql.= $data['dioptrias'].", ";                  //22. dioptrias
   $sql.= "'".$data['marca']."', ";         //23. marca
   $sql.= "'".$data['color']."', ";        //24. color
   $sql.= "'".$data['colorlente']."')";       //25. colorlente
   //print $sql;
   return $this->db->queryNoSelect($sql);
  }

  public function getMasVendidos()
  {
    $sql = "SELECT * FROM productos WHERE masvendido='1' AND baja=0 LIMIT 8";
    $data = $this->db->querySelect($sql);
    return $data;
  }

  public function getNuevos()
  {
    $sql = "SELECT * FROM productos WHERE masvendido='0' ";
    $sql.= "AND nuevos='1' AND baja=0 LIMIT 8";
    $data = $this->db->querySelect($sql);
    return $data;
  }
}

?>