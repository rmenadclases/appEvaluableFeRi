<?php
include('../recogeryValidar.php');
include('../libs/bGeneral.php');
if (isset($_REQUEST['bGuardar'])) {
    $correo=recoge("correoElectronico");
    $password = recoge("password");
    $imagen = recoge("imagen");
    if (isset($_FILES['imagen'])) {
        $imagen = $_FILES['imagen']['name'];
    }
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
        if (creayValidaConexion2($correo,$password, "username/password", $errores,$idiomaString,$file,$descripcionPersonal)) {
           // $usuarios = $_SESSION['usuarios']; // Obtiene los datos de usuarios de la sesión
            header("Location: ../plantilla/profile1.php");          
            $primeraVez = false;
        } else {            
            include('../plantilla/crearCuenta.html');
        }
    }
}
?>