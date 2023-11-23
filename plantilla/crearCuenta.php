<!DOCTYPE html>
<html lang="en" class="height-full" data-a11y-animated-images="system" data-a11y-link-underlines="true"
    data-turbo-loaded="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
               
               
               
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
                <div class="signup-stars"></div>
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
            <h2>Crea tu cuenta</h2>
            <br>
            
                
            <form action="../validadores/validaCrearCuenta.php" method="post" enctype="multipart/form-data">
                <?php if (isset($errores['username'])): ?>
                <p class="errores"><?= $errores['username'] ?></p><br>
                <?php endif; ?>
                <br>
                <input type="text" id="nombreCompleto" name="nombreCompleto" placeholder="Nombre Completo" required class="username"><br>
                <input type="text" id="correoElectronico" name="correoElectronico" placeholder="Correo Electronico" required class="username"><br>
                <?php if (isset($errores['correoElectronico'])): ?>
                <p class="errores"><?= $errores['correoElectronico'] ?></p><br>
                <?php endif; ?>
                <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required class="username"><br>
                
                <?php if (isset($errores['username/password'])): ?>
                <br>
               <p class="errores"><?= $errores['username/password'] ?></p><br>
               <?php endif; ?>

                <input type="password" id="password" name="password" placeholder="Password" required class="password"><br>
                <br>
                <label for="fecha" class="username" >Selecciona una fecha:</label>
                <br>
                <input type="date" name="fecha" id="fecha" required>
               <br>
               <?php if (isset($errores['fecha'])): ?>
                <br>
               <p class="errores"><?= $errores['fecha'] ?></p><br>
               <?php endif; ?>
               <br>    
                <label for="foto" style="color: white;">Selecciona una foto de perfil:</label>                
                <input type="file" name="imagen" id="imagen"  style="color: white;">
                
                <br>
                <br>
                
                <ul>
                    <span style="color: white;">Selecciona el idioma preferente</span>
                    <br>
                    <p class="errores">
                    <?php require_once '../libs/componentes.php'; ?>                  
                        <?php $idiomas = array("Español", "Inglés", "Francés");                        
                             pintaCheck($idiomas, "idioma") ;                                                                                   
                         ?>
                       </p>                                                 
                </ul>
                <br>
                <label for="descripcion">Descripción personal:</label>
                <br>
                <textarea id="descripcion" name="descripcion" rows="4" cols="50" placeholder="Escribe aquí..."></textarea>
                <br>
                <a href="Login.html">Ya tienes cuenta?Iniciar Sesion</a>
                <br>
                <br>
                <button type="submit" name="bRegistro" value="aceptar">Crear cuenta</button>
                
                
            </form>
        </div>
    </div>
</body>

<style>
    
        body {
    overflow-x: auto; /* Permite el desplazamiento horizontal */
    white-space: nowrap; /* Evita que el contenido se rompa al ajustar el ancho */
    max-width: 100%; /* Limita el ancho máximo del contenido al tamaño de la ventana */
    

}
form{
    display: block;
  height: 200px;
  overflow-y: scroll;
  scroll-behavior: smooth;
}
    
    .errores{
        color: red;
    }
    span{
        font-size: 20px;
    }
    input{
        
        margin-left: 20px;
    }
    label{
        color: white;
        
    }
   h2{
    color: white;
    margin-left: 90px;
    text-align: center;
    padding-top: 0px;
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
