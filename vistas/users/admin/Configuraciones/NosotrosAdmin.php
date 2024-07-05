<?php
require_once("modelos/model_configuraciones.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Edición Sobre Nosotros</title>
</head>

<body>
    <div class="nosotrosAdmin-container container">
        <h1 class="nosotrosAdmin-heading text-center">Edición Sobre Nosotros</h1>

        <form method="post" action="index.php?page=NosotrosAdmin&actioncon=nosotros" enctype="multipart/form-data">
            <?php
            $Somos = "";
            $Mision = "";
            $Vision = "";
            $Valores = "";

            foreach ($dtcontactos as $row) :
                switch ($row["CampoKey"]) {
                    case "Somos":
                        $Somos = $row["Descripcion"];
                        break;
                    case "Mision":
                        $Mision = $row["Descripcion"];
                        break;
                    case "Vision":
                        $Vision = $row["Descripcion"];
                        break;
                    case "Valores":
                        $Valores = $row["Descripcion"];
                        break;
                }
            endforeach;
            ?>

            <div class="form-group form-group-custom">
                <div class="form-floating form-group form-group-custom">
                    <textarea id="Somos" name="Somos" class="form-control form-control-custom nosotrosAdmin-textarea" placeholder="¿Quiénes Somos?"><?php echo $Somos ?></textarea>
                    <label for="Somos">¿Quiénes Somos?</label>
                </div>
                <div class="form-floating form-group form-group-custom">
                    <textarea id="Mision" name="Mision" class="form-control form-control-custom nosotrosAdmin-textarea" placeholder="Misión"><?php echo $Mision ?></textarea>
                    <label for="Mision">Misión</label>
                </div>
                <div class="form-floating form-group form-group-custom">
                    <textarea id="Vision" name="Vision" class="form-control form-control-custom nosotrosAdmin-textarea" placeholder="Visión"><?php echo $Vision ?></textarea>
                    <label for="Vision">Visión</label>
                </div>
                <div class="form-floating form-group form-group-custom">
                    <textarea id="Valores" name="Valores" class="form-control form-control-custom nosotrosAdmin-textarea" placeholder="Valores"><?php echo $Valores ?></textarea>
                    <label for="Valores">Valores</label>
                </div>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>