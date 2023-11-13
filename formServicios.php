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
                <a href="index1.html"><img src="./images/LogoTechSinFondoBlanco.png" alt="Logo" class="centered-logo"></a>
            </div>
            <h2>Formulario Alta Servicio</h2>
    <form action="profile1.php" method="get">
        <label for="titulo">Título*:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="categoria">Categoría*:</label>
        <div class="select-options">
        <select id="categoria" name="categoria" required>
            <option value="categoria1">Categoría 1</option>
            <option value="categoria2">Categoría 2</option>
            <option value="categoria3">Categoría 3</option>
        </select>
            <ul class="select_options">
                <li>Categoría 1</li>
                <li>Categoría 2</li>
                <li>Categoría 3</li>
            </ul>
        </div>
        

        <label for="descripcion">Descripción*:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="tipo">Tipo*:</label><br>
        <input type="radio" id="tipo_intercambio" name="tipo" value="intercambio" required>
        <label for="tipo_intercambio">Intercambio</label>
        <input type="radio" id="tipo_pago" name="tipo" value="pago" required>
        <label for="tipo_pago">Pago</label>
        <br>

        <label for="precio_por_hora">Precio por Hora (opcional):</label>
        <input type="number" id="precio_por_hora" name="precio_por_hora">

        <label for="ubicacion">Ubicación*:</label>
        <input type="text" id="ubicacion" name="ubicacion" required>

        <label for="disponibilidad">Disponibilidad*:</label>
        <p>
        <?php require_once './libs/componentes.php'; ?>                  
            <?php $servicios=array("Mañanas", "Tardes", "Noches", "Fines de Semana");?>                    
            <?php 
                if (!empty($servicios)) {
                    pintaCheck($servicios, "servicios");        
                } else {
                    echo '<p style="color:white;"> No hay servicios disponibles en este momento.</p>';
                }
             ?>                                                                                  
                         
        </p>

        <label for="foto">Foto del Servicio (opcional):</label>
        <input type="file" id="foto" name="foto">

        <input type="submit" value="Crear servicio">
    </form>
        </div>
    </div>
</body>
<style>
    body{
        text-align: center;
    }

    *{box-sizing: border-box;}

    h2{
    color: white;
    margin: auto;
    text-align: center;
    margin-top: 50px;
   }

   .container{
    display: flex;
    justify-content: center;
    align-items: center; 
    overflow:visible;
   }
   
   a{
    color: white;
   }

   .centered-logo{
    width: 120px;
    height: 120px;
   }

   form {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #fff;
}

input,
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #3498db;
    border-radius: 4px;
    background-color: transparent;
    color: white;
}

.custom-select {
    position: relative;
}

select {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.select-options {
    list-style: none;
    padding: 0;
    margin: 0;
    border: 1px solid #3498db;
    border-radius: 4px;
    background-color: transparent;
    color: white;
    position: relative;
    cursor: pointer;
}

.select-options li {
    padding: 10px;
    transition: background-color 0.3s;
}

.select-options li:hover {
    background-color: #3498db;
}

input[type="submit"] {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    border: 2px solid purple;
    background-color: transparent;
    color: white;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
    cursor: pointer;
}

input[type="file"] {
    display: inline-block;
    font-size: 12px;
    text-align: center;
    border: 2px solid #3498db;
    background-color: transparent;
    color: white;
    border-radius: 4px;
}

input[type="submit"]:hover {
    background-color: purple;
}

ul{
    list-style: none;
}

</style>
</html>