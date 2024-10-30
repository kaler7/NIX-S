<?php
include("../bd.php"); // Asegúrate de que este archivo sea accesible
session_start();

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];

    // Prepara la consulta SQL para buscar al usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    // Verifica si el usuario existe
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica la contraseña (asegúrate de que esté hasheada en el registro)
        if ($row['contraseña'] === $contraseña) {
            // La contraseña es correcta, inicia sesión
            $_SESSION['user_id'] = $row['id']; // Almacena el ID del usuario en la sesión
            $_SESSION['usuario'] = $row['usuario']; // Almacena el nombre de usuario en la sesión

            
            // Redirige a la página de inicio (o a la que desees)
            header("Location: ../home.php");
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado.";
    }

    // Cierra la conexión
    $conn = null; 
}
?>