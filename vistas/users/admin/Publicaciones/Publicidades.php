<?php
require_once ("modelos/model_publicaciones.php");

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
    <title>Web | Imágenes de Publicidad</title>
</head>

<body>

    <div class="carruselImg-container container shadow justify-content-center bg-dark-subtle mt-4">
        <h1 class="text-center carruselImg-heading">Imágenes de Publicidad</h1>
        <a class="btn btn-primary btn-carruselImg btn-lg d-relative" href="index.php?page=EdicionPublicidad">Agregar
            Publicación</a>

        <div class="container mt-3 p-3 bg-white overflow-auto table-scroll rounded" style="max-height:600px;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Tarjeta 1 -->
                <?php
                foreach ($dtpublicaciones as $row):
                    if ($row['Clave'] == "Publicidad") {
                        ?>
                        <div class="col">
                            <div class="card carruselImg-card h-100">
                                <img src="data:<?= $row['TipoArchivoPub'] ?>;base64,<?php echo (base64_encode($row['ArchivoPub'])) ?>"
                                    alt="<?= $row['Titulo'] ?>" class="card-img-top" />
                                <div class="card-body card-body-bg">
                                    <h5 class="card-title"><?= $row['Titulo'] ?></h5>
                                    <div class="mb-3">
                                    <p class="overflow-hidden" style="max-height:100px;">
                                        <?= $row['DescripcionPublicacion'] ?>
                                        </p>
                                        <span class="text-muted"><?= $row['NombreSistema'] ?></span>
                                    </div>
                                    <div class="d-inline-flex">
                                        <a href="index.php?page=EdicionPublicidad&IdPublicacion=<?php echo $row['IdPublicacion'] ?>"
                                            class="btn btn-success btn-success-bg btn-sm">
                                            Actualizar
                                        </a>
                                    </div>
                                    <div class="d-inline-flex">
                                        <a href="index.php?page=Publicidades&actionpub=delete&IdPublicacion=<?php echo $row['IdPublicacion'] ?>"
                                            class="btn btn-danger btn-danger-bg btn-sm">
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
                </div>-->
            </div>

        </div>
    </div>

</body>

</html>