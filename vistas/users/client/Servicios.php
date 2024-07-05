<?php
require_once("modelos/model_servicios.php");

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
    <title>Web | Catálogo de Servicios</title>
</head>

<body class="servicios-body">
    <div class="servicios-container">
        <!-- Barra de búsqueda y filtros -->
        <form action="index.php?page=Servicios" method="post">

        <div class="servicios-filter-bar">
            <input name="filter" type="text" class="servicio-input" value="<?php echo $filter ?>" 
                placeholder="Buscar servicio...">
            <button class="servicio-button">Buscar</button>
        </div>
        </form>
        <!-- Grid de servicios -->
        <div class="servicios-grid">
            <!-- Ejemplo de servicio -->
            <?php
            foreach ($dtservview as $rows):
                ?>

                <div class="servicio-item">
                <img src="data:<?php echo $rows['Tipo'] ?>;base64,<?php echo (base64_encode($rows['Archivo'])) ?>" alt="<?php echo $rows['Descripcion'] ?>" class="servicio-image">
                <div class="servicio-info">
                    <h2 class="servicio-title"><?php echo $rows['NombreServicio'] ?></h2>
                    <p class="servicio-description"><?php echo $rows['Descripcion'] ?></p>
                    <!-- <p class="servicio-price">Precio: $XX.XX</p> -->
                </div>
            </div>
                <?php
            endforeach;
            ?>

            <!-- <div class="servicio-item">
                <img src="https://placehold.co/275x200" alt="Servicio" class="servicio-image">
                <div class="servicio-info">
                    <h2 class="servicio-title">Nombre del Servicio</h2>
                    <p class="servicio-description">Descripción corta del servicio...</p>
                    <p class="servicio-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="servicio-item">
                <img src="https://placehold.co/275x200" alt="Servicio" class="servicio-image">
                <div class="servicio-info">
                    <h2 class="servicio-title">Nombre del Servicio</h2>
                    <p class="servicio-description">Descripción corta del servicio...</p>
                    <p class="servicio-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="servicio-item">
                <img src="https://placehold.co/275x200" alt="Servicio" class="servicio-image">
                <div class="servicio-info">
                    <h2 class="servicio-title">Nombre del Servicio</h2>
                    <p class="servicio-description">Descripción corta del servicio...</p>
                    <p class="servicio-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="servicio-item">
                <img src="https://placehold.co/275x200" alt="Servicio" class="servicio-image">
                <div class="servicio-info">
                    <h2 class="servicio-title">Nombre del Servicio</h2>
                    <p class="servicio-description">Descripción corta del servicio...</p>
                    <p class="servicio-price">Precio: $XX.XX</p>
                </div>
            </div>
            <div class="servicio-item">
                <img src="https://placehold.co/275x200" alt="Servicio" class="servicio-image">
                <div class="servicio-info">
                    <h2 class="servicio-title">Nombre del Servicio</h2>
                    <p class="servicio-description">Descripción corta del servicio...</p>
                    <p class="servicio-price">Precio: $XX.XX</p>
                </div>
            </div> -->
            <!-- Repetir la estructura anterior para cada servicio -->
        </div>
    </div>
</body>

</html>