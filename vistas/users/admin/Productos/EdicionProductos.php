<?php
require_once("modelos/model_productos.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Edición de Productos</title>
</head>

<body>
    <div class="edicionProd-container container">
        <h1 class="text-center edicionProd-heading">Edición de productos</h1>

        <?php
        $Id = "";
        $Nombre = "";
        $Descripcion = "";
        $TpFileSer = "";
        $FileSer = "";
        $IdFile = "";

        if (isset($dtviewproducto)) {
            foreach ($dtviewproducto as $row) :
                $Id = $row["IdProducto"];
                $Nombre = $row["NombreProducto"];
                $Descripcion = $row["Descripcion"];
                $TpFileProd = $row["Tipo"];
                $FileProd = $row["Archivo"];
                $IdFile = $row["IdArchivo"];
            endforeach;
        }

        $actionP = "";
        $actionF = "";
        $actionP = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

        $action = "index.php?page=EdicionProductos&actionprod=$actionP&actionfile=$actionF";
        ?>
        <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
            <div class="form-group form-group-custom">
                <label for="Archivo">Imagen del Producto:</label>
                <input id="Archivo" name="Archivo" class="form-control form-control-custom form-control-lg" type="file" onchange="myimg()" />
                <img id="muestra" src="data:<?php echo $TpFileSer ?>;base64,<?php echo (base64_encode($FileSer)) ?>" alt="Imagen seleccionada" class="img-thumbnail img-thumbnailProd" />
            </div>
            <div class="form-floating form-group form-group-custom">
                <input type="text" name="NombreProducto" class="form-control form-control-custom" id="NombreProducto" placeholder="Nombre del producto" value="<?php echo $Nombre ?>" required>
                <label for="NombreProducto">Nombre del Producto</label>
            </div>

            <div class="form-floating form-group form-group-custom">
                <input type="text" class="form-control form-control-custom" id="Descripcion" name="Descripcion" placeholder="Detalles o Descripción del Producto" value="<?php echo $Descripcion ?>" required>
                <label for="Descripcion">Detalles o Descripción del Producto</label>
            </div>

            <div class="z-1n opacity-0">
                <input id="IdProducto" name="IdProducto" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=ProductosAdmin" class="btn btn-success btn-success-custom">Volver</a>
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