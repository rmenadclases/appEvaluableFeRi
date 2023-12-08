<?php
//include('../recogeryValidar.php');
include('../libs/bGeneral.php');
include('../config/config.php');
$errores = [];
//Compruebo si se ha pulsado el botón del formulario de crear cuenta
if (isset($_REQUEST['bRegistro'])) {
    $nombre = recoge("username");
    $password = recoge("password");
    $nombreCompleto = recoge("nombreCompleto");
    $correoElectronico = recoge("correoElectronico");
    $fechaNacimiento = recoge("fecha");
    $imagen = recoge("imagen");
    $idioma = recogeArray("idioma");
    $descripcionPersonal = recoge("descripcion");

    $cValido = comprobarCorreo($correoElectronico, "correoElectronico", $errores);
    $cFecha = calcularFecha($fechaNacimiento, "fecha", $errores);
    if ($cValido && $cFecha == true) {
        // Realiza las acciones que deseas cuando al menos una de las validaciones es correcta
        if (!cCheck($idioma, "idiomas", $errores, $idioma, false)) { //REVISAR
            // $errores["idioma"] = "Error en la eleccion del idioma";
            $idiomaString = implode(" ", $idioma); //Convierto el array en STRING para poder crear la conexion
        } else {
            $idiomaString = implode(" ", $idioma); //Convierto el array en STRING para poder crear la conexion
            /*
                Sube imagen sólo si el resto de datos son correctos
                Solucionado, si no se seleccioan imagen , devuelve la imagen por defecto, 
                si se ha seleccioando la imagen, devuelve la ruta de la imagen subida
                */

            $file = cfile("imagen", $errores, $extensionesValidas, $dir, $max_file_size);            
            if (creayValidaConexion1($nombre, $password, "username/password", $errores, $nombreCompleto, $correoElectronico, $file, $idiomaString)) {
                $usuarios = $_SESSION['usuarios']; // Obtiene los datos de usuarios de la sesión
                header("location: ../plantilla/Login.php"); // Redirige al usuario
                $primeraVez = false;
            } else {
                //include('../crearCuenta.php');
                //include('../crearCuenta.php');
                include('../plantilla/crearCuenta.php');
            }
        }
    } else {
        include('../plantilla/crearCuenta.php');
    }
}

?>
