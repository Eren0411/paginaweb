<?php
    include_once('modelos/model_preguntas.php');
?> 

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Preguntas Frecuentes</title>
</head>

<body>
    <header>
        <h1>Preguntas Frecuentes</h1>
    </header>

    <div class="faq-container">
        <h2>Preguntas Frecuentes</h2>
        <?php
        foreach($dtpregunta as $row):
        ?>
        <details class="faq-item">
            <summary class="faq-question">
                <span class="faq-icon">▶</span>
                <span class="faq-title"><?php echo $row['Pregunta']?></span>
            </summary>
            <div class="faq-answer">
                <p><?php echo $row['Respuesta']?></p>
            </div>
        </details>
        <?php
        endforeach;
        ?>
        <!-- <details class="faq-item">
            <summary class="faq-question">
                <span class="faq-icon">▶</span>
                <span class="faq-title">Otra pregunta frecuente</span>
            </summary>
            <div class="faq-answer">
                <p>Otra respuesta aquí.</p>
            </div>
        </details> -->
        <!-- Agrega más preguntas de la misma manera -->
    </div>

</body>

</html>