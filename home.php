<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Nix's</title>
    <script src="https://kit.fontawesome.com/0984888a46.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="logo">
            <h1><a class="logotext" href="home.php"> NIX'S </a></h1>
        </div>
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" id="search-input" name="search" placeholder="Buscar...">
                <button type="submit">🔍</button>
            </form>
        </div>
        <div class="user-cart">
            <?php
            session_start();
            if (isset($_SESSION['usuario'])) {
                echo $_SESSION['usuario'];
            }
            ?>
            <span><a class="logotext" href="carrito.php">🛒</a></span>
            <a class="fa-solid fa-user" href="45-login/index.php"></a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#">HOMBRE</a></li>
            <li><a href="#">MUJER</a></li>
            <li><a href="#">NIÑOS/AS</a></li>
            <li><a href="#">SALE</a></li>
        </ul>
    </nav>
    <main>
        <div class="product-grid" id="product-grid">
            <?php
            // Inicializa el carrito si no existe
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            // Array simulado de productos
            $productos = [
                ['id' => 1, 'nombre' => 'DC Court Graffik', 'precio' => 139999, 'imagen' => 'imagenes/dc court graffik.jpg'],
                ['id' => 2, 'nombre' => 'DC Black Sabbath', 'precio' => 999999999, 'imagen' => 'imagenes/dc black sabbath.jpg'],
                ['id' => 3, 'nombre' => 'Jordan 4 Retro', 'precio' => 249999, 'imagen' => 'imagenes/jordan4.avif'],
                ['id' => 4, 'nombre' => 'Nike Air', 'precio' => 220000, 'imagen' => 'imagenes/Nike-Air-Force-One-Low-Athletic-Club-Sail-Beige-Morado-Cafe-para-mujer-y-hombre-y-nino-Sneakers-online-tenis-zapatillas-shoes-en-colombia-en-oferta3.webp'],
                ['id' => 5, 'nombre' => 'Adidas Campus', 'precio' => 220000, 'imagen' => 'imagenes/adidas campus.jpg'],
                ['id' => 6, 'nombre' => 'Adidas Samba', 'precio' => 220000, 'imagen' => 'imagenes/adidas sambaaaaaaaaaaaaaaaaaa.png'],
                ['id' => 7, 'nombre' => 'Puma Suede XL', 'precio' => 139999, 'imagen' => 'imagenes/puma suede xl.jpg'],
                ['id' => 8, 'nombre' => 'Puma White', 'precio' => 159999, 'imagen' => 'imagenes/puma white.jfif'],
            ];

            // Obtener el término de búsqueda
            $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

            // Filtrar y mostrar productos
            foreach ($productos as $producto) {
                if ($search === '' || strpos(strtolower($producto['nombre']), $search) !== false) {
                    echo '<div class="product">';
                    echo '<img src="' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
                    echo '<p>' . htmlspecialchars($producto['nombre']) . '<br><strong>$' . htmlspecialchars(number_format($producto['precio'], 0, ',', '.')) . '</strong></p>';
                    echo '<form method="GET" action="carrito.php">'; // Formulario para agregar al carrito
                    echo '<input type="hidden" name="action" value="add">';
                    echo '<input type="hidden" name="product_id" value="' . $producto['id'] . '">';
                    echo '<input type="hidden" name="price" value="' . $producto['precio'] . '">';
                    echo '<label for="quantity">Cantidad:</label>';
                    echo '<input type="number" name="quantity" min="1" value="1" required>'; // Campo de cantidad
                    echo '<button type="submit">Agregar al Carrito</button>'; // Botón de agregar
                    echo '</form>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </main>
</body>
</html>
