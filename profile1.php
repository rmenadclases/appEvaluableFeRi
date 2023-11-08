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

<body class="logged-out env-production page-responsive height-full d-flex flex-column header-overlay intent-mouse"
    style="overflow-wrap: break-word; background-image: url('https://github.githubassets.com/assets/hero-glow-f6eed469bca2.svg'); background-size: cover;" cz-shortcut-listen="true">

    <div class="application-main d-flex flex-auto flex-column" data-commit-hovercards-enabled=""
        data-discussion-hovercards-enabled="" data-issue-and-pr-hovercards-enabled="">

        <main class="js-warp-hide bg-gray-dark-mktg d-flex flex-auto flex-column overflow-hidden position-relative">
            <div class="form-container signup-space">
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class "signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
            </div>

            <img src="https://github.githubassets.com/assets/hero-glow-f6eed469bca2.svg" alt="Glowing universe"
                class="js-warp-hide position-absolute overflow-hidden home-hero-glow events-none">
        </main>
    </div>
    

     <div class="container" >
        <div class="signup-space">
            <div class="contenedorIzquierdo">
            <a href="modificarPerfil.php"> <button style="background-color: white;" >Modificar Perfil</button></a>'
           <button style="background-color: white; name='cServicios'" >Crear servicio</button>'
            </div>
            
            <h2>PERFIL</h2>
            <br>
            <form action="recogeryValidar.php" method="post">
            <?php
        session_start();
        if (isset($_SESSION["nombreCompleto"])) {
            $nombreCompleto= $_SESSION["nombreCompleto"];
            echo '<p style="color: white;">Nombre completo: <input type="text" id="nombreCompleto" name="nombreCompleto" placeholder="nombreCompleto" required class="password" value="' . $nombreCompleto . '" readonly></p>';        
        } else {
            echo 'No se ha iniciado sesión.';
        }
        if (isset($_SESSION["username"])) {
            $nombreDeUsuario = $_SESSION["username"];
            echo '<p style="color: white;">Nombre usuario: <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required class="username" value="' . $nombreDeUsuario . '" readonly></p>';        
        } else {
            echo 'No se ha iniciado sesión.';
        }
        if (isset($_SESSION["correoElectronico"])) {
            $correoElectronico= $_SESSION["correoElectronico"];
            echo '<p style="color: white;">Correo Electronico: <input type="text" id="correoElectronico" name="correoElectronico" placeholder="correoElectronico" required class="password" value="' . $correoElectronico . '" readonly></p>';        
        } else {
            echo 'No se ha iniciado sesión.';
        }
        if (isset($_SESSION["password"])) {
            $password = $_SESSION["password"];
            echo '<p style="color: white;">Contraseña: <input type="text" id="password" name="password" placeholder="password" required class="password" value="' . $password . '" readonly></p>';        
        } else {
            echo 'No se ha iniciado sesión.';
        }
        if (isset($_SESSION["foto"])) {
            $imagen = $_SESSION["foto"];
            echo '    <img src="' . $imagen . '" alt="Descripción de la imagen"  width="150" height="150" >';
        } else {
            echo 'No hay imagen';
        }
        if (isset($_SESSION["idioma"])) {
            $idioma = $_SESSION["idioma"];
            echo '<p style="color: white;">Idiomas seleccionados: <input type="text" id="idioma" name="idioma"  required class="password" value="' . $idioma . '" readonly></p>';        
        } else {
            echo 'No seleccionó ningún idioma';
        }
        echo '<br>';
       echo '<button name="bCerrarSesion" style="background-color: white;"">Cerrar sesión</button>'
        ?>
            </form>
        </div>
    </div>
</body>

<style>
    .contenedorIzquierdo{
        display: flex;
        justify-content: flex-end;
    }
   h2{
    color: white;
    margin-left: 90px;
    text-align: center;
    padding-top: 50px;
    margin-top: 200px;
   }
   form{
    margin-left: 90px;
    text-align: center;
    

   }
   .container{
    display: flex;
    justify-content: center;
    align-items: center;
    overflow:visible;
    
   }
   .username{
    background-color: transparent;
    color: white;
   }
   .password{
    background-color: transparent;
    color: white;
   }
   a{
    color: white;
   }
   .centered-logo{
    width: 120px;
    height: 120px;
   }
</style>

</html>
