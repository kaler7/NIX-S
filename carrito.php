<?php
session_start();

// Inicializa el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Manejar acciones
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Agregar producto
    if ($action == 'add') {
        $product_id = $_GET['product_id'];
        $price = $_GET['price'];
        $quantity = $_GET['quantity']; // Obtener cantidad del GET

        if (!isset($_SESSION['carrito'][$product_id])) {
            $_SESSION['carrito'][$product_id] = [
                'price' => $price,
                'quantity' => $quantity,
            ];
        } else {
            $_SESSION['carrito'][$product_id]['quantity'] += $quantity; // Aumentar la cantidad
        }
    }

    // Eliminar producto
    if ($action == 'remove') {
        $product_id = $_GET['product_id'];
        unset($_SESSION['carrito'][$product_id]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Carrito</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1><a class="logotext" href="home.php"> NIX'S </a></h1>
        </div>
        <div class="user-cart">
            <span>🛒</span>
            <a class="fa-solid fa-user" href="45-login/index.php"></a>
        </div>
    </header>
    
    <main>
        <h1>Carrito de Compras</h1>
        <ul>
            <?php if (empty($_SESSION['carrito'])): ?>
                <li>El carrito está vacío.</li>
            <?php else: ?>
                <?php 
                $totalGeneral = 0; // Inicializa el total general
                foreach ($_SESSION['carrito'] as $product_id => $item): 
                    $totalPrecio = $item['price'] * $item['quantity']; // Calcula el total por producto
                    $totalGeneral += $totalPrecio; // Acumula el total general
                ?>
                    <li>
                        Producto ID: <?php echo $product_id; ?> - Precio Unitario: $<?php echo number_format($item['price'], 0, ',', '.'); ?> - 
                        Cantidad: <?php echo $item['quantity']; ?> - Precio Total: $<?php echo number_format($totalPrecio, 0, ',', '.'); ?>
                        <a href="carrito.php?action=remove&product_id=<?php echo $product_id; ?>">Eliminar</a>
                    </li>
                <?php endforeach; ?>
                <li><strong>Total General: $<?php echo number_format($totalGeneral, 0, ',', '.'); ?></strong></li> <!-- Muestra el total general -->
            <?php endif; ?>
        </ul>
        
        <a href="home.php">Seguir comprando</a>
    </main>
</body>
</html>
