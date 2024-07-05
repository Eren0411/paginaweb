<?php
require_once("modelos/model_marcas.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Editar Marcas</title>
</head>

<body class="EdicionMarcas-body">
    <div class="container EdicionMarcas-container">
        <h1 class="text-center EdicionMarcas-heading">Edición de marcas</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group form-group-EdicionMarcas">
                <input id="Archivo" name="Archivo" class="form-control form-control-EdicionMarcas form-control-lg" type="file" onchange="myimg()" required />
                <img id="muestra" src="" alt="Imagen seleccionada" class="img-thumbnail img-thumbnail-EdicionMarcas" />
            </div>
            <div class="form-floating m-3">
                <input id="Nombre" name="Nombre" class="form-control form-control-EdicionMarcas" type="text" placeholder="Nombre de la marca" required />
                <label for="Nombre">Nombre de la marca</label>
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=MarcasAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>
    <script>
        function myimg() {
            var input = document.getElementById('Archivo');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('muestra').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>