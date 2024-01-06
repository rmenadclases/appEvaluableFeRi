<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado un color
    if (isset($_POST["colores"])) {
        $color = $_POST["colores"];
        
            if($color==="normal"){
                header("location: ../plantilla/modificarPerfil.php");
                exit(); // Asegurarse de que no se ejecute más código después de la redirección
            }else{
                $css =  htmlspecialchars($color) . ".php";
                // Redirigir a la misma página con un parámetro en la URL que indica el color seleccionado
                header("location: ../plantilla/modificarPerfil" . urlencode($css));
                exit(); // Asegurarse de que no se ejecute más código después de la redirección
            }
        }else{
            header("location: ../plantilla/modificarPerfil.php");
            exit(); // Asegurarse de que no se ejecute más código después de la redirección
        }
    }
?>