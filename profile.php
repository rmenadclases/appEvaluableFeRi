<!DOCTYPE html>
<html>
<head>
    <!-- Tus etiquetas meta y enlaces a hojas de estilo van aquí -->
</head>
<body>
    <h1>Bienvenido a tu perfil</h1>
  
    <div class="button-container">
        <?php
        session_start();
        
        if (isset($_SESSION["username"])) {
            $nombreDeUsuario = $_SESSION["username"];
            echo '<input type="text" id="username" name="username" placeholder="Nombre de Usuario" required class="username" value="' . $nombreDeUsuario . '"><br>';
        } else {
            echo 'No se ha iniciado sesión.';
        }
        ?>
    </div>

    <!-- Otras partes de tu página de perfil van aquí -->

</body>
</html>




<style>
   .centered-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
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

