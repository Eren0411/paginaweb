<?php
require_once('modelos/model_configuraciones.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web | Agregar Aviso de Privacidad - Términos y Condiciones</title>
</head>

<body>

    <?php
    $Aviso = "";
    $Terminos = "";

    if (!empty($dtcontactos)) {
        foreach ($dtcontactos as $row):
            switch ($row["CampoKey"]) {
                case "Aviso":
                    $Aviso = $row["Descripcion"] ?? "";
                    break;
                case "Terminos":
                    $Terminos = $row["Descripcion"] ?? "";
                    break;
            }
        endforeach;
    }
    ?>
    <div class="privacy-container container mt-4">
        <div class="form-container">
            <h1 class="edicionProd-heading">Agregar Aviso de Privacidad y Términos y Condiciones</h1>
            <form action="index.php?page=TerminosPrivacidad&actioncon=rules" method="post" class="was-validated" >
                <div class="form-floating form-group form-group-custom">
                    <textarea id="privacy-policy" name="Aviso"
                        class="form-control form-control-custom privacy-textarea" required
                        placeholder="Aviso de Privacidad: "><?php echo $Aviso ?></textarea>
                    <label for="privacy-policy">Aviso de Privacidad:</label>
                </div>

                <div class="form-floating form-group form-group-custom">
                    <textarea id="terms-conditions" name="Terminos"
                        class="form-control form-control-custom privacy-textarea" required
                        placeholder="Términos y Condiciones"><?php echo $Terminos ?></textarea>
                    <label for="terms-conditions">Términos y Condiciones: </label>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-primary btn-success-custom">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>