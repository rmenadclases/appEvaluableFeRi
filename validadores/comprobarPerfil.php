<?php
 if (!isset($_REQUEST['btnAceptar'])) {   
    echo '<div class="centrar">';
    echo '<label id="labelCookies" for="btnAceptar" class="color">Haz clic para aceptar las cookies:</label>';
    echo '<input id="btnAceptar" name="btnAceptar" type="button" value="Aceptar" onclick="ocultarBoton();">';                               
} else {
    setcookie('cookiesAceptadas', 'cookiesAceptadas');
}
?>