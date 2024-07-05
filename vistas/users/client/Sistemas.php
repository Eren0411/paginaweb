<?php
include_once("modelos/model_sistemas.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Sistemas</title>
</head>

<body>
    <header>
        <h1>Sistemas</h1>
    </header>

    <section id="sistemasSection">
        <div class="container">
            <h2>Nuestros Sistemas</h2>
        </div>
        <div id="container" class="container">
            <div class="container">
                <div class="Container-sistemas-filtro">
                    <div id="" class="form-select-custom">
                        <form method="POST" action="">
                            <label class="label-filtro-sistemas"for="FiltroSistemas">Filtrar por: </label>
                            <select class="sistemas-filter-select" name="FiltroSistemas" id="FiltroSistemas">
                                <option disabled selected hidden>SELECCIONE UNA OPCIÓN</option>
                                <option value="all">Todos</option>
                                <option value="Propio">Sistemas Propios</option>
                                <option value="Terceros">Sistemas de Terceros</option>
                            </select>
                            <button class="sistemas-filter-btn" type="Submit" value="Filtrar">Filtrar</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php       
        // Verificación de si se ha dado al botón de filtrar y se ha seleccionado una opción
        $filtro = isset($_POST['FiltroSistemas']) ? $_POST['FiltroSistemas'] : 'all';

        // Construcción de la consulta SQL basada en el filtro seleccionado
        $mysqli = "SELECT * FROM view_sistemas  ";
        if ($filtro == 'Propio') {
            $mysqli .= " WHERE TipoSistema = 'Propio'";
        } elseif ($filtro == 'Terceros') {
            $mysqli .= " WHERE TipoSistema = 'Terceros'";
        }
        // Ejecutar la consulta
        $result = $connect->query($mysqli);
        // Almacenar los resultados en un array
        $dtsisviews = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dtsisviews[] = $row;
            }
            }
        $connect->close();
        ?>
        
        <div id="sistemasContainer" class="container">
            <?php if (count($dtsisviews) > 0) : ?>
                <?php foreach ($dtsisviews as $row) : ?>
                    <div class="sistema">
                        <a href="index.php?page=DetalleSistema&IdDetSis=<?php echo $row['IdSistema'] ?>">
                            <img src="data:<?php echo $row['Tipo'] ?>;base64,<?php echo (base64_encode($row['Archivo'])) ?>" alt="<?php echo $row['Nombre'] ?>" />
                        </a>
                        <h3><?php echo $row['Nombre'] ?></h3>
                        <p><?php echo $row['Descripcion'] ?></p>
                        <a href="index.php?page=DetalleSistema&IdDetSis=<?php echo $row['IdSistema'] ?>" class="btn sistema-btn">Ver detalles</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No se encontraron resultados.</p>
            <?php endif; ?>
        </div>
        </div>
    </section>

</body>

</html>