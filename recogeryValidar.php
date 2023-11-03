<?php
include ('./libs/bGeneral.php');
include ('./libs/componentes.php');
//cabecera();
$error = false;

// array donde almacenaremos el texto de los errores encontrados
$errores=[];
$nombre="";
$password="";
$userPrueba="rmenad";
$passWordPrueba="rmenad";

//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST['bAceptar'])) {
    include ("Login.html");
} else {    
    $nombre=recoge("username");
    $password=recoge("password");

    //Compruebo email y password
  


    //si el email recogido en la variable es igual a otro email que me creo yo en una variable
    //header location a la zona que quiera
    //si no ha sido correcto vuelvo a mostrar el formulario con un mensaje de error
        
    if(creayValidaConexion($nombre,$password,"username/password",$errores)){        
            header("location:pagina1.php?"); 
        }else{
            include('Login.html');
        
    }                   
}

//pie();
?>