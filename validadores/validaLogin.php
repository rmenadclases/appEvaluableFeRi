<?php
//include('../recogeryValidar.php');
//solFormLibre
$errores = [];
include('../libs/bGeneral.php');
//Si robamos la cookie de sesion podemos entrar con esa cookie

//Compruebo si se ha pulsado el botón del formulario LOGIN
if (isset($_REQUEST['bAceptar'])) {
    $correoElectronico = recoge("correoElectronico");
    $password = recoge("password");
    if (creayValidaConexion($correoElectronico, $password, "username/password", $errores)) {
        header("location:../plantilla/profile1.php?");
    } else {
        include('../plantilla/Login.html');
    }
}
?>