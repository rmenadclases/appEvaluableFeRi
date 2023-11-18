<?php
//Tratamiento de imagenes
$dir = "./imagenesUsuario"; //Sustituye pro el directorio actual
/**
 * Tamaño máximo aceptado, si queremos que sea inferior al configurado en php.ini
 **/
$max_file_size = "200000";
/**
 * Creamos una lista de extensiones permitidas, por seguridad es lo más válido.
 */
$extensionesValidas = array(
    "jpg",
    "jpeg",
    "png"
);
?>