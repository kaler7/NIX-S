<?php
include("../bd.php"); // Asegúrate de que este archivo sea accesible

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];

    // Prepara la consulta SQL
    $sql = "INSERT INTO usuarios (usuario, contraseña) VALUES (:usuario, :contrasena)";
    $stmt = $conn->prepare($sql);

    // Asigna los parámetros
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contraseña); // Asegúrate de que la contraseña sea la misma

    // Intenta ejecutar la consulta
    try {
        if ($stmt->execute()) {
            echo "Usuario registrado correctamente.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null; // Cierra la conexión
?>
