<?php
require_once ("modelos/model_productos.php");
// require_once("modelos/model_marcas.php");
// require_once("modelos/model_tipoproducto.php");

if (isset($_GET['ins'])) {
    if ($_GET['ins'] == "Ok") {
        echo '<script>alert("Se inserto correctamente");</script>';
    }
} elseif (isset($_GET['upd'])) {
    if ($_GET['upd'] == "Ok") {
        echo '<script>alert("Se actualizo correctamente");</script>';
    }
} elseif (isset($_GET['del'])) {
    if ($_GET['del'] == "Ok") {
        echo '<script>alert("Se elimino correctamente");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Agregar Productos</title>
</head>


<body>
    <div class="carruselImg-container container shadow justify-content-center bg-dark-subtle mt-4">
        <h1 class="text-center carruselImg-heading">Productos</h1>
        <a class="btn btn-primary btn-carruselImg btn-lg d-relative" href="index.php?page=EdicionProductos">Agregar
            Producto</a>
        <div class="container mt-3 p-3 bg-white overflow-auto table-scroll rounded" style="max-height:600px;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                foreach ($dtprodsview as $rows):
                    ?>

                    <!-- Tarjeta 1 -->
                    <div class="col">
                        <div class="card carruselImg-card h-100">
                            <img src="data:<?php echo $rows['Tipo'] ?>;base64,<?php echo (base64_encode($rows['Archivo'])) ?>"
                                alt="<?php echo $rows['Descripcion'] ?>" class="card-img-top" />
                            <div class="card-body card-body-bg">
                                <div class="d-inline-flex">
                                    <a href="index.php?page=EdicionProductos&IdProducto=<?php echo $rows['IdProducto'] ?>"
                                        class="btn btn-success btn-success-bg btn-sm">
                                        Actualizar
                                    </a>
                                </div>
                                <div class="d-inline-flex">
                                    <a href="index.php?page=ProductosAdmin&actionprod=delete&IdProducto=<?php echo $rows['IdProducto'] ?>"
                                        class="btn btn-danger btn-danger-bg btn-sm">
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
                <!-- Tarjeta 2 -->
                <!-- <div class="col">
                    <div class="card carruselImg-card h-100">
                        <img src="https://via.placeholder.com/400x300" alt="Imagen Carrusel" class="card-img-top" />
                        <div class="card-body card-body-bg">
                            <div class="d-inline-flex">
                                <a href="#" class="btn btn-success btn-success-bg btn-sm">
                                    Actualizar
                                </a>
                            </div>
                            <div class="d-inline-flex">
                                <a href="#" class="btn btn-danger btn-danger-bg btn-sm">
                                    Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Tarjeta 3 -->
                <!-- <div class="col">
                    <div class="card carruselImg-card h-100">
                        <img src="https://via.placeholder.com/400x300" alt="Imagen Carrusel" class="card-img-top" />
                        <div class="card-body card-body-bg">
                            <div class="d-inline-flex">
                                <a href="#" class="btn btn-success btn-success-bg btn-sm">
                                    Actualizar
                                </a>
                            </div>
                            <div class="d-inline-flex">
                                <a href="#" class="btn btn-danger btn-danger-bg btn-sm">
                                    Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>