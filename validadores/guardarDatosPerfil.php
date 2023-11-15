<?php
include('../recogeryValidar.php');
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
            $file = "../imagenesUsuario/dump.jpg";
        }

        if (creayValidaConexion2($correo,$password, "username/password", $errores,$idiomaString,$file)) {
            $usuarios = $_SESSION['usuarios']; // Obtiene los datos de usuarios de la sesión
            header("location: ../profile1.php"); // Redirige al usuario
            $primeraVez = false;
        } else {
            include('../crearCuenta.html');
        }


    }

}
?>