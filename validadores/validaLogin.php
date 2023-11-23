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
         //Ponemos a time() el contador de inactividad
        header("location:../plantilla/profile1.php?");
    } else {
        $archivo="../almacenamientoFicheros/logLogin.txt";
        if (is_file($archivo)) {
            // Abre el archivo en modo de lectura y escritura
            $escribir = fopen($archivo, "a+");            
            // Mueve el puntero al principio del archivo
            fseek($escribir, 0);            
           
            
            $fecha_actual = date("Y-m-d H:i:s");
            fwrite($escribir, "Correo: ".$correoElectronico  . " Contraseña: ".$password ." ".$fecha_actual . PHP_EOL); 
            fclose($escribir);
        }

        include('../plantilla/Login.html');
    }
}

?>