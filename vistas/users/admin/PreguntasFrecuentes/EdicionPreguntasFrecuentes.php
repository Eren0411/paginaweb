<?php
require_once("modelos/model_preguntas.php");
require_once("modelos/model_sistemas.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Edición de Preguntas Frecuentes</title>
</head>

<body>
    <div class="edicionProd-container container">
        <h1 class="edicionProd-heading text-center">Edición de Preguntas Frecuentes</h1>

        <?php
        $Id = "";
        $Pregunta = "";
        $Respuesta = "";
        $IdRelacion = "";
        // $NombreSistema = "";

        if (isset($dtpregwhere)) {
            foreach ($dtpregwhere as $row) :
                $Id = $row["IdPregunta"];
                $Pregunta = $row["Pregunta"];
                $Respuesta = $row["Respuesta"];
                $IdRelacion = $row["IdRelacion"];
                // $NombreSistema = $row["NombreSistema"];
            endforeach;
        }

        $actionP = "";
        $actionP = (!empty($Id) && isset($Id)) ? "update" : "insert";

        $action = "index.php?page=PreguntasAdmin&actionpreg=$actionP";
        ?>

        <form method="post" action="<?php echo $action ?>">

            <div class="form-group form-group-custom">
                <div class="form-floating form-group-custom">
                    <input id="Pregunta" name="Pregunta" class="form-control form-control-custom" value="<?php echo $Pregunta ?>" rows="4" placeholder="Escribe la pregunta" style="resize: none; min-height: 60px" maxlength="148" required />
                    <label for="Pregunta">Pregunta</label>
                </div>
                <div class="form-floating form-group-custom">
                    <textarea id="Respuesta" name="Respuesta" class="form-control form-control-custom" value="<?php echo $Respuesta ?>" rows="6" placeholder="Escribe la respuesta" style="resize: none; min-height: 90px" required><?php echo $Respuesta ?></textarea>
                    <label for="Respuesta">Respuesta</label>
                </div>
            </div>

            <div class="form-floating form-group form-group-custom">
                <select id="IdRelacion" name="IdRelacion" class="form-select form-select-custom" value="<?php echo $IdRelacion ?>">
                    <option value="" hidden selected disabled >Selecciona un sistema</option>
                    <option value="NULL">General</option>
                    <?php
                    foreach ($dtsistemas as $row) {
                        echo '<option value="' . $row["IdSistema"] . '">' . $row["Nombre"] . '</option>';
                    }
                    ?>
                </select>
                <label for="IdSistema">Sistema</label>
            </div>

            <div style="display: none;">
                <input id="IdPregunta" name="IdPregunta" value="<?php echo $Id ?>" hidden readonly />
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                <a href="index.php?page=PreguntasAdmin" class="btn btn-success btn-success-custom">Volver</a>
            </div>
        </form>
    </div>

</body>

</html>