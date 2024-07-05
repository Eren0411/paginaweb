<?php

require_once("modelos/model_tipoproducto.php");

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
    <title>Web | Tipos de Productos</title>
</head>

<body class="TiposProductos-body">
    <div class="TiposProductos-container">
        <h1 class="TiposProductos-heading">Tipos de productos</h1>
        <a href="index.php?page=EdicionTiposProductos" class="btn btn-success btn-success-TiposProductos">
            Agregar un nuevo tipo de producto
        </a>
        <div class="table-responsive table-responsive-TiposProductos">
            <table class="table table-TiposProductos table-hover table-hover-TiposProductos table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Tipo de producto</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>Electrónica</td>
                        <td><a href="#" class="btn btn-primary btn-primary-TiposProductos btn-sm">Editar</a></td>
                        <td><a href="#" class="btn btn-danger btn-danger-TiposProductos btn-sm">Borrar</a></td>
                    </tr>
                    <tr class="text-center">
                        <td>Ropa</td>
                        <td><a href="#" class="btn btn-primary btn-primary-TiposProductos btn-sm">Editar</a></td>
                        <td><a href="#" class="btn btn-danger btn-danger-TiposProductos btn-sm">Borrar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>