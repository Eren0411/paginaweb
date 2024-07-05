<?php
require_once ("modelos/model_preguntas.php");
require_once ("modelos/model_sistemas.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Lista de Preguntas Frecuentes</title>
</head>

<body>
    <div class="edicionFAQ-container container">
        <h1 class="edicionProd-heading text-center">Lista de Preguntas Frecuentes</h1>
        <a href="index.php?page=EdicionPreguntas" class="btn btn-primary service-btn btn-carruselImg btn-lg d-relative">
            Agregar nueva pregunta
        </a>
        <form id="form-filter" action="index.php?page=PreguntasAdmin" method="post">
        <div class="form-floating form-group form-group-custom mb-3">
            <select id="filter" name="filter" class="form-select form-select-custom" onchange="filterFAQs('form-filter')">
                <option value="" selected>Todas las categorías</option>
                <?php
                foreach ($dtsistemas as $row) {
                    echo '<option value="' . $row["IdSistema"] . '">' . $row["Nombre"] . '</option>';
                }
                ?>
            </select>
            <label for="filter">Filtrar por Referencia</label>
        </div>
        </form>

        <div class="table-responsive">

            <table id="faqTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="faq-th">ID</th>
                        <th class="faq-th">Pregunta</th>
                        <th class="faq-th">Respuesta</th>
                        <th class="faq-th">Referencia</th>
                        <th class="faq-th">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dtpregview as $row):
                        ?>
                        <tr data-category="categoria1">
                            <td><?php echo $row['IdPregunta'] ?></td>
                            <td><?php echo $row['Pregunta'] ?></td>
                            <td><?php echo $row['Respuesta'] ?></td>
                            <td><?php echo $row['NombreSistema'] ?></td>
                            <td>
                                <a href="index.php?page=EdicionPreguntas&IdPregunta=<?php echo $row['IdPregunta'] ?>" class="btn btn-faq btn-primary btn-sm me-2">Actualizar</a>
                                <a href="index.php?page=PreguntasAdmin&IdPregunta=<?php echo $row['IdPregunta'] ?>" class="btn btn-faq btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
        document.addEventListener("DOMContentLoaded", () => {
            valSel('filter',<?= $filterId ?>);
        });
        </script>

</html>