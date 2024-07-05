<?php
require_once ('modelos/model_funciones.php');
require_once ('modelos/model_preguntas.php');
require_once ('modelos/model_productos.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Detalle Sistema</title>
</head>

<body class="detalleSis-body">

    <?php
    $IdProducto = "";
    $NombreProducto = "";
    $Descripcion = "";
    $TpFileSis = "";
    $FileSis = "";
    $IdFile = "";

    if (!empty($dtfuncviewprod) && isset($dtfuncviewprod)) {
        foreach ($dtfuncviewprod as $rows):
            $Id = $rows["IdProducto"];
            $Nombre = $rows["NombreProducto"];
            $Descripcion = $rows["Descripcion"];
            $TpFileSis = $rows["Tipo"];
            $FileSis = $rows["Archivo"];
            $IdFile = $rows["IdArchivo"];
        endforeach;
    }
    ?>

    <header>
        <h1><?php echo $Nombre ?></h1>
    </header>

    <div class="container custom-container">
        <section class="sistemaDetalle-details custom-section">

            <div class="texto-container">
                <h2 class="detallesHeading">Detalles del producto</h2>
                <p><?php echo $Descripcion ?></p>
            </div>
            <div class="logoSistema-container">
                <img src="data:<?php echo $TpFileSis ?>;base64,<?php echo (base64_encode($FileSis)) ?>"
                    alt="Imagen del producto" class="logoSistema">
            </div>
        </section>

        <section class="sistemaDetalle-gallery custom-section detalleSis">
            <h2 class="detallesHeading">Galería</h2>
            <p class="mb-5">Imágenes del Producto</p> 

            <div class="container text-center my-3">
                <div class="row mx-auto my-auto justify-content-center">
                    <div id="recipeCarousel" class="carousel slide detalleSis" data-bs-ride="carousel">
                        <div class="carousel-inner detalleSis" role="listbox">
                            <?php
                            if (!empty($gallery) && isset($gallery)) {
                                // $imgs = array_chunk($gallery, 4);
                                $cuenta = 0;
                                foreach ($gallery as $row):
                                    $class = "carousel-item " . ($cuenta == 0 ? "active " : "") . "detalleSis";
                                    ?>
                                    <div class="<?= $class ?>">
                                        <div class="col-md-3 detalleSis">
                                            <div class="card detalleSis">
                                                <div class="card-img detalleSis">
                                                    <div class="img-container">
                                                        <img src="<?php echo $row ?>" class="img-fluid detalleSis">
                                                    </div>
                                                    <div class="card-img-overlay detalleSis"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $cuenta++;
                                endforeach;
                            }
                            // }
                            ?>
                        </div>
                        <a class="carousel-control-prev bg-transparent w-aut detalleSis" href="#recipeCarousel"
                            role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut detalleSis" href="#recipeCarousel"
                            role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="container text-center my-3">
            <a href="index.php?page=Productos" class="btn btn-success btn-success-custom">Volver</a>
        </div>  

    </div>

    <script>
        let items = document.querySelectorAll('.carousel .carousel-item');
        if (items.length > 1) {
            items.forEach((el) => {
                const minPerSlide = 4;
                let next = el.nextElementSibling;
                for (var i = 1; i < minPerSlide; i++) {
                    if (!next) {
                        next = items[0];
                    }
                    let cloneChild = next.cloneNode(true);
                    el.appendChild(cloneChild.children[0]);
                    next = next.nextElementSibling;
                }
            });
        }
    </script>
</body>

</html>