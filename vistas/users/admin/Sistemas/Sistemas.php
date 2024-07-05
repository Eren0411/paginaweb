<?php

require_once("modelos/model_sistemas.php");

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
    <title>Web | Sistemas</title>
</head>

<body>
    <div class="carruselImg-container container shadow justify-content-center bg-dark-subtle mt-4">
        <h1 class="text-center carruselImg-heading">Sistemas</h1>
        <a href="index.php?page=EdicionSistemas" class="btn btn-primary service-btn btn-carruselImg btn-lg d-relative">
            Agregar un nuevo sistema
        </a>

        <div class="container mt-3 p-3 bg-white overflow-auto table-scroll rounded" style="max-height:600px;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php
                foreach ($dtsisviews as $rows) {
                    echo '<div class="col">';
                    echo '<div class="card service-card carruselImg-card h-100">';
                    echo '<img src="data:' . $rows['Tipo'] . ';base64,' . base64_encode($rows['Archivo']) . '" alt="' . $rows['Descripcion'] . '" class="card-img-top service-card-img-top" />';
                    echo '<div class="card-body card-body-bg service-card-body">';
                    echo '<h5 class="card-title service-card-title">' . $rows['Nombre'] . '</h5>';
                    echo '<div class="button-container service-button-container">';
                    echo '<a href="index.php?page=EdicionSistemas&IdSistema=' . $rows['IdSistema'] . '" class="btn service-btn btn-success btn-sm">Actualizar</a>';
                    echo '<a href="index.php?page=SistemasAdmin&IdSistema=' . $rows['IdSistema'] . '&actionsist=delete" class="btn service-btn btn-danger btn-sm">Eliminar</a>';
                    echo '<a href="index.php?page=FuncionSistemaAdmin&IdSistema=' . $rows['IdSistema'] . '" class="btn service-btn btn-primary btn-sm">Agregar/Eliminar Función</a>';
                    echo '<a href="index.php?page=VideoSistemaAdmin&IdSistema=' . $rows['IdSistema'] . '" class="btn service-btn btn-primary btn-sm">Agregar/Eliminar Videos</a>';
                    echo '<a href="index.php?page=PaqueteSistemaAdmin&IdSistema=' . $rows['IdSistema'] . '" class="btn service-btn btn-primary btn-sm">Agregar/Eliminar Paquetes</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>