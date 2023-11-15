<?php
include('libs/bGeneral.php');
include('libs/componentes.php');
//cabecera();
$error = false;
$primeraVez = true;

// array donde almacenaremos el texto de los errores encontrados
$errores = [];
$idioma = [];

$userPrueba = "rmenad";
$passWordPrueba = "rmenad";
//Variables para recoger mas datos
$nombreCompleto = "";
$correoElectronico = "";
$fechaNacimiento = "";
$idiomas = array("español", "ingles", "chino");

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
    "jpeg",
    "png"
);

$usuarios = array();






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




/*
    if (isset($_REQUEST['cerrarSesion'])) {
    session_start();
    session_unset ();
    session_destroy();
    header("location: Login.html"); // Redirige al usuario
}
*/




//pie();
?>