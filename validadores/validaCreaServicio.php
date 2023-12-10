<?php

include('../libs/bGeneral.php');
include('../config/config.php');

$errores = [];

// Compruebo si se ha pulsado el botón del formulario de crear cuenta
if (isset($_REQUEST['bServicio'])) {
    // Recoge los datos del formulario
    $titulo = recoge("titulo");
    $categoria = recoge("categoria");
    $descripcion = recoge("descripcion");
    $tipo = recoge("tipo");
    $precioPorHora = recoge("precio_por_hora");
    $ubicacion = recoge("ubicacion");
    $disponibilidad = recogeArray("servicios");
    $imagen = recoge("imagen");

    //Manejo la carga de la foto
   /* $foto = $_FILES["foto"]["name"]; //aqui se obtiene el nombre de la foto
    $ruta_temporal = $_FILES["foto"]["tmp_name"]; //aqui se obtiene la ruta temporal
    $ruta_final = "../imagenesServicios" . basename($foto);*/
    

    // Realiza las validaciones necesarias en el archivo de validación
    if (empty($titulo)) {
        $errores["titulo"] = "El título es obligatorio.";
    }

    if (empty($descripcion)) {
        $errores["descripcion"] = "La descripción es obligatorio.";
    }

    if (empty($tipo)) {
        $errores["tipo"] = "Debes seleccionar el tipo.";
    }

    if (empty($precioPorHora)) {
        $errores["precioPorHora"] = "El precio por hora debe ser un número entero.";
    }

    if (empty($ubicacion)) {
        $errores["ubicacion"] = "La ubicación es obligatorio.";
    }

    if (empty($disponibilidad)) {
        $errores["disponibilidad"] = "Debes seleccionar al menos una disponibilidad.";
    }

    if (empty($errores)) {
        // Realiza las acciones que deseas cuando todas las validaciones son correctas
        // Llama a la función para procesar y guardar el formulario
        if ($_FILES['imagen']['error'] != 0) {
            $errores["imagen"] = "Error en la imagen";
        }
        $file = cfile($imagen, $errores, $extensionesValidas, $dir, $max_file_size);
        if ($file == false) {
            $file = "../imagenesUsuario/dump.jpg";
        }
        if (crearServicio($titulo, $categoria, $descripcion, $tipo, $precioPorHora, $ubicacion, $disponibilidad, $file)) {
            header('location:../plantilla/profile1.php');
        } else {
            include('location:../plantilla/formServicios.php');
        }
    } else {
        // Si hay errores en la validación, muestra el formulario con los errores
        include('../plantilla/formServicios.php');
    }
}
    
?>
