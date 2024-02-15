<?php
if(!isset($_SESSION)){
    session_start();
    // Resto de tu código...
}
require_once '../libs/bGeneral.php';



?>
<!DOCTYPE html>
<html lang="en" class="height-full" data-a11y-animated-images="system" data-a11y-link-underlines="true"
    data-turbo-loaded="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>

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
            <div class="logo-container">   
                
                
                <a href="../index1.php"><img src="../images/LogoTechSinFondoBlanco.png" alt="Logo" class="centered-logo"></a>
            </div>
            <h2>Login</h2>
            <br>
            <form action="../validadores/validaLogin.php" method="post">
                <?php if (isset($errores['username/password'])): ?>
                <p class="errores"><?= $errores['username/password'] ?></p><br>
                <?php endif; ?>
                <input type="text" id="correoElectronico" name="correoElectronico" placeholder="correoElectronico" required class="username"><br>
                <input type="password" id="password" name="password" placeholder="Password" required class="password"><br>
                <br>
                <a href="../plantilla/crearCuenta.php">No tienes cuenta aún?</a>
                <br>
                <br>
                <button type="submit" name="bAceptar" value="aceptar">Entrar</button>
                <?php
                if (isset($_SESSION['sesionCaducada'])): ?>
                <p class="errores"><?=$_SESSION['sesionCaducada']?></p><br>
                <?php endif; ?>
                <?php
                if  (isset($errores['errorBD'])): ?>
                <p class="errores"><?=$errores['errorBD']?></p><br>
                <?php endif; ?>
                <?php
                if  (isset($errores['mensajeCorreo'])): ?>
                <p class="errores"><?=$errores['mensajeCorreo']?></p><br>
                <?php endif; ?>

                
            </form>
        </div>
    </div>
</body>

<style>
    .errores{
        color: red;
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
