<?php
include('../config/config.php');

// Obtener el token de la base de datos
$token = isset($_GET['token']) ? $_GET['token'] : null;
$stmt = $pdo->prepare("SELECT * FROM tokens WHERE token = :token");
$stmt->bindParam(':token', $token);
$stmt->execute();
$tokenEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);
//Podria cerrar aquí
if ($tokenEncontrado) {
    // Verificar la duración en segundos
    $duracion = $tokenEncontrado['validez'];
    
    // Calcular la fecha de expiración sumando la duración a la fecha actual
    $fechaExpiracion = new DateTime();
    $fechaExpiracion->add(new DateInterval('PT' . $duracion . 'S'));

    $ahora = new DateTime();

    if ($fechaExpiracion > $ahora) {
        $id_usuario = $tokenEncontrado['id_user'];
        
        // Aquí puedes hacer lo que necesites con el token válido
        $stmt = $pdo->prepare("UPDATE usuario SET activo = 1 WHERE id_user = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        header("location: ../plantilla/Login.php"); // Redirige al usuario
    } else {
        echo "Token caducado.";
    }
} else {
    echo "Token no encontrado en la base de datos.";
}
?>
