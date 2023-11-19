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

            $file = cfile("imagen", $errores, $extensionesValidas, $dir, $max_file_size);
            if ($file == true) {
                $file = "../imagenesUsuario/dump.jpg";
            }
            if (creayValidaConexion1($nombre, $password, "username/password", $errores, $nombreCompleto, $correoElectronico, $file, $idiomaString)) {
                $usuarios = $_SESSION['usuarios']; // Obtiene los datos de usuarios de la sesión
                header("location: ../plantilla/Login.html"); // Redirige al usuario
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