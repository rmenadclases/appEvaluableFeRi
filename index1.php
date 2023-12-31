<!DOCTYPE html>
<html lang="en" class="height-full" data-a11y-animated-images="system" data-a11y-link-underlines="true"
    data-turbo-loaded="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <meta charset="UTF-8">
    <style>
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

    <div class="container">
        <div class="signup-space">
            <div class="centered-content">
                <h2></h2>
                <div class="services">
                    <div class="servicio">
                        <?php
                        $rutaArchivo = "./almacenamientoFicheros/servicios.txt";
                        if (is_file($rutaArchivo)) {
                            $servicios = file($rutaArchivo, FILE_IGNORE_NEW_LINES);
                           if(filesize($rutaArchivo)==0){
                                    echo "<p style='color:white;'>No hay servicios disponibles.</p>";                                
                            }else{
                                foreach ($servicios as $servicio) {
                                    $partes = explode(":", $servicio);
                                    if (!empty($partes) && trim($partes[0]) == "Título") {
                                        echo '<p style="color: white;">' . trim($partes[1]) . '</p>';
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <img src="./images/LogoTechSinFondoBlanco.png" alt="Logo" class="centered-logo">
                </div>
                
                    <div class="button-container">
                    <a href="./plantilla/Login.php"><button>Log in</button></a>
                    <a href="./plantilla/crearCuenta.php" ><button>Sing Up</button></a>
                </div>
                
            </div>
        </div>
    </div>
</body>

<style>
   .centered-content {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .services {
        margin-right: 20px; /* Ajusta según el espacio que desees entre los servicios y el logo */
    }

    .servicio {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        color: white;
    }

    h2 {
        color: white;
    }

    .form-container {
        text-align: center;
    }

    .centered-logo {
        background-color: transparent;
        max-width: 100%;
    }

    a {
        color: white;
    }
   
    .button-container {
    display: flex;
    gap: 60px; /* Puedes ajustar el valor según el espacio que desees entre los botones */
}
button{
    border: 5px ;
    width: 120px;
    color: white;
    background-color: transparent;
    font-size: 30px;
}
  
</style>

</html>