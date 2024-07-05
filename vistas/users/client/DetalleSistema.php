<?php
require_once ('modelos/model_funciones.php');
require_once ('modelos/model_preguntas.php');
require_once ('modelos/model_sistemas.php');
require_once ('modelos/model_videos.php');
require_once ('modelos/model_paquetes.php');

function getEmbedUrl($url) { //función para convertir urls a embed
    if (preg_match('/youtu\.be\/([^\?]*)/', $url, $match)) {
        return 'https://www.youtube.com/embed/' . $match[1];
    } else if (preg_match('/youtube\.com.*(?:\/|v=)([^&$]+)/', $url, $match)) {
        return 'https://www.youtube.com/embed/' . $match[1];
    }
    return $url; // Devuelve la URL original si no es un enlace de YouTube
}
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
         // Datos del sistema
        foreach ($dtfuncview as $row):
            $Id = $row["IdSistema"];
            $Nombre = $row["Nombre"];
            $Descripcion = $row["Descripcion"];
            $Requisitos = $row["Requisitos"];
            $TpFileSis = $row["Tipo"];
            $FileSis = $row["Archivo"];
            $IdFile = $row["IdArchivo"];
        endforeach;

        // Datos de los videos
        $videosData = [];
        foreach($dtvidview as $row):
            $videosData[] = [
                'TituloVideo' => $row['TituloVideo'],
                'UrlVideo' => getEmbedUrl($row['UrlVideo']) // Convierte la URL a formato embed
            ];
        endforeach;
        
        // Datos de las preguntas
        foreach($dtpregview as $row):
            $Id = $row['IdPregunta'];
            $Pregunta = $row['Pregunta'];
            $Respuesta = $row['Respuesta'];
        endforeach;

        //Datos de los paquetes
        foreach($dtpaqview as $row):
            $IdPaquete = $row["IdPaquete"];
            $NombrePaquete = $row["NombrePaquete"];
            $Caracteristicas = $row["Caracteristicas"];
        endforeach;
        ?>

        <header>
            <h1><?php echo $Nombre ?></h1>
        </header>

        <div class="container custom-container">

        <!------------------ Empieza sección del header ------------------->
            <section class="sistemaDetalle-header custom-section">
            <div class="header-sistema">
                    <img src="data:<?php echo $TpFileSis ?>;base64,<?php echo (base64_encode($FileSis)) ?>"
                        alt="Logo del sistema" class="headerSistema-imagen">
                </div>
            </section>
        <!------------------ Termina sección del header ------------------->

        <!------------------ Empieza sección de detalles ------------------->
            <section class="sistemaDetalle-details custom-section">

                <div class="texto-container">
                    <h2 class="detallesHeading">Descripción del sistema</h2>
                    <p><?php echo $Descripcion ?></p>
                </div>
                <div class="logoSistema-container">
                    <img src="data:<?php echo $TpFileSis ?>;base64,<?php echo (base64_encode($FileSis)) ?>"
                        alt="Logo del sistema" class="logoSistema">
                </div>
            </section>
            <!------------------ Termina sección de detalles ------------------->


            <!------------------ Empieza sección de Requisitos ------------------->
            <?php if (!empty($Requisitos)): ?>
            <section class="sistemaDetalle-details custom-section">
                <div class="texto-container">
                    <h2 class="detallesHeading">Requisitos del sistema</h2>
                    <p><?php echo $Requisitos?></p>
                </div>
            </section>
            <?php endif; ?>
            <!------------------ Termina sección de Requisitos ------------------->


            <!--------------------- Empieza sección de Funciones --------------------->
            <section class="sistemaDetalle-functions custom-section">
                <h2 class="detallesHeading">Funciones del sistema</h2>
                <ul class="detalleList">
                    <?php
                    foreach ($dtfuncview as $row):
                        if (!empty($row['Funcion']) && isset($row['Funcion'])) {
                            ?>
                            <li>
                                <div class="question">
                                    <span class="function-name"><?= $row['Funcion'] ?></span>
                                    <span class="toggle-icon"><i class="fas fa-chevron-right"></i></span>
                                </div>
                                <div class="answer">
                                    <?= $row['DetFuncion'] ?>
                                </div>
                            </li>
                            <?php
                        }
                    endforeach;
                    ?>
                </ul>
            </section>
            <!--------------------- Termina sección de Funciones --------------------->

            
                    <!-------------------- Empieza sección de Videos ---------------------->
            <?php if(!empty($videosData)): ?>
            <section class="sistemaDetalle-functions custom-section">
                <h2 class="detallesHeading">Videos sobre el sistema</h2>
                <div class="row text-center">
                    <?php foreach ($videosData as $video): ?>
                    <div class="col-6">
                        <!-- Se cambia la visualización de los videos para mostrar el título y el video en un iframe -->
                        <div class="video-responsive">
                                <iframe height="300px" width="500px" src="<?php echo $video['UrlVideo']; ?>"
                                        frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
         
            <?php endif; ?>
            </section>
                    <!------------------------ Termina sección de videos ---------------------->

                    <!---------------------- Empieza prueba de carrusel de videos ------------------->
            <section class="sistemaDetalle-functions custom-section">
                    <h2 class="detallesHeading">Más videos sobre el sistema</h2>
                        <div class="container text-center my-3">
                            <div id="videoCarousel" class="carousel slide detalleSis" data-bs-ride="carousel">
                                <div class="carousel-inner detalleSis" role="listbox">
                                    <?php
                                    if (!empty($videosData) && isset($videosData)) {
                                        $cuentavideo = 0;
                                        foreach ($videosData as $video):
                                            $classvideo = "carousel-item " . ($cuentavideo == 0 ? "active " : "") . "detalleSis";
                                            ?>
                                            <div class="<?= $classvideo ?>">
                                                <div class="d-flex justify-content-center detalleSis">
                                                    <div class="card detalleSis">
                                                        <div class="card-img-mini detalleSis">
                                                            <div class="video-responsive">
                                                                <?php 
                                                                // URL del video de youtube
                                                                    $videoURL = $video['UrlVideo'];
                                                                    $urlArr = explode("/",$videoURL);
                                                                    $urlArrNum = count($urlArr);

                                                                    // ID del video de YT
                                                                    $youtubeVideoId = $urlArr[$urlArrNum - 1];

                                                                    // Genera el URL de l aminiatura
                                                                    $thumbURL = 'http://img.youtube.com/vi/'.$youtubeVideoId.'/0.jpg';
                                                                    ?>
                                                                    <!-- Muestra la miniatura y la despliega como un botón para una nueva pestaña -->
                                                                   <a class="videos-url" target="blank" href="<?php echo $video['UrlVideo']?>"><?php echo '<img src="'.$thumbURL.'"/>';?></a> 
                                                                
                                                               <!-- <iframe target_blank src="<?php echo $video['UrlVideo']; ?>"
                                                                frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                                            </iframe> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $cuentavideo++;
                                        endforeach;
                                    }
                                    ?>
                                </div>
                                <a class="carousel-control-prev bg-transparent w-aut detalleSis" href="#videoCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next bg-transparent w-aut detalleSis" href="#videoCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </section>
            <!------------------- Termina prueba de carrusel de videos ------------------------------->

            <!--------------------- Empieza sección de preguntas ---------------------->
            <?php if (!empty($Pregunta)): ?>
            <section class="sistemaDetalle-faq custom-section">
                <h2 class="detallesHeading">Preguntas Frecuentes</h2>
                <ul class="detalleList">
                    <?php
                    foreach ($dtpregview as $row):
                        ?>
                        <li>
                            <div class="question">
                                <?= $row['Pregunta'] ?? "" ?>
                                <span class="toggle-icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </div>
                            <div class="answer">
                                <?= $row['Respuesta'] ?? "" ?>
                            </div>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </section>
            <?php endif; ?>
            <!--------------------- Termina sección de preguntas ---------------------->


            <!------------ Empieza carrusel de imágenes ------------->
            <?php if(!empty($gallery)): ?>
            <section class="sistemaDetalle-gallery custom-section detalleSis">
                <h2 class="detallesHeading">Galería</h2>

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
            <?php endif; ?>
            <!------------ Termina carrusel de imágenes ------------->

            <!--------------------- Empieza sección de paquetes ----------------------->
            <?php if (!empty($IdPaquete)): ?>
            <section class="sistemaDetalle-paquetes custom-section">
                <h2 class="detallesHeading">Paquetes del sistema</h2>
                <div class="paqueteContainer">
                <?php
                foreach ($dtpaqview as $row):
                ?>
                    <div class="paqueteSistemas">
                        <div class="detallePaquete">
                            <h3><?php echo $row['NombrePaquete'] ?></h3>
                            <p><?php echo $row['Caracteristicas']?></p>  
                        </div>
                            <div class="btnPaquete">                                  
                            <a href="index.php?page=" class="btn service-btn btn-primary btn-sm">¡CONTRATA YA!</a>
                            </div>
                    </div>
                <?php endforeach; ?>
                </div>    
            </section>
            <?php endif; ?>
            <!--------------------- Termina seccion de paquetes ----------------------->


            <!-------------- Botón para regresar a sistemas -------------->
            <div class="container text-center my-3">
                <a href="index.php?page=Sistemas" class="btn btn-success btn-success-custom">Volver</a>
            </div>
            <!-------------- Botón para regresar a sistemas -------------->

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