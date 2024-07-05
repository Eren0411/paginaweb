<?php
require_once("modelos/model_servicios.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Editar Servicio</title>
</head>

<body>
    <div class="edicionProd-container container">
        <!-- Título de la vista -->
        <h1 class="edicionProd-heading text-center">Edición de Servicio</h1>

        <?php
        $Id = "";
        $Nombre = "";
        $Descripcion = "";
        $TpFileSer = "";
        $FileSer = "";
        $IdFile = "";

        if (isset($dtviewservicio)) {
            foreach ($dtviewservicio as $row) :
                $Id = $row["IdServicio"];
                $Nombre = $row["NombreServicio"];
                $Descripcion = $row["Descripcion"];
                $TpFileSer = $row["Tipo"];
                $FileSer = $row["Archivo"];
                $IdFile = $row["IdArchivo"];
            endforeach;
        }

        $actionS = "";
        $actionF = "";
        $actionS = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

        $action = "index.php?page=ServiciosAdmin&actionserv=$actionS&actionfile=$actionF";
        ?>
        <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
            <div class="form-group form-group-custom">
                <input id="Archivo" name="Archivo" class="form-control form-control-custom form-control-lg" type="file" onchange="myimg()" />
            </div>
            <div class="form-floating form-group-custom">
                <input id="Nombre" name="Nombre" class="form-control form-control-custom" value="<?php echo $Nombre ?>" type="text" placeholder="Nombre del servicio" required />
                <label for="Nombre">Nombre del servicio</label>
            </div>
            <div class="form-floating form-group form-group-custom">
                <textarea id="Descripcion" name="Descripcion" class="form-control form-control-custom" rows="5" placeholder="Inserte la descripción del servicio" style="resize: none; min-height: 90px"><?php echo $Descripcion ?></textarea>
                <label for="Nombre">Inserte la descripción del servicio</label>
            </div>

            <div style="display: none;">
                <input id="IdServicio" name="IdServicio" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
            </div>

            <div class="form-group form-group-custom">
                <img class="img-thumbnail img-thumbnailProd" id="muestra" src="data:<?php echo $TpFileSer ?>;base64,<?php echo (base64_encode($FileSer)) ?>" alt="Imagen seleccionada" />
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=ServiciosAdmin" class="btn btn-success btn-success-custom">Volver</a>
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