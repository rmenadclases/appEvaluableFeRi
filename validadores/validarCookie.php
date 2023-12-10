<?php
if (isset($_REQUEST['btnAceptarCookies'])&& !isset($_COOKIE['cookieAceptada'])) {
    setcookie('cookieAceptada', 'aceptada', time() + 3600, '/');
    header('Location: ' . $_SERVER['HTTP_REFERER']);//Esto hace que devuelva a la página de donde ha sido llamada
    exit();
}else{
header('Location: ' . $_SERVER['HTTP_REFERER']);//Esto hace que devuelva a la página de donde ha sido llamada
exit();
}
?>