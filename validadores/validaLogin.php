<?php
include('../recogeryValidar.php');
$nombre = "";
$password = "";
//Compruebo si se ha pulsado el botón del formulario LOGIN
if (isset($_REQUEST['bAceptar'])) {

    $nombre = recoge("username");
    $password = recoge("password");
    //si el email recogido en la variable es igual a otro email que me creo yo en una variable
    //header location a la zona que quiera
    //si no ha sido correcto vuelvo a mostrar el formulario con un mensaje de error
    if (creayValidaConexion($nombre, $password, "username/password", $errores)) {
        header("location:../profile1.php?");
        $primeraVez = false;
    } else {
        // $errores["username/password"]="El usuario o la contraseña es incorrecta";
        include('../Login.html');
    }

}
?>