<!DOCTYPE html>
<html lang="en" class="height-full" data-a11y-animated-images="system" data-a11y-link-underlines="true"
    data-turbo-loaded="">

<head>
    <style type="text/css">
        .turbo-progress-bar {
            position: fixed;
            display: block;
            top: 0;
            left: 0;
            height: 3px;
            background: #0076ff;
            z-index: 2147483647;
            transition:
                width 300ms ease-out,
                opacity 150ms 150ms ease-in;
            transform: translate3d(0, 0, 0);
        }
    </style>

    <link crossorigin="anonymous" media="all" rel="stylesheet"
        href="https://github.githubassets.com/assets/primer-0cdc607a5517.css">
    <link crossorigin="anonymous" media="all" rel="stylesheet"
        href="https://github.githubassets.com/assets/signup-7e1ca87bf103.css">

    <link crossorigin="anonymous" media="all" rel="stylesheet"
        href="https://github.githubassets.com/assets/site-c93c61a95471.css">
    <link crossorigin="anonymous" media="all" rel="stylesheet"
        href="https://github.githubassets.com/assets/home-8b6943daec72.css">
</head>

<body >

    <div class="application-main d-flex flex-auto flex-column" data-commit-hovercards-enabled=""
        data-discussion-hovercards-enabled="" data-issue-and-pr-hovercards-enabled="">

        <main class="js-warp-hide bg-gray-dark-mktg d-flex flex-auto flex-column overflow-hidden position-relative">
            <div class="form-container signup-space">
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
            </div>

            <img src="https://github.githubassets.com/assets/hero-glow-f6eed469bca2.svg" alt="Glowing universe"
                class="js-warp-hide position-absolute overflow-hidden home-hero-glow events-none">
        </main>
    </div>


    <div class="container">
        <div class="signup-space">
            <div class="contenedorIzquierdo">
            </div>

            <h2>PERFIL</h2>
            <div class="scroll-container">
            <br>
            <form action="../validadores/guardarDatosPerfil.php" method="post" enctype="multipart/form-data">
                <?php
                session_start();
                $inactividad = 1800;
                $ip = $_SERVER['REMOTE_ADDR'];
                if($ip===$_SESSION['ip']){
               // Calcular el tiempo de vida de la sesión
               $vidaSesion = time() - $_SESSION["timeout"];
               if($vidaSesion > $inactividad){
               //echo "Sesion destruida</br>";
               session_unset();
               session_destroy();
               session_start();
               $_SESSION['sesionCaducada'] = 'Su sessión ha caducado';
               header("Location: ../plantilla/login.php");
               }
                }else{
                    session_unset();
               session_destroy();
               session_start();
               header("Location: ../plantilla/login.php");
                }
                           

 


                if (isset($_SESSION["nombreCompleto"])) {
                    $nombreCompleto = $_SESSION["nombreCompleto"];
                    echo '<p style="color: black;">Nombre completo: <input type="text" id="nombreCompleto" name="nombreCompleto" style="color: black;"  placeholder="nombreCompleto" required class="password" value="' . $nombreCompleto . '" readonly></p>';
                } else {
                    echo 'No se ha iniciado sesión.';
                }
                echo '<br>';
                if (isset($_SESSION["correoElectronico"])) {
                    $correoElectronico = $_SESSION["correoElectronico"];
                    echo '<p style="color: black;">Correo Electronico: <input type="text" id="correoElectronico" name="correoElectronico"style="color: black;" placeholder="correoElectronico" required class="password" value="' . $correoElectronico . '" readonly></p>';
                } else {
                    echo 'No se ha iniciado sesión.';
                }
                echo '<br>';
                if (isset($_SESSION["password"])) {
                    $password = $_SESSION["password"];
                    echo '<p style="color: black;">Contraseña: <input type="text" id="password" name="password" placeholder="password" style="color: black;" required class="password" value="' . $password . '" ></p>';
                } else {
                    echo 'No se ha iniciado sesión.';
                }
                echo '<br>';
                if (isset($_SESSION["descripcion"])) {
                    $descripcion = $_SESSION["descripcion"];
                    echo '<p style="color: black;">Descripcion: <input type="text" id="descripcion" name="descripcion" placeholder="descripcion" style="color: black;" required class="password" value="' . $descripcion . '" ></p>';
                    
                } else {
                    echo 'No se ha iniciado sesión.';
                }
                echo '<br>';
                //24/12                
                if (isset($_SESSION["foto"])) {
                    $imagen = $_SESSION["foto"];
                    echo '    <img src="' . $imagen . '" alt="Descripción de la imagen"  width="150" height="150" >';
                }
                
                echo '<br>';
                
                // Remove the semicolon and line break here
                ?>
            
                
                <br>;
                <label for="foto" style="color: black;">Cambair la foto de perfil:</label>
                 <br>;
                <input type="file" name="imagen" id="imagen" style="color: black;">
                
                <br>
                <?php
                echo '<br>';
                if (isset($_SESSION["idioma"])) {
                    $idioma = $_SESSION["idioma"];
                    echo '<p style="color: black;">Idiomas seleccionados: <input type="text" id="idioma" name="idioma"  required class="password" value="' . $idioma . '" readonly></p>';
                } else {
                    echo 'No seleccionó ningún idioma';
                }
                echo '<br>';
            
                ?>
                <p class="color">
                <?php require_once '../libs/componentes.php'; ?>                  
                        <?php $idiomas = array("Español", "Inglés", "Francés");                        
                             pintaCheck($idiomas, "idioma") ;                                                                                   
                         ?>
                </p>
               
                <?php

                echo '<br>';
                echo '<button name="bGuardar" style="background-color: white;"">Guardar</button>'
                    ?>
                     
            </form>
            <?php 
                   if (!isset($_COOKIE['cookieAceptada'])) {                  
                    echo '<div class="centrar">';
                    echo '<form method="post" action="../validadores/validarCookie.php">'; // Agrega un formulario
                    echo '<label id="labelCookies" for="btnAceptarCookies" style="color: white;">Haz clic para aceptar las cookies:</label>';
                    echo '<input id="btnAceptarCookies" name="btnAceptarCookies" type="submit" value="Aceptar">';
                    echo '</form>';
                    echo '</div>';
                }
                    ?>
                    <form method="post" action="../validadores/validarColor.php">
                <?php
               require_once '../libs/componentes.php';
               require_once '../recogeryValidar.php';
                echo '<div class="centrar">';
                echo pintaRadio($colores, "colores") . '</div>';
                ?>
                <input type="submit" value="Cambiar Color">
            </form>
        </div>
            </div>
        
    </div>
    
</body>
<script>
    function ocultarBoton() {
        document.getElementById('btnAceptar').style.display = 'none';
        document.getElementById('labelCookies').style.display='none';
        
    }
</script>
<style>
    .scroll-container {
        max-height: 400px;
        overflow-y: scroll;
        padding-right: 20px;
    }
    input{
        background-color: white;
        color:black;
    }
    label{
        color:black;
    }
    .centrarUno{
        display: flex;
        justify-content: center;

    }
    .centrar{
        margin-left: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        color:black;
        background-color:black;
    }
    .color{
        color:black;
    }
     body{
        background-color: white;
    }
   

    .contenedorIzquierdo {
        display: flex;
        justify-content: flex-end;
    }

    h2 {
        color: black;
        margin-left: 90px;
        text-align: center;
        padding-top: 50px;
        margin-top: 200px;
    }

    form {
        margin-left: 90px;
        text-align: center;


    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: visible;

    }

    .username {
        background-color: transparent;
        color: white;
    }

    .password {
        background-color: transparent;
        color: white;
    }

    a {
        color: white;
    }

    .centered-logo {
        width: 120px;
        height: 120px;
    }
</style>

</html>