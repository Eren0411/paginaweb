<?php
require_once("modelos/model_productos.php");
// require_once("modelos/model_servicios.php");

$productsPerPage = 12; // Número de productos por página

if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    $currentPage = intval($_GET['p']);
} else {
    $currentPage = 1; // Página predeterminada
}

$startIndex = ($currentPage - 1) * $productsPerPage;
$endIndex = $startIndex + $productsPerPage;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Catálogo de Productos</title>
</head>

<body class="prod-body">
    <div class="productos-container">
        <!-- Barra de búsqueda y filtros -->
        <form action="index.php?page=Productos" method="post">

            <div class="productos-filter-bar">
                <input name="filter" type="text" class="producto-input" value="<?php echo $filter ?>"
                    placeholder="Buscar producto..." />
                <button class="producto-button">Buscar</button>
            </div>
        </form>

        <!-- Grid de productos -->
        <div class="productos-grid">
            <!-- Ejemplo de producto -->
            <?php
            foreach ($dtprodsview as $rows):
                ?>
                <div class="producto-item">
                <a class ="botonDetalleProd" href="index.php?page=DetalleProducto&IdProducto=<?php echo $rows['IdProducto'] ?>"><img src="data:<?php echo $rows['Tipo'] ?>;base64,<?php echo (base64_encode($rows['Archivo'])) ?>" alt="<?php echo $rows['Descripcion'] ?>" class="producto-image"></a>
                    <div class="producto-info">
                        <h2 class="producto-title"><?php echo $rows['NombreProducto'] ?></h2>
                        <p class="producto-description"><?php echo $rows['Descripcion'] ?></p>
                        <!-- <p class="producto-price">Precio: $XX.XX</p> -->
                    </div>
                </div>
                <?php
            endforeach;

            ?>
            <!-- <div class="producto-item">
                <img src="recursos\img\ASPEL-ICONO-VERT_COI-1.webp" alt="Producto" class="producto-image">
                <div class="producto-info">
                    <h2 class="producto-title">Nombre del Producto</h2>
                    <p class="producto-description">Descripción corta del producto...</p>
                    <p class="producto-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="producto-item">
                <img src="recursos\img\ASPEL-ICONO-VERT_COI-1.webp" alt="Producto" class="producto-image">
                <div class="producto-info">
                    <h2 class="producto-title">Nombre del Producto</h2>
                    <p class="producto-description">Descripción corta del producto...</p>
                    <p class="producto-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="producto-item">
                <img src="recursos\img\ASPEL-ICONO-VERT_COI-1.webp" alt="Producto" class="producto-image">
                <div class="producto-info">
                    <h2 class="producto-title">Nombre del Producto</h2>
                    <p class="producto-description">Descripción corta del producto...</p>
                    <p class="producto-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="producto-item">
                <img src="recursos\img\ASPEL-ICONO-VERT_COI-1.webp" alt="Producto" class="producto-image">
                <div class="producto-info">
                    <h2 class="producto-title">Nombre del Producto</h2>
                    <p class="producto-description">Descripción corta del producto...</p>
                    <p class="producto-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="producto-item">
                <img src="recursos\img\ASPEL-ICONO-VERT_COI-1.webp" alt="Producto" class="producto-image">
                <div class="producto-info">
                    <h2 class="producto-title">Nombre del Producto</h2>
                    <p class="producto-description">Descripción corta del producto...</p>
                    <p class="producto-price">Precio: $XX.XX</p>
                </div>
            </div> -->
            <!-- Repetir la estructura anterior para cada producto -->
        </div>
    </div>
</body>

</html>