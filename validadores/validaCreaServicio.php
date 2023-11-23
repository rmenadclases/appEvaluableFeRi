<?php

include('../libs/bGeneral.php');
include('../config/config.php');

$errores = [];
/**
Sólo pueden crear servicios los usuarios logueados

**/

// Compruebo si se ha pulsado el botón del formulario de crear cuenta
if (isset($_REQUEST['bServicio'])) {
    // Recoge los datos del formulario
    $titulo = recoge("titulo");
    $categoria = recogeArray("categoria");
    $descripcion = recoge("descripcion");
    $tipo = recoge("tipo");
    $precioPorHora = recoge("precio_por_hora");
    $ubicacion = recoge("ubicacion");
    $disponibilidad = recogeArray("servicios");
    /*
        La foto no se recoge así. No llega a $_REQUEST
    */
    $foto = recoge("foto");

    /*
    Hay que validar los datos
        */

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
        if (crearServicio($titulo, $categoria, $descripcion, $tipo, $precioPorHora, $ubicacion, $disponibilidad, $foto)) {
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
