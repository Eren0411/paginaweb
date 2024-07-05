<?php
require_once("modelos/model_publicaciones.php");

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
    <title>Web | Agregar Imágenes De Carrusel</title>
</head>

<body>
    <div class="carruselImg-container container shadow justify-content-center bg-dark-subtle mt-4">
        <h1 class="text-center carruselImg-heading">Imágenes del Carrusel</h1>
        <a class="btn btn-primary btn-carruselImg btn-lg d-relative" href="index.php?page=EdicionImgCarrusel">Agregar publicación</a>
        <div class="container mt-3 p-3 bg-white overflow-auto table-scroll rounded" style="max-height:600px;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Tarjeta 1 -->
                <?php
                foreach ($dtpublicaciones as $row) :
                    if ($row['Clave'] == "Carrusel") {
                ?>
                        <div class="col">
                            <div class="card carruselImg-card h-100">
                                <img src="data:<?php echo $row['TipoArchivoPub'] ?>;base64,<?php echo (base64_encode($row['ArchivoPub'])) ?>" alt="<?php echo $row['Titulo'] ?>" class="card-img-top edicionCarr-img" />
                                <div class="card-body card-body-bg center-flex">
                                    <!-- <h5 class="card-title"><?php //echo $row['Titulo'] 
                                                                ?></h5> -->
                                    <!-- <p class="overflow-hidden"><?php //echo $row['DescripcionPublicacion'] 
                                                                    ?></p> -->
                                    <div class="d-inline-flex">
                                        <a href="index.php?page=EdicionImgCarrusel&IdPublicacion=<?php echo $row['IdPublicacion'] ?>" class="btn btn-success btn-success-bg btn-sm">
                                            Actualizar
                                        </a>
                                    </div>
                                    <div class="d-inline-flex">
                                        <a href="index.php?page=ImgCarruselAdmin&actionpub=delete&IdPublicacion=<?php echo $row['IdPublicacion'] ?>" class="btn btn-danger btn-danger-bg btn-sm">
                                            Eliminar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
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