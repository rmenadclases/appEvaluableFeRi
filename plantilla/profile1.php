<!DOCTYPE html>
<html lang="en" class="height-full" data-a11y-animated-images="system" data-a11y-link-underlines="true" data-turbo-loaded="">

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

    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/primer-0cdc607a5517.css">
    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/signup-7e1ca87bf103.css">

    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/site-c93c61a95471.css">
    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/home-8b6943daec72.css">
</head>

<body class="logged-out env-production page-responsive height-full d-flex flex-column header-overlay intent-mouse" style="overflow-wrap: break-word; background-image: url('https://github.githubassets.com/assets/hero-glow-f6eed469bca2.svg'); background-size: cover;" cz-shortcut-listen="true">

    <div class="application-main d-flex flex-auto flex-column" data-commit-hovercards-enabled="" data-discussion-hovercards-enabled="" data-issue-and-pr-hovercards-enabled="">

        <main class="js-warp-hide bg-gray-dark-mktg d-flex flex-auto flex-column overflow-hidden position-relative">
            <div class="form-container signup-space">
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
                <div class="signup-stars"></div>
            </div>

            <img src="https://github.githubassets.com/assets/hero-glow-f6eed469bca2.svg" alt="Glowing universe" class="js-warp-hide position-absolute overflow-hidden home-hero-glow events-none">
        </main>
    </div>


    <div class="container">
        <div class="signup-space">
            <div class="logo-btns">
                <div class="logo-container">
                    <a href="../index1.html"><img src="../images/LogoTechSinFondoBlanco.png" alt="Logo" class="centered-logo"></a>
                </div>
                <div class="contenedorIzquierdo">
                    <a href="../plantilla/modificarPerfil.php"> <button style="background-color: white;">Modificar Perfil</button></a>
                    <a href="../plantilla/formServicios.php"><button style="background-color: white; name='cServicios'">Crear servicio</button></a>
                </div>
            </div>
            <div class="form-container">
                <div class="profile-form">
                    <h2>SERVICIOS</h2>
                    <div class="servicio">
                    <?php
                    //aquí mostramos los títulos de los servicios que se han creado en el archivo servicios.txt
                    $rutaArchivo = "../almacenamientoFicheros/servicios.txt";

                    if (is_file($rutaArchivo)) {
                        $servicios = file($rutaArchivo, FILE_IGNORE_NEW_LINES);

                        foreach ($servicios as $servicio) {
                            //Dividimos la línea del servicio en partes usando el separador ":"
                            $partes = explode(":", $servicio);
                            //Comprobamos si hay partes y si la primera parte es el Título
                            if (!empty($partes) && trim($partes[0]) == "Título") {
                                echo '<p style="color: white;">' . trim($partes[1]) . '</p>';
                            }
                        }
                    } else {
                        echo '<p style="color:white;">No hay servicios disponibles. Debes crear uno</p>';
                    }
                    ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

<style>
    .contenedorIzquierdo {
        display: flex;
        justify-content: flex-end;
    }

    .logo-btns {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .form-container {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-between;
        width: 50%;
        margin: auto;
    }

    .profile-form,
    .servicio {
        width: 48%;
        margin: auto;
    }

    .servicio{
        background-color: rgba(255, 255, 255, 0.1); /*ajustar el alpha según sea necesario*/
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        color: white;
    }

    h2 {
        color: white;
        margin-left: 90px;
        text-align: center;
        padding-top: 50px;
        margin-top: 65px;
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