<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador usuarios admon.
 */
class AdmonUsuarios extends Controlador{
  private $modelo;
  
  function __construct()
  {
    $this->modelo = $this->modelo("AdmonUsuariosModelo");
  }

  public function caratula()
  {
    //Creamos sesion
    $sesion = new Sesion();

    if($sesion->getLogin()){

      //Leemos los datos de la tabla
      $data = $this->modelo->getUsuarios();

      $datos = [
        "titulo" => "Administrativo Usuarios",
        "menu" => false,
        "admon" => true,
        "data" => $data
      ];
      $this->vista("admonUsuariosCaratulaVista",$datos);
    } else {
      header("location:".RUTA."admon");
    }
  }

  public function alta()
  {
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $errores = array();
      $data = array();
      $usuario = isset($_POST['usuario'])?$_POST['usuario']:"";
      $clave1 = isset($_POST['clave1'])?$_POST['clave1']:"";
      $clave2 = isset($_POST['clave2'])?$_POST['clave2']:"";
      $nombre = isset($_POST['nombre'])?$_POST['nombre']:"";
      //Validacion
      if(empty($usuario)){
        array_push($errores,"El usuario es requerido.");
      }
      if(empty($clave1)){
        array_push($errores,"La clave de acceso es requerida.");
      }
      if(empty($clave2)){
        array_push($errores,"La verificación de la clave de acceso es requerida.");
      }
      if($clave1!=$clave2){
        array_push($errores,"Las claves no coinciden, favor de verificar.");
      }
      if(empty($nombre)){
        array_push($errores,"El nombre del usuario es requerido.");
      }

      //Crear arreglo de datos
      $data = [
          "nombre" => $nombre,
          "clave1" => $clave1,
          "clave2" => $clave2,
          "usuario" => $usuario
        ];
        
      //Verificamos que no haya errores
      if (empty($errores)) {
        if ($this->modelo->insertarDatos($data)) {
          header("location:".RUTA."admonUsuarios");
        } else {
          $datos = [
          "titulo" => "Error en el registro",
          "menu" => false,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Error en la inserción del registro",
          "texto" => "Existió un error al insertar el registro, favor de intentarlo más tarde o comunicarse a soporte técnico.",
          "color" => "alert-danger",
          "url" => "admonInicio",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        } 
      } else {
        $datos = [
        "titulo" => "Administrativo Usuarios Alta",
        "menu" => false,
        "admon" => true,
        "errores" => $errores,
        "data" => $data
      ];
      $this->vista("admonUsuariosVista",$datos);
      }
    } else {
      $datos = [
        "titulo" => "Administrativo Usuarios Alta",
        "menu" => false,
        "admon" => true,
        "data" => []
      ];
      $this->vista("admonUsuariosVista",$datos);
    }
  }

  public function baja($id="")
  {
   //Definiendo arreglos
    $errores = array();
    $data = array();

    //Recibiendo de la vista
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $id = isset($_POST['id'])?$_POST['id']:"";
      if(!empty($id)){
        $errores = $this->modelo->bajaLogica($id);

        //Si no hay errores regresamos
        if(empty($errores)){
          header("location:".RUTA."admonUsuarios");
        }
      }
    }

    $data = $this->modelo->getUsuarioId($id);
    $llaves = $this->modelo->getLlaves("admonStatus");

    //Abrir la vista
    $datos = [
        "titulo" => "Administrativo Usuarios Baja",
        "menu" => false,
        "admon" => true,
        "status" => $llaves,
        "errores" => $errores,
        "data" => $data
      ];
    $this->vista("admonUsuariosBorraVista",$datos);
  }

  public function cambio($id="")
  {
    //Definiendo arreglos
    $errores = array();
    $data = array();

    //Recibiendo de la vista
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      
      //Limpiando variables
      $id = isset($_POST['id'])?$_POST['id']:"";
      $correo = isset($_POST['correo'])?$_POST['correo']:"";
      $clave1 = isset($_POST['clave1'])?$_POST['clave1']:"";
      $clave2 = isset($_POST['clave2'])?$_POST['clave2']:"";
      $nombre = isset($_POST['nombre'])?$_POST['nombre']:"";
      $status = isset($_POST['status'])?$_POST['status']:"";
      
      //Validacion
      if(empty($correo)){
        array_push($errores,"El usuario es requerido.");
      }
      if(empty($nombre)){
        array_push($errores,"El nombre del usuario es requerido.");
      }
      if($status=="void"){
        array_push($errores,"Selecciona el status del usuario.");
      }
      if(!empty($clave1) && !empty($clave2)){
        if($clave1 != $clave2){
          array_push($errores,"Las valores no coinciden.");
        }
      }

      if(empty($errores)){

        //Crear arreglo de datos
        $data = [
            "id" => $id,
            "nombre" => $nombre,
            "clave1" => $clave1,
            "clave2" => $clave2,
            "status" => $status,
            "correo" => $correo
          ];
        
        //Enviamos al modelo
        $errores = $this->modelo->modificaUsuario($data);

        //Validamos la modificación
        if(empty($errores)){
          header("location:".RUTA."admonUsuarios");
        }
              
      }
    }
    $data = $this->modelo->getUsuarioId($id);
    $llaves = $this->modelo->getLlaves("admonStatus");
    $datos = [
      "titulo" => "Administrativo Usuarios Modifica",
      "menu" => false,
      "admon" => true,
      "status" => $llaves,
      "errores" => $errores,
      "data" => $data
    ];
    $this->vista("admonUsuariosModificaVista",$datos);
  }
}

?>