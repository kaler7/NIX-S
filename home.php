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
            <h1><a class="logotext" href ="home.php"> NIX'S </a></h1>
        </div>
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" id="search-input" name="search" placeholder="Buscar...">
                <button type="submit">🔍</button>
            </form>
        </div>
        <div class="user-cart">
            <span>🛒</span>
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
            // Array simulado de productos
            $productos = [
                ['nombre' => 'DC Court Graffik', 'precio' => '$139.999', 'imagen' => 'imagenes/dc court graffik.jpg'],
                ['nombre' => 'DC Black Sabbath', 'precio' => '$999.999.999', 'imagen' => 'imagenes/dc black sabbath.jpg'],
                ['nombre' => 'Jordan 4 Retro', 'precio' => '$249.999', 'imagen' => 'imagenes/jordan4.avif'],
                ['nombre' => 'Nike Air', 'precio' => '$220.000', 'imagen' => 'imagenes/Nike-Air-Force-One-Low-Athletic-Club-Sail-Beige-Morado-Cafe-para-mujer-y-hombre-y-nino-Sneakers-online-tenis-zapatillas-shoes-en-colombia-en-oferta3.webp'],
                ['nombre' => 'Adidas Campus', 'precio' => '$220.000', 'imagen' => 'imagenes/adidas campus.jpg'],
                ['nombre' => 'Adidas Samba', 'precio' => '$220.000', 'imagen' => 'imagenes/adidas sambaaaaaaaaaaaaaaaaaa.png'],
                ['nombre' => 'Puma Suede XL', 'precio' => '$139.999', 'imagen' => 'imagenes/puma suede xl.jpg'],
                ['nombre' => 'Puma White', 'precio' => '$159.999', 'imagen' => 'imagenes/puma white.jfif'],
            ];

            // Obtener el término de búsqueda
            $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

            // Verificar si hay productos que mostrar
            if (empty($productos)) {
                echo '<p>No hay productos disponibles.</p>';
            } else {
                // Filtrar y mostrar productos
                foreach ($productos as $producto) {
                    if ($search === '' || strpos(strtolower($producto['nombre']), $search) !== false) {
                        echo '<div class="product">';
                        echo '<img src="' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
                        echo '<p>' . htmlspecialchars($producto['nombre']) . '<br><strong>' . htmlspecialchars($producto['precio']) . '</strong></p>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </main>
</body>
</html>
