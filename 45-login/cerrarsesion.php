<?php
include("../bd.php");
?>
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
        <form action="registro.php" method="POST">
            <h1 class="title">Register</h1>
            <label>
                <i class="fa-solid fa-user"></i>
                <input placeholder="username" name="username" type="text" id="username" required>
            </label>
            <label>
                <i class="fa-solid fa-lock"></i>
                <input placeholder="password" type="password" id="password" name="password" required>
            </label>
            <button id="button">Crear sesión</button>
        </form>
        
        <a id="create-session-button" href="index.php">Iniciar sesión</a>
        <a id="create-session-button" href="../home.php">Home</a>
    </div>
    


</body>
</html>