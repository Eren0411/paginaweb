<!-- Navbar lateral start-->

<?php
require_once("modelos/model_publicaciones.php");
require_once("modelos/model_sistemas.php");
require_once("modelos/model_servicios.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Agregar Imágen de Publicidad</title>
</head>

<body>
    <div class="container edicionProd-container">
        <?php
        $Id = "";
        $Clave = "Publicidad"; 
        $Titulo = ""; 
        $Descripcion = ""; 
        $IdSistema = "";
        $TpFilePub = "";
        $FilePub = "";
        $IdFile = "";
        // $NServicio = "";
        // $FileServ = "";

        if (isset($dtpubwhere)) {
            foreach ($dtpubwhere as $row) :
                $Id = $row["IdPublicacion"];
                $Clave = $row["Clave"];
                $Titulo = $row["Titulo"];
                $Descripcion = $row["DescripcionPublicacion"];
                $IdSistema = $row["IdSistema"];
                $TpFilePub = $row["TipoArchivoPub"];
                $FilePub = $row["ArchivoPub"];
                $IdFile = $row["IdArchivo"];
            endforeach;
        }

        $actionP = "";
        $actionF = "";
        $actionP = (!empty($Id) && isset($Id)) ? "update" : "insert";
        $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

        $action = "index.php?page=PublicidadesAdmin&actionpub=$actionP&actionfile=$actionF";
        ?>
        <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
            <h3 class="edicionCarr-heading">Imagen de Publicidad</h3>
            <div class="form-group form-group-custom">
                <input id="Archivo" name="Archivo" class="form-control form-control-custom" type="file" onchange="myimg()"/>
            </div>
            <div class="card edicionCarr-card">
                <img id="muestra" src="data:<?php echo $TpFilePub ?>;base64,<?php echo (base64_encode($FilePub)) ?>" 
                alt="<?php echo !empty($Descripcion) && isset($Descripcion) ? $Descripcion : "Aqui se muestra la imagen seleccionada" ?>" 
                class="img-thumbnail" style="max-width:400px; max-height:300px;" />
            </div>
            <div class="form-floating form-group form-group-custom">
                <input type="text" class="form-control form-control-lg form-control-custom" id="Titulo" name="Titulo" placeholder="Título" value="<?php echo $Titulo ?>" required>
                <label for="Titulo">Título</label>
            </div>
            <div class="form-floating form-group form-group-custom">
                <textarea id="Descripcion" name="Descripcion" class="form-control form-control-lg form-control-custom" placeholder="Descripción" 
                value="<?php echo $Descripcion ?>" style="min-height: 80px; resize: none;" required rows="5"><?php echo $Descripcion ?></textarea>
                <label for="Descripcion">Descripción</label>
            </div>
            <!-- <div class="form-floating form-group form-group-custom">
                <select id="IdServicio" name="IdServicio" class="form-select form-select-custom" required>
                    <option value="" disabled selected hidden>Selecciona un servicio</option>
                    <?php
                    // foreach ($dtservicio as $row) {
                    //     echo '<option value="' . $row["IdServicio"] . '">' . $row["Nombre"] . '</option>';
                    // }
                    ?>
                </select>
                <label for="IdServicio">Servicio</label>
            </div> -->

            <div class="form-floating form-group form-group-custom">
                <select id="IdSistema" name="IdSistema" class="form-select form-select-custom" value="<?php echo $IdSistema ?>">
                    <option disabled selected hidden >Selecciona un sistema</option>
                    <option value="NULL" >Ninguno</option>
                    <?php
                    foreach ($dtsistemas as $row) {
                        echo '<option value="' . $row["IdSistema"] . '">' . $row["Nombre"] . '</option>';
                    }
                    ?>
                </select>
                <label for="IdSistema">Sistema</label>
            </div>

            <div class="z-1n opacity-0">
                <input id="CampoKey" name="CampoKey" value="<?php echo $Clave ?>" hidden readonly />
                <input id="IdPublicacion" name="IdPublicacion" value="<?php echo $Id ?>" hidden readonly />
                <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=PublicidadesAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>
    <script>
        function myimg() {
            var input = document.getElementById('Archivo');
            var fileReader = new FileReader();
            fileReader.readAsDataURL(input.files[0]);
            fileReader.onload = function(e) {
                document.getElementById('muestra').src = e.target.result;
            };
        }

        document.addEventListener("DOMContentLoaded", () => {
            valSel('IdSistema',<?php echo $IdSistema ?>);
        });
    </script>
</body>

</html>