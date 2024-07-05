<?php
include_once("modelos/model_publicaciones.php");
include_once("modelos/model_sistemas.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Inicio</title>
</head>

<body>

    <div class="container-fluid">
        <section id="carruselPrincipal">
            <div id="carruselHome" class="carousel slide" data-bs-ride="true">
                <div class="carousel-inner">
                    <?php
                    $count = 0;
                    foreach ($dtpublicaciones as $row) :
                        if ($row['Clave'] == "Carrusel") {
                    ?>
                            <div class="carousel-item <?php echo ($count == 0 ? "active" : "") ?> carruselImg">
                                <img class="img-fluid" src="data:<?php echo $row['TipoArchivoPub'] ?>;base64,<?php echo (base64_encode($row['ArchivoPub'])) ?>" alt="<?php echo $row['Clave'] . $row['IdPublicacion'] ?>">
                            </div>
                    <?php
                            $count++;
                        }
                    endforeach;
                    ?>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carruselHome" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carruselHome" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <header class="contacto-header mb-5 mt-5" style="margin: 0;">
            <h1>Sistemas</h1>
        </header>

        <div class="container-fluid">
            <section id="carruselSecundario" class="container-fluid mb-5">
                <div id="carruselSoftware" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner p-3">
                        <?php
                        $lista = array_chunk($dtsisviews, 5);
                        for ($i = 0; $i < count($lista); $i++) {
                            $active = $i == 0 ? "active" : "";
                        ?>
                            <div class="carousel-item <?php echo $active ?>">
                                <div class="d-flex">
                                    <?php
                                    foreach ($lista[$i] as $row) :
                                        $Id = (!empty($row["IdSistema"]) ? $row["IdSistema"] : "");
                                        $Nombre = (!empty($row["NombreSistema"]) ? $row["NombreSistema"] : "");
                                        $TpFileSis = (!empty($row["Tipo"]) ? $row["Tipo"] : "");
                                        $FileSis = (!empty($row["Archivo"]) ? $row["Archivo"] : "");
                                    ?>
                                        <img src="data:<?php echo $TpFileSis ?>;base64,<?php echo (base64_encode($FileSis)) ?>" alt="<?php echo $Nombre ?>">
                                    <?php
                                    endforeach;
                                    ?>

                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carruselSoftware" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carruselSoftware" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>

            <!-- <section id="gallerySection" class="container">
                <h2>Galería de Flyers, Avisos, etc.</h2>
                <div class="publicacion-grid-container">
                     Ejemplo de imagen de flyer 
                    <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                        <img src="https://via.placeholder.com/350x350" alt="Flyer 1">
                        <div class="publicacion-grid-item-content">
                            <h3>Flyer 1</h3>
                            <p class="descripcion-publi">

                                Morbi lacus augue, pellentesque non mollis vitae, bibendum non metus. Ut nec laoreet nisi, a porta mauris. Nulla nulla sem, placerat quis augue at, pulvinar finibus.</p>
                        </div>
                    </div>
                    <!-- Ejemplo de imagen de aviso 
                    <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                        <img src="https://via.placeholder.com/350x350" alt="Aviso 1">
                        <div class="publicacion-grid-item-content">
                            <h3>Aviso 1</h3>
                            <p>Descripción del aviso 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula vel nunc semper lacinia.</p>
                        </div>
                    </div>
                    <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                        <img src="https://via.placeholder.com/350x350" alt="Aviso 2">
                        <div class="publicacion-grid-item-content">
                            <h3>Aviso 2</h3>
                            <p>Descripción del aviso 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula vel nunc semper lacinia.</p>
                        </div>
                    </div>
                    <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                        <img src="https://via.placeholder.com/350x350" alt="Aviso 3">
                        <div class="publicacion-grid-item-content">
                            <h3>Aviso 3</h3>
                            <p>Descripción del aviso 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula vel nunc semper lacinia.</p>
                        </div>
                    <?php
                    // }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carruselSoftware" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carruselSoftware" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section> -->

        <section id="gallerySection" class="container">
            <h2>Galería de Flyers, Avisos, etc.</h2>
            <div class="publicacion-grid-container">

            <?php
                foreach($dtpublicaciones as $row):
                    if($row['Clave'] == "Publicidad"){
                ?>
                <div class="publicacion-grid-item" onclick="openModal('')">
                    <img src="data:<?php echo $row['TipoArchivoPub'] ?>;base64,<?php echo (base64_encode($row['ArchivoPub'])) ?>"
                        alt="<?php echo $row['Titulo'] ?>">
                    <div class="publicacion-grid-item-content">
                        <h3><?php echo $row['Titulo'] ?></h3>
                        <p class="descripcion-publi">
                            <?php echo $row['DescripcionPublicacion'] ?>
                        </p>
                        <span class="text-muted"><?= $row['NombreSistema'] ?? "" ?></span>
                    </div>
                </div>

                <?php
                    }
                endforeach;
                ?>
                <!-- Ejemplo de imagen de flyer -->
                <!-- <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                    <img src="https://via.placeholder.com/350x350" alt="Flyer 1">
                    <div class="publicacion-grid-item-content">
                        <h3>Flyer 1</h3>
                        <p class="descripcion-publi">

                            Morbi lacus augue, pellentesque non mollis vitae, bibendum non metus. Ut nec laoreet nisi, a porta mauris. Nulla nulla sem, placerat quis augue at, pulvinar finibus.</p>
                    </div>
                </div> -->
                <!-- Ejemplo de imagen de aviso -->
                <!-- <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                    <img src="https://via.placeholder.com/350x350" alt="Aviso 1">
                    <div class="publicacion-grid-item-content">
                        <h3>Aviso 1</h3>
                        <p>Descripción del aviso 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula vel nunc semper lacinia.</p>
                    </div>
                </div>
                <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                    <img src="https://via.placeholder.com/350x350" alt="Aviso 2">
                    <div class="publicacion-grid-item-content">
                        <h3>Aviso 2</h3>
                        <p>Descripción del aviso 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula vel nunc semper lacinia.</p>
                    </div>
                </div>
                <div class="publicacion-grid-item" onclick="openModal('https://via.placeholder.com/350x350')">
                    <img src="https://via.placeholder.com/350x350" alt="Aviso 3">
                    <div class="publicacion-grid-item-content">
                        <h3>Aviso 3</h3>
                        <p>Descripción del aviso 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula vel nunc semper lacinia.</p>
                    </div>
                </div> -->
            </div>
        </section>
        <!-- Modal -->
        <div id="publiModal" class="publi-modal">
            <div class="publi-modal-content">
                <span class="publi-close" onclick="closeModal()">&times;</span>
                <img id="publiModalImg" src="" alt="Modal Image">
            </div>
        </div>
    </div>

    <script>
        // Función para abrir el modal y mostrar la imagen
        function openModal(src) {
            document.getElementById("publiModal").style.display = "block";
            document.getElementById("publiModalImg").src = src;
            document.body.style.overflow = "hidden"; // Evita el desplazamiento de la página mientras el modal está abierto
            document.querySelector(".publi-modal-content").classList.add("publi-fade-in"); // Agrega animación de fade-in al modal
        }

        // Función para cerrar el modal
        function closeModal() {
            document.getElementById("publiModal").style.display = "none";
            document.body.style.overflow = "auto"; // Restaura el desplazamiento de la página al cerrar el modal
            document.querySelector(".publi-modal-content").classList.remove("publi-fade-in"); // Remueve la clase de animación de fade-in
        }

        // Cierra el modal al hacer clic fuera de él (en el área oscura)
        window.onclick = function(event) {
            var modal = document.getElementById("publiModal");
            if (event.target == modal) {
                closeModal();
            }
        }

        var descripciones = document.querySelectorAll('.descripcion-publi');

        descripciones.forEach(function(descripcion) {
            var texto = descripcion.innerText;
            if (texto.length > 300) {
                descripcion.innerText = texto.slice(0, 300) + '...';
            }
        });
    </script>
</body>

</html>