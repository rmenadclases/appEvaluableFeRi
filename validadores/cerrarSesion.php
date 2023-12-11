<?php
    session_start(); // este por si no la has iniciado en la pagina que planeas destruirla, de lo contrario no te destruirá nada
    session_destroy();
    session_unset();
    //Elimino la cookie para hacer pruebas
    setcookie('cookieAceptada', 'aceptada', time() -3600, '/');
    header("location: ../plantilla/Login.php"); // Redirige al usuario

?>