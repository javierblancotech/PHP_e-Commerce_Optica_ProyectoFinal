<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador para productos
 */
class AdmonProductos extends Controlador
{
  private $modelo;
  
  function __construct()
  {
   $this->modelo = $this->modelo("AdmonProductosModelo");
  }

  public function caratula(){
    //Creamos sesion
    $sesion = new Sesion();

    if ($sesion->getLogin()) {
      //Leemos los datos de la tabla
      $data = $this->modelo->getProductos();

      //Leemos la llaves de tipoProducto
      $llaves = $this->modelo->getLlaves("tipoProducto");

      //Vista caratula
      $datos = [
        "titulo" => "Administrativo Productos",
        "menu" => false,
        "admon" => true,
        "data" => $data,
        "tipoProducto" => $llaves
      ];
      $this->vista("admonProductosCaratulaVista",$datos);
    } else {
      header("location:".RUTA."admon");
    }
    
  }

  public function alta(){
    //Definir los arreglos
    $data = array();
    $errores = array();

    //Leemos la llaves de tipoProducto
    $llaves = $this->modelo->getLlaves("tipoProducto");

    //Leemos los estatus del producto
    $statusProducto = $this->modelo->getLlaves("statusProducto");

    //Leemos los estatus del producto
    $catalogo = $this->modelo->getCatalogo();

    //Recibimos la información de la vista
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      //Recibimos la información PHP7 isset()?valor1:valor2 => valor1 ?? valor2
      //si existe id es una modificación, si no existe es una alta
      $id = trim($_POST['id'] ?? "");
      //
      $tipo = $_POST['tipo'] ?? "";
      $nombre = Valida::cadena($_POST['nombre'] ?? "");
      $descripcion = Valida::cadena($_POST['content'] ?? "");
      $precio = Valida::numero($_POST['precio'] ?? "");
      $descuento = Valida::numero($_POST['descuento'] ?? "0");
      $envio = Valida::numero($_POST['envio'] ?? "0");
      //XAMP 5.0.3 
      //$imagen = $_POST['imagen'];

      //XAMP 7.0.1
      $imagen = $_FILES['imagen']['name'];
      $imagen = Valida::archivo($imagen);
      //
      $fecha = $_POST['fecha'] ?? "";
      $relacion1 = $_POST['relacion1'] ?? "";
      $relacion2 = $_POST['relacion2'] ?? "";
      $relacion3 = $_POST['relacion3'] ?? "";
      //
      $masvendido = $_POST['masvendido'] ?? "";
      $nuevo = $_POST['nuevo'] ?? "";
      //validamos los checkboxes
      $masvendido = ($masvendido=="")?"0":"1";
      $nuevo = ($nuevo=="")?"0":"1";
      //
      $status = $_POST['status'] ?? "";
      //LENTILLAS
      $uso = Valida::cadena($_POST['uso'] ?? "");
      $graduacion = Valida::cadena($_POST['graduacion'] ?? "");
      $dioptrias = Valida::numero($_POST['dioptrias'] ?? "");
      if(empty($dioptrias)) $dioptrias = 0;
      //GAFA SOL
      $marca = Valida::cadena($_POST['marca'] ?? "");
      $color = Valida::cadena($_POST['color'] ?? "");
      $colorlente = Valida::cadena($_POST['colorlente'] ?? "");

      //Validamos la información
      if(empty($nombre)){
        array_push($errores,"El nombre del producto es obligatorio");
      }
      if(empty($descripcion)){
        array_push($errores,"La descripción del producto es obligatoria");
      }
      if(!is_numeric($precio)){
        array_push($errores,"El precio debe de ser un número.");
      }
      if(!is_numeric($envio)){
        array_push($errores,"El envío debe de ser un número.");
      }
      if(!is_numeric($descuento)){
        array_push($errores,"El descuento debe de ser un número.");
      }
      if($precio < $descuento){
        array_push($errores,"El descuento no puede ser mayor al precio del producto.");
      }
      if(!Valida::fecha($fecha)){
        array_push($errores,"La fecha es errónea o su formato es erróneo (AAAA-MM-DD).");
      } else if(Valida::fechaDif($fecha)){
        array_push($errores,"La fecha no puede ser mayor a la fecha actual.");
      }
      //1 = gafas sol
      if($tipo==1){
        if(empty($marca)){
          array_push($errores,"La marca de la gafa de sol es obligatoria");
        }
      
        
      } else if($tipo==2){
        
        //2 = lentillas
       
        
       
      } else {
        array_push($errores,"Debes de seleccionar un tipo de producto.");
      }
      if(empty($imagen)){
        array_push($errores,"Debes seleccionar una imagen para el producto.");
      } else if(Valida::archivoImagen($_FILES['imagen']['tmp_name'])){
        //Cambiar el nombre del archivo
        $imagen = Valida::archivo(html_entity_decode($nombre));
        $imagen = strtolower($imagen.".jpg");

        //Subir el archivo
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
          //copiamos el archivo temporal
          copy($_FILES['imagen']['tmp_name'],"img/".$imagen);
          //Validar 240px
          Valida::imagen($imagen,240);
        } else {
          array_push($errores, "Error al subir el archivo de imágen.");
        }
      } else {
        array_push($errores, "Formato de la imagen no aceptado.");
      }

      //Crear arreglo de datos
      $data = [
        "id" => $id,
        "tipo" => $tipo,
        "nombre" => $nombre,
        "descripcion" => $descripcion,
        "uso" => $uso,
        "graduacion" => $graduacion,
        "dioptrias" => $dioptrias,
        "marca" => $marca,
        "color" => $color,
        "colorlente" => $colorlente,
        "precio" => $precio,
        "descuento" => $descuento,
        "envio" => $envio,
        "fecha" => $fecha,
        "imagen" => $imagen,
        "masvendido" => $masvendido,
        "nuevo" => $nuevo,
        "status" => $status,
        "relacion1" => $relacion1,
        "relacion2" => $relacion2,
        "relacion3" => $relacion3
      ];

      if (empty($errores)) {
        
        //Enviamos al modelo
        if($id==""){
          //Alta
          if ($this->modelo->altaProducto($data)) {
            header("location:".RUTA."admonProductos");
          }
        } else {
          //Modificacion
          if ($this->modelo->modificaProducto($data)) {
            header("location:".RUTA."admonProductos");
          }
        }
        
      }
    }

    //Vista Alta
    $datos = [
      "titulo" => "Administrativo Productos Alta",
      "subtitulo" => "Alta de producto",
      "menu" => false,
      "admon" => true,
      "errores" => $errores,
      "tipoProducto" => $llaves,
      "statusProducto" => $statusProducto,
      "catalogo" => $catalogo,
      "data" => $data
    ];

    $this->vista("admonProductosAltaVista",$datos);
  }

  public function baja($id=""){
    //Leemos la llaves de tipoProducto
    $llaves = $this->modelo->getLlaves("tipoProducto");

    //Leemos los estatus del producto
    $statusProducto = $this->modelo->getLlaves("statusProducto");

    //Leemos los estatus del producto
    $catalogo = $this->modelo->getCatalogo();

    //Leemos los datos del registro del id
    $data = $this->modelo->getProductoId($id);

    //Vista Alta
    $datos = [
      "titulo" => "Administrativo Productos Baja",
      "subtitulo" => "Baja producto",
      "menu" => false,
      "admon" => true,
      "errores" => [],
      "tipoProducto" => $llaves,
      "statusProducto" => $statusProducto,
      "catalogo" => $catalogo,
      "data" => $data,
      "baja" => true
    ];
    $this->vista("admonProductosAltaVista",$datos);
  }

  public function bajaLogica($id='')
  {
   if (isset($id)) {
     if($this->modelo->bajaLogica($id)){
      header("location:".RUTA."admonProductos");
     }
   }
  }

  public function cambio($id=""){
    //Leemos la llaves de tipoProducto
    $llaves = $this->modelo->getLlaves("tipoProducto");

    //Leemos los estatus del producto
    $statusProducto = $this->modelo->getLlaves("statusProducto");

    //Leemos los estatus del producto
    $catalogo = $this->modelo->getCatalogo();

    //Leemos los datos del registro del id
    $data = $this->modelo->getProductoId($id);

    //Vista Alta
    $datos = [
      "titulo" => "Administrativo Productos Modificar",
      "subtitulo" => "Modifica producto",
      "menu" => false,
      "admon" => true,
      "errores" => [],
      "tipoProducto" => $llaves,
      "statusProducto" => $statusProducto,
      "catalogo" => $catalogo,
      "data" => $data
    ];
    $this->vista("admonProductosAltaVista",$datos);
  }

  public function getMasVendidos()
  {
    return $this->modelo->getMasVendidos();
  }

  public function getNuevos()
  {
    return $this->modelo->getNuevos();
  }

  public function producto($id='',$regresa='')
  {
    //Leemos los datos del registro del id
    $data = $this->modelo->getProductoId($id);
    //
    //Enviamos el id del usuario
    $sesion = new Sesion();
    $idUsuario = $_SESSION["usuario"]["id"];
    //
    //Vista Alta
    $datos = [
      "titulo" => "Productos",
      "subtitulo" => $data["nombre"],
      "menu" => true,
      "admon" => false,
      "regresa" => $regresa,
      "idUsuario" => $idUsuario,
      "errores" => [],
      "data" => $data
    ];
    $this->vista("productoVista",$datos);
  }
}

?>