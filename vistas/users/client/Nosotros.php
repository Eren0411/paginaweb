<?php
// require_once("modelos/model_mision.php");
// require_once("modelos/model_vision.php");
// require_once("modelos/model_valores.php");
require_once("modelos/model_configuraciones.php");
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Sobre Nosotros</title>
</head>

<body>

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
    <header>
        <h1>Sobre Nosostros</h1>
    </header>

    <section id="nosotros" class="container-fluid">
        <h2>Empresa</h2>
        <div id="nosotros-info" class="container">
            <div class="columna">
                <p>
                    <?php echo $Somos ?>
                </p>
            </div>
            <!-- <div class="columna">
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita, esse animi dolore iste vitae commodi blanditiis ab nam reprehenderit voluptatem assumenda porro.
                    Sit maxime minima numquam placeat ipsa, aut quibusdam.
                </p>
            </div> -->
        </div>
    </section>

    <section id="vmv" class="">
        <div class="vmv-header">
            <div class="header-content">
                <span>#VMV</span>
                <span class="header-title">Empresa</span>
            </div>
        </div>
        <div class="vmv-section vision">
            <h2>VISIÓN</h2>
            <p>
                <?php echo $Vision ?>
            </p>
            <div class="icon-container">
                <img src="recursos\img\icons\mission.svg" alt="Visión">
            </div>
        </div>
        <div class="vmv-section mision">
            <h2>MISIÓN</h2>
            <p>
                <?php echo $Mision ?>
            </p>
            <div class="icon-container">
                <img src="recursos\img\icons\vision.svg">
            </div>

        </div>
        <div class="vmv-section valores">
            <h2>VALORES</h2>
            <p>
                <?php echo $Valores ?>
            </p>
            <div class="icon-container">
                <img src="recursos\img\icons\valores.svg" alt="Valores">
            </div>
        </div>
    </section>

</body>

</html>