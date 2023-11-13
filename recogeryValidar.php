<?php
include('./libs/bGeneral.php');
include('./libs/componentes.php');
//cabecera();
$error = false;
$primeraVez = true;

// array donde almacenaremos el texto de los errores encontrados
$errores = [];
$idioma = [];
$nombre = "";
$password = "";
$userPrueba = "rmenad";
$passWordPrueba = "rmenad";
//Variables para recoger mas datos
$nombreCompleto = "";
$correoElectronico = "";
$fechaNacimiento = "";
$idiomas = array("español", "ingles", "chino");
//array para check de los servicios
$servicios=array("Mañanas", "Tardes", "Noches", "Fines de Semana");

//Tratamiento de imagenes
$dir = "./imagenesUsuario"; //Sustituye pro el directorio actual
/**
 * Tamaño máximo aceptado, si queremos que sea inferior al configurado en php.ini
 **/
$max_file_size = "200000";
/**
 * Creamos una lista de extensiones permitidas, por seguridad es lo más válido.
 */
$extensionesValidas = array(
    "jpg",
    "gif",
    "jpeg"
);

$usuarios = array();

//Compruebo si se ha pulsado el botón del formulario LOGIN
if (isset($_REQUEST['bAceptar'])) {

    $nombre = recoge("username");
    $password = recoge("password");
    //si el email recogido en la variable es igual a otro email que me creo yo en una variable
    //header location a la zona que quiera
    //si no ha sido correcto vuelvo a mostrar el formulario con un mensaje de error
    if (creayValidaConexion($nombre, $password, "username/password", $errores, $nombreCompleto, $correoElectronico)) {

        header("location:profile1.php?");
        $primeraVez = false;
    } else {
        // $errores["username/password"]="El usuario o la contraseña es incorrecta";
        include('Login.html');
    }

}

/*
    //si el email recogido en la variable es igual a otro email que me creo yo en una variable
    //header location a la zona que quiera
    //si no ha sido correcto vuelvo a mostrar el formulario con un mensaje de error
    $usuarios=array();
    if(creayValidaConexion($nombre,$password,"username/password",$errores,$nombreCompleto,$correoElectronico)){        
            header("location:profile1.php?"); 
            $primeraVez=false;
        }else{
            include('Login.html');
        
    }    
    */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Compruebo si se ha pulsado el botón del formulario de crear cuenta
if (isset($_REQUEST['bRegistro'])) {
    $nombre = recoge("username");
    $password = recoge("password");
    $nombreCompleto = recoge("nombreCompleto");
    $correoElectronico = recoge("correoElectronico");
    $fechaNacimiento = recoge("fecha");
    $imagen = recoge("imagen");
    $idioma=recogeArray("idioma");
  
    $descripcionPersonal=recoge("descripcion");
  




$cValido=comprobarCorreo($correoElectronico, "correoElectronico", $errores);
$cFecha=calcularFecha($fechaNacimiento, "fecha", $errores);
    if ($cValido && $cFecha==true) {
        // Realiza las acciones que deseas cuando al menos una de las validaciones es correcta
        if(!cCheck($idioma,"idiomas",$errores,$idioma,false)){
            $errores["idioma"] = "Error en la eleccion del idioma";
            $idiomaString = implode(" ", $idioma);//Convierto el array en STRING para poder crear la conexion
        }else{
            $idiomaString = implode(" ", $idioma);//Convierto el array en STRING para poder crear la conexion
        if ((!isset($_FILES['imagen'])) || ($_FILES['imagen']['error'] != 0)) {
            $errores["imagen"] = "Error en la imagen";
        } else {
            print_r($_FILES);
        }
        $file = cfile("imagen", $errores, $extensionesValidas, $dir, $max_file_size);
        if ($file == true) {
            $file = "./imagenesUsuario/dump.jpg";
        }
        if (creayValidaConexion1($nombre, $password, "username/password", $errores, $nombreCompleto, $correoElectronico, $file,$idiomaString)) {
            $usuarios = $_SESSION['usuarios']; // Obtiene los datos de usuarios de la sesión
            header("location: profile1.php"); // Redirige al usuario
            $primeraVez = false;
        } else {
            include('crearCuenta.php');
        }
        }
    } else {
        // Realiza las acciones que deseas cuando ambas validaciones son incorrectas
        include('crearCuenta.php');
    }
}




/*
    if (isset($_REQUEST['cerrarSesion'])) {
    session_start();
    session_unset ();
    session_destroy();
    header("location: Login.html"); // Redirige al usuario
}
*/

if (isset($_REQUEST['bCerrarSesion'])) {
    header("location: Login.html"); // Redirige al usuario
}
if (isset($_REQUEST['bGuardar'])) {
    $correo=recoge("correoElectronico");
    $password = recoge("password");
    $imagen = recoge("imagen");
    $idioma=recogeArray("idioma");
    $descripcionPersonal=recoge("descripcion");

    if(!cCheck($idioma,"idiomas",$errores,$idioma,false)){
        $errores["idioma"] = "Error en la eleccion del idioma";
        $idiomaString = implode(" ", $idioma);//Convierto el array en STRING para poder crear la conexion
    }else{
        $idiomaString = implode(" ", $idioma);//Convierto el array en STRING para poder crear la conexion
        if ((!isset($_FILES['imagen'])) || ($_FILES['imagen']['error'] != 0)) {
            $errores["imagen"] = "Error en la imagen";
        }
        $file = cfile($imagen, $errores, $extensionesValidas, $dir, $max_file_size);
        if ($file == false) {
            $file = "./imagenesUsuario/dump.jpg";
        }

        if (creayValidaConexion2($correo,$password, "username/password", $errores,$idiomaString,$file)) {
            $usuarios = $_SESSION['usuarios']; // Obtiene los datos de usuarios de la sesión
            header("location: profile1.php"); // Redirige al usuario
            $primeraVez = false;
        } else {
            include('crearCuenta.html');
        }


    }

}

//pie();
?>