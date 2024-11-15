<?php
session_start();

// Inicializa el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Función para limpiar el carrito
function limpiarCarrito() {
    $_SESSION['carrito'] = [];  // Vaciar el carrito
}

// Manejar acciones
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Agregar producto al carrito
    if ($action == 'add') {
        $product_id = $_GET['product_id'];
        $nombreProducto = $_GET['nombreProducto'];
        $price = $_GET['price'];
        $quantity = $_GET['quantity']; // Obtener cantidad del GET

        if (!isset($_SESSION['carrito'][$product_id])) {
            $_SESSION['carrito'][$product_id] = [
                'nombreProducto' => $nombreProducto,
                'price' => $price,
                'quantity' => $quantity,
            ];
        } else {
            $_SESSION['carrito'][$product_id]['quantity'] += $quantity; // Aumentar la cantidad
        }
    }

    // Eliminar producto del carrito
    if ($action == 'remove') {
        $product_id = $_GET['product_id'];
        unset($_SESSION['carrito'][$product_id]);
    }

    // Limpiar el carrito
    if ($action == 'clear') {
        limpiarCarrito();
        // Redirigir al carrito vacío para evitar duplicar la acción en la URL
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            if (isset($_SESSION['usuario'])) {
                echo $_SESSION['usuario'];
            }
            ?>
            <!-- Abre el modal de carrito cuando se hace clic en el icono -->
            <span><a class="logotext" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">🛒</a></span>
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
                ['id' => 1, 'nombre' => 'DC Court Graffik', 'precio' => 139999, 'imagen' => 'imagenes/dc court graffik.jpg'],
                ['id' => 2, 'nombre' => 'DC Black Sabbath', 'precio' => 250000, 'imagen' => 'imagenes/dc black sabbath.jpg'],
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
                    echo '<form method="GET">'; // Formulario para agregar al carrito
                    echo '<input type="hidden" name="action" value="add">';
                    echo '<input type="hidden" name="nombreProducto" value="'.htmlspecialchars($producto['nombre']).'">';
                    echo '<input type="hidden" name="product_id" value="' . $producto['id'] . '">';
                    echo '<input type="hidden" name="price" value="' . $producto['precio'] . '">';
                    echo '<label for="quantity">Cantidad:</label>';
                    echo '<input type="number" name="quantity" min="1" value="1" required>'; // Campo de cantidad
                    echo '<button class="btn btn-primary mt-2" type="submit">Agregar al Carrito</button>'; // Botón de agregar
                    echo '</form>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </main>

    <!-- Carrito -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Tu Carrito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    // Verifica si el carrito tiene productos
                    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                        echo '<ul>';
                        // Muestra los productos en el carrito
                        foreach ($_SESSION['carrito'] as $product_id => $item) {
                            echo '<li>';
                            echo $item['nombreProducto'] . ' - $' . number_format($item['price'], 0, ',', '.') . ' x ' . $item['quantity'];
                            echo ' <a href="?action=remove&product_id=' . $product_id . '" class="btn btn-danger btn-sm">Eliminar</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>No hay productos en el carrito.</p>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Aquí llamamos a la acción de limpiar el carrito -->
                    <a href="?action=clear" class="btn btn-primary">Comprar</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Información</h5>
                <ul>
                    <li><a href="#">Quiénes somos</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Redes Sociales</h5>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contacto</h5>
                <p>Email: ariel.kaleret36@gmail.com</p>
                <p>Teléfono: +54 11 9 27664413</p>
            </div>
        </div>
    </div>
    <div class="text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> Nix's. Todos los derechos reservados.</p>
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
