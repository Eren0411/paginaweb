<?php
    include_once('modelos/model_videos.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Videos</title>
    <style>

    </style>
</head>

<body>
<!--    <div class="edicionProd-container container">
        <h1 class="text-center edicionProd-heading">Videos (Sistemas)</h1>
        <form method="post" action="index.php?page=VideoSistemaAdmin&actionvid=insert" enctype="multipart/form-data" id="formulario">
            <div id="inputContainer">
                <?php
                foreach($dtvideoswhere as $row):
                ?>
                <div class="input-group function-input-group">
                    <input name="IdVideos['e'][]" value="<?php echo $row['IdVideos'] ?>" hidden readonly />
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <input type="text" name="TituloVideo['e'][]" class="form-control form-control-custom function-form-control-custom function-form" value="<?php echo $row['TituloVideo'] ?>" required>
                        <label class="function-label">Titulo del video</label>
                    </div>
                     Agrego el campo para la URL del video
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <textarea name="UrlVideo['e'][]" class="form-control form-control-custom function-form-control-custom function-form" required><?php echo $row['UrlVideo'] ?></textarea>
                        <label class="function-label">URL del video</label>
                    </div>
                     Fin del campo para la URL del video
                    <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
                </div>

                <input name="IdVideos['r'][]" value="<?php echo $row['IdVideos'] ?>" hidden readonly />

                <?php
                endforeach;
                ?>
                <div class="input-group function-input-group">
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <input type="text" name="TituloVideo['n'][]" class="form-control form-control-custom function-form-control-custom function-form" value="" required>
                        <label class="function-label">Titulo del video</label>
                    </div>
                     Agrego el campo para la URL DEL VIDEO 
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <textarea name="UrlVideo['n'][]" class="form-control form-control-custom function-form-control-custom function-form" required></textarea>
                        <label class="function-label">URL del video</label>
                    </div>
                     Fin del campo para la URL DEL VIDEO
                    <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
                </div>
            </div>
            <div style="display: none;">
                <input id="IdSistema" name="IdSistema" value="<?php echo $IdSistema ?>" hidden readonly />
            </div>
            <div class="button-container">
                <button type="button" onclick="agregarInput()" class="function-btn">Agregar</button>
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=SistemasAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div> -->

    <div class="edicionProd-container container">
        <h1 class="text-center edicionProd-heading">Videos (Sistemas)</h1>
        <form method="post" action="index.php?page=VideoSistemaAdmin&actionvid=insert" enctype="multipart/form-data" id="formulario">
            <div id="inputContainer">
                <?php foreach($dtvideoswhere as $row): ?>
                <div class="input-group function-input-group">
                    <input name="IdVideos['e'][]" value="<?php echo $row['IdVideos'] ?>" hidden readonly />
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <input type="text" name="TituloVideo['e'][]" class="form-control form-control-custom function-form-control-custom function-form" value="<?php echo $row['TituloVideo'] ?>" required>
                        <label class="function-label">Titulo del video</label>
                    </div>
                    <!-- Se agrega el campo para la URL del video -->
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <textarea name="UrlVideo['e'][]" class="form-control form-control-custom function-form-control-custom function-form" required><?php echo $row['UrlVideo'] ?></textarea>
                        <label class="function-label">URL del video</label>
                    </div>
                    <!-- Fin del campo para la URL del video -->
                    <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
                </div>
                <input name="IdVideos['r'][]" value="<?php echo $row['IdVideos'] ?>" hidden readonly />
                <?php endforeach; ?>
                
                <!-- Sección para agregar nuevos videos -->
                <div class="input-group function-input-group">
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <input type="text" name="TituloVideo['n'][]" class="form-control form-control-custom function-form-control-custom function-form" value="" required>
                        <label class="function-label">Titulo del video</label>
                    </div>
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <textarea name="UrlVideo['n'][]" class="form-control form-control-custom function-form-control-custom function-form" required></textarea>
                        <label class="function-label">URL del video</label>
                    </div>
                    <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
                </div>
            </div>
            <div style="display: none;">
                <input id="IdSistema" name="IdSistema" value="<?php echo $IdSistema ?>" hidden readonly />
            </div>
            <div class="button-container">
                <button type="button" onclick="agregarInput()" class="function-btn">Agregar</button>
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=SistemasAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>


    <script>
        function agregarInput() {
            var container = document.getElementById('inputContainer');
            var newInputGroup = document.createElement('div');
            newInputGroup.className = 'input-group function-input-group';
            newInputGroup.innerHTML = `
                <div class="form-floating form-group form-group-custom function-form-group-custom">
                    <input type="text" name="TituloVideo['n'][]" class="form-control form-control-custom function-form-control-custom function-form" value="" required>
                    <label class="function-label">Titulo del video</label>
                </div>
                <div class="form-floating form-group form-group-custom function-form-group-custom">
                    <textarea name="UrlVideo['n'][]" class="form-control form-control-custom function-form-control-custom function-form" required></textarea>
                    <label class="function-label">URL del video</label>
                </div>
                <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
            `;
            container.appendChild(newInputGroup);
        }

        function eliminarInput(btn) {
            var container = document.getElementById('inputContainer');
            var inputGroup = btn.parentElement;
            container.removeChild(inputGroup);
        }
    </script>
</body>

</html>