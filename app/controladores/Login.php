<?php

/**
 * @autor Javier Blanco Rodríguez
 * Código Proyecto Final DAW
 * Convocatoria: 2S – 2223
 * Profesor: Gotzon Valcarcel
 * */

 
/**
 * Controlador Login
 */
class Login extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("LoginModelo");
  }

  function caratula(){
    if(isset($_COOKIE["datos"])){
      $datos_array = explode("|",$_COOKIE["datos"]);
      $usuario = $datos_array[0];
      $clave = $datos_array[1];
      $data = [
        "usuario" => $usuario,
        "clave" => $clave,
        "recordar" => "on"
      ];
    } else {
      $data = [];
    }
    $datos = [
      "titulo" => "Login",
      "menu" => false,
      "data" => $data
    ];
    $this->vista("loginVista",$datos);
  }

  function olvido(){
    $errores = array();
    $data = array();
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $email = isset($_POST["email"])?$_POST["email"]:"";
      if ($email=="") {
        array_push($errores,"El correo es requerido");
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errores,"El correo electrónico no es válido");
      }
      if(count($errores)==0){
        if($this->modelo->validaCorreo($email)){
          array_push($errores,"El correo electrónico no existe en la base de datos");
        } else {
          if(!$this->modelo->enviarCorreo($email)){
            $datos = [
            "titulo" => "Cambio de clave de acceso",
            "menu" => false,
            "errores" => [],
            "data" => [],
            "subtitulo" => "Cambio de clave de acceso",
            "texto" => "Se ha enviado un correo a <b>".$email."</b> para que puedas cambiar tu clave de acceso. Cualquier duda te puedes comunicar con nosotros. No olvides revisar tu bandeja de spam.",
            "color" => "alert-success",
            "url" => "login",
            "colorBoton" => "btn-success",
            "textoBoton" => "Regresar"
            ];
            $this->vista("mensajeVista",$datos);
          } else {
            $datos = [
            "titulo" => "Error en el envío del correo",
            "menu" => false,
            "errores" => [],
            "data" => [],
            "subtitulo" => "Error en el envío del correo",
            "texto" => "Existió un problema al enviar el correo electrónico. Prueba por favor más tarde o comuníquese a nuestro servicio de soporte técnico.",
            "color" => "alert-danger",
            "url" => "login",
            "colorBoton" => "btn-danger",
            "textoBoton" => "Regresar"
            ];
            $this->vista("mensajeVista",$datos);
          }
        }
      }
    } else {
      $datos = [
      "titulo" => "Olvido de la contraseña",
      "menu" => false,
      "errores" => [],
      "data" => [],
      "subtitulo" => "¿Olvidaste tu contraseña?",
      ];
      $this->vista("loginOlvidoVista",$datos);
    }
    if(count($errores)){
      $datos = [
      "titulo" => "Olvido de clave de acceso",
      "menu" => false,
      "errores" => $errores,
      "subtitulo" => "¿Olvidaste tu contraseña?",
      "data" => []
      ];
      $this->vista("loginOlvidoVista",$datos);
    }
  }

  function registro(){
    $errores = array();
    $data = array();
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      $nombre = isset($_POST["nombre"])?$_POST["nombre"]:"";
      $apellidoPaterno = isset($_POST["apellidoPaterno"])?
      $_POST["apellidoPaterno"]:"";
      $apellidoMaterno = isset($_POST["apellidoMaterno"])?
      $_POST["apellidoMaterno"]:"";
      $email = isset($_POST["email"])?$_POST["email"]:"";
      $clave1 = isset($_POST["clave1"])?$_POST["clave1"]:"";
      $clave2 = isset($_POST["clave2"])?$_POST["clave2"]:"";
      $direccion = isset($_POST["direccion"])?$_POST["direccion"]:"";
      $ciudad = isset($_POST["ciudad"])?$_POST["ciudad"]:"";
      $comunidadautonoma = isset($_POST["comunidadautonoma"])?$_POST["comunidadautonoma"]:"";
      $estado = isset($_POST["estado"])?$_POST["estado"]:"";
      $codpos = isset($_POST["codpos"])?$_POST["codpos"]:"";
      $pais = isset($_POST["pais"])?$_POST["pais"]:"";
      $data = [
        "nombre"=>$nombre,
        "apellidoPaterno" => $apellidoPaterno,
        "apellidoMaterno" => $apellidoMaterno,
        "email" => $email,
        "clave1" => $clave1,
        "clave2" => $clave2,
        "direccion" => $direccion,
        "ciudad" => $ciudad,
        "comunidadautonoma" => $comunidadautonoma,
        "estado" => $estado,
        "codpos" => $codpos,
        "pais" => $pais
      ];
      //Validación
      if ($nombre=="") {
        array_push($errores,"El nombre es requerido");
      }
      if ($apellidoPaterno=="") {
        array_push($errores,"El apellido paterno es requerido");
      }
      if ($email=="") {
        array_push($errores,"El correo es requerido");
      }
      if ($clave1=="") {
        array_push($errores,"La clave de acceso es requerida");
      }
      if ($clave2=="") {
        array_push($errores,"La clave de acceso es de verificación es requerida");
      }
      if ($direccion=="") {
        array_push($errores,"La direccion es requerida");
      }
      if ($ciudad=="") {
        array_push($errores,"La ciudad es requerida");
      }
      if ($comunidadautonoma=="") {
        array_push($errores,"La Comunidad Autónoma es requerida");
      }
      if ($estado=="") {
        array_push($errores,"El estado es requerido");
      }
      if ($codpos=="") {
        array_push($errores,"El código postal es requerido");
      }
      if ($pais=="") {
        array_push($errores,"El país es requerido");
      }
      if ($clave1!=$clave2) {
        array_push($errores,"Las claves de acceso no coinciden");
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errores,"El correo electrónico no es válido");
      }
      if(count($errores)==0){
        $r = $this->modelo->insertarRegistro($data);
        if($r){
          $datos = [
          "titulo" => "Nuestra ilusión es levantarnos cada día para seguir un camino de servicio",
          "menu" => false,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Bienvenid@ a nuestra tienda",
          "texto" => "En nombre de nuestra empresa te damos la más sincera bienvenida a nuestra tienda virtual, en la que esperamos encontrarán todo lo que necesitas.<br><br>El objetivo principal de este canal de comunicación es plasmar los valores que nos respaldan: el compromiso por la salud visual, la máxima calidad y la voluntad de servicio, así como nuestro interés por todas aquellas ventajas que nos ofrece la tecnología. Todo ello tiene una presencia destacada en esta página web y en nuestras propias decisiones.<br><br>En 2023 comenzó una idea tan sencilla y a la vez tan responsable de crear esta tienda.<br><br>Sólo nos queda desearles un agradable experiencia en nuestra tienda.<br><br>Atentamente: Javier Blanco, CEO",
          "color" => "alert-success",
          "url" => "menu",
          "colorBoton" => "btn-success",
          "textoBoton" => "Iniciar"
          ];
          $this->vista("mensajeVista",$datos);
        } else {
          $datos = [
          "titulo" => "Error en el registro",
          "menu" => false,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Error en el registro",
          "texto" => "Existió un error en el registro, posiblemente ya existe ese correo en nuestra base de datos, por favor verifíquelo",
          "color" => "alert-danger",
          "url" => "login",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        }
      } else {
        $datos = [
        "titulo" => "Registro usuario",
        "menu" => false,
        "errores" => $errores,
        "data" => $data
        ];
        $this->vista("loginRegistroVista",$datos);
      }
    } else {
      $datos = [
      "titulo" => "Registro usuario",
      "menu" => false
      ];
      $this->vista("loginRegistroVista",$datos);
    } 
  }
  function cambiaclave($data){
    $errores = array();
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $id = isset($_POST["id"])?$_POST["id"]:"";
      $clave1 = isset($_POST["clave1"])?$_POST["clave1"]:"";
      $clave2 = isset($_POST["clave2"])?$_POST["clave2"]:"";
      //validaciones
      if ($clave1=="") {
        array_push($errores, "La clave de acceso es requerida");
      }
      if ($clave2=="") {
        array_push($errores, "La clave de acceso de verificación es requerida");
      }
      if ($clave1!=$clave2) {
        array_push($errores, "Las claves de acceso no coinciden");
      }
      if (count($errores)) {
        //si hay errores
        $datos = [
        "titulo" => "Cambia clave de acceso",
        "menu" => false,
        "errores" => $errores,
        "data" => $data
        ];
        $this->vista("loginCambiaClave",$datos);
      } else {
        //No hay errores
        if ($this->modelo->cambiarClaveAcceso($id, $clave1)) {
          $datos = [
          "titulo" => "Modificar clave de acceso",
          "menu" => false,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Modificar clave de acceso",
          "texto" => "La modificación de la clave de acceso fue exitosa. Bienvenido nuevamente.",
          "color" => "alert-success",
          "url" => "login",
          "colorBoton" => "btn-success",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        } else {
          $datos = [
          "titulo" => "Error al modificar la clave de acceso",
          "menu" => false,
          "errores" => [],
          "data" => [],
          "subtitulo" => "Error al modificar la clave de acceso",
          "texto" => "Existió un error al modificar la clave de acceso.",
          "color" => "alert-danger",
          "url" => "login",
          "colorBoton" => "btn-danger",
          "textoBoton" => "Regresar"
          ];
          $this->vista("mensajeVista",$datos);
        }
      }
    } else {
      $datos = [
      "titulo" => "Cambia clave de acceso",
      "menu" => false,
      "data" => $data
      ];
      $this->vista("loginCambiaClave",$datos);
    }
  }

  function verifica(){
    $errores = array();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $usuario = isset($_POST["usuario"])?$_POST["usuario"]:"";
      $clave = isset($_POST["clave"])?$_POST["clave"]:"";
      $recordar = isset($_POST["recordar"])?"on":"off";
      $errores = $this->modelo->verificar($usuario, $clave);

      //recuerdame
      $valor = $usuario."|".$clave;
      if($recordar=="on"){
        $fecha = time()+(60*60*24*7);
      } else {
        $fecha = time() - 1;
      }
      setcookie("datos",$valor,$fecha,RUTA);
      //
      $data = [
        "usuario" => $usuario,
        "clave" => $clave,
        "recordar" => $recordar
      ];
      //Validacion
      if (empty($errores)) {
        //Iniciamos sesión
        $data = $this->modelo->getUsuarioCorreo($usuario);
        $sesion = new Sesion();
        $sesion->iniciarLogin($data);
        //
        header("location:".RUTA."tienda");
      } else {
        $datos = [
          "titulo" => "Login",
          "menu" => false,
          "errores" => $errores,
          "data" => $data
        ];
        $this->vista("loginVista",$datos);
      }
    }
  }
}
?>