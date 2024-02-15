<?php

 /* Ejecutando este fichero crearemos la BD en nuestro servidor de BD.
 * Los datos de conexión son los siguientes, comprueba que coinciden con los tuyos, sino no funcionará.
 * Los leeremos de config.php
 * 
 * */
 $db_hostname = "localhost";
 $db_nombre = "evaluable_7w";
 $db_usuario = "root";
 $db_clave = "";
 

 //En config.php tenemos los valores de conexión a la BD
//include ('config.php');
try {
    /*
     * Conectamos
     * No le pasamos nombre de BD porque vamos a crearla
     */
    $pdo = new PDO('mysql:host='.$db_hostname, $db_usuario, $db_clave);
    //UTF8  
    $pdo->exec("set names utf8");
    // Accionamos el uso de excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Leemos el fichero que contiene el sql
    $sqlBD = file_get_contents("evaluable_7w.sql");//Leemos un .sql -->
    //Ejecutamos la consulta
    $pdo->exec($sqlBD);//-->Ejecutamos el archivo .sql
    echo ("La BD ha sido creada");
    //Cerramos conexion
    $pdo = null;
} catch (PDOException $e) {
    // En este caso guardamos los errores en un archivo de errores log
    error_log($e->getMessage() . "## Fichero: " . $e->getFile() . "## Línea: " . $e->getLine() . "##Código: " . $e->getCode() . "##Instante: " . microtime() . PHP_EOL, 3, "logBD.txt");
    // guardamos en ·errores el error que queremos mostrar a los usuarios
    $errores['datos'] = "Ha habido un error <br>";
}
?>