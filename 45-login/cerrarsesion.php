<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <form action="">
            <h1 class="title">Register</h1>
            <label>
                <i class="fa-solid fa-user"></i>
                <input placeholder="username" type="text" id="username">
            </label>
            <label>
                <i class="fa-solid fa-lock"></i>
                <input placeholder="password" type="password" id="password">
            </label>
            <button id="button">Crear sesión</button>
        </form>
        
        <a id="create-session-button" href="index.pxp">Iniciar sesión</a>
    </div>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixs";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>


</body>
</html>