<?php
//Tratamiento de imagenes
$dir = "../imagenesUsuario"; //Sustituye pro el directorio actual
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

//Aqui incluimos los  datos de conexión a la BD
$db_hostname = "localhost";//Nombre máquina
$db_nombre = "evaluable_7w";//Nombre base de datos
//El usuario root núnca se puede usar, siempre cambiar por otro usuario
//Nosotros lo usaremos para que nos funcionen a todos los ejemplos y los ejercicios
  $db_usuario = "root";
  $db_clave = "";
  $pdo = new PDO('mysql:host=' . $db_hostname . ';dbname=' . $db_nombre . '', $db_usuario, $db_clave);
    // Realiza el enlace con la BD en utf-8
    //IMPORTANTE. Si no le decimos que lo haga en UTF8 no funciona correctamente
    $pdo->exec("set names utf8");
    //Accionamos el uso de excepciones
    //Lance errores y los lance como excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Si todo va bien en $pdo tendremos el objeto que gestionará la conexión con la base de datos.
?>