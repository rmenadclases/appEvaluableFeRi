<?php

session_start();
include('../libs/bGeneral.php');
include('../config/config.php');

$errores = [];

// Compruebo si se ha pulsado el botón del formulario de crear servicio
if (isset($_REQUEST['bServicio'])) {
    // Recoge los datos del formulario
    $titulo = recoge("titulo");
    $categoria = recoge("categoria");
    $descripcion = recoge("descripcion");
    $tipo = recoge("tipo");
    $precioPorHora = recoge("precio_por_hora");
    $ubicacion = recoge("ubicacion");
    $disponibilidad = recogeArray("servicios");
    
    // Validaciones
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

    //Validación y manejo de la imagen

       
    $imagen=cFile('foto',$errores,$extensionesValidas,$dir,$max_file_size,false);
   
    //Llama a la función para procesar y guardar el formulario
    if (empty($errores)) {
        
        $correoElectronico=$_SESSION['correoElectronico'];
        if ( crearServicio($titulo, $categoria, $descripcion, $tipo, $precioPorHora, $ubicacion, $disponibilidad, $imagen,$correoElectronico)) {
            header('Location:../plantilla/profile1.php');
            exit;    
        } else {
            header('Location:../plantilla/formServicios.php');
            exit;
        }        
    } else {
        include('../plantilla/formServicios.php');
    }
    
}
