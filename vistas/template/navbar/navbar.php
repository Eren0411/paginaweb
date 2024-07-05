<?php
// require_once('modelos/model_configuraciones.php');
// require_once("modelos/model_sistemas.php");

require_once('modelos/model_publicaciones.php');
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href=" ./recursos/img/LogoIntelisof.jpg">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="recursos/lib/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Bootstrap -->

    <!-- Referencia Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Referencia Font Awesome -->

    <!-- Hojas de Estilos CSS -->
    <link rel="stylesheet" href="recursos/CSS/General.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Contacto.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/ContactoFooter.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/DetalleSistema.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/EdicionImgCarrusel.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/EdicionMarcas.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/EdicionProd.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/FAQ.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Footer.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Home.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/ImgCarrusel.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Login.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Nav.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Nosotros.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Productos.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Servicios.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Sistemas.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/TiposProductos.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Vision-Mision-Valores.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/NosotrosAdmin.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/PreguntasFrecuentesAdmin.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Privacidad.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/CarruselSistemas.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/FuncionSistema.css">
    <link rel="stylesheet" type="text/css" href="recursos/CSS/Modal.css">
    <!-- Hojas de Estilos CSS -->

    <!-- Referencia Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Referencia Sweet Alert -->
</head>

<body>
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <?php
        $Clave = "Logo";
        $TpFilePub = "";
        $FilePub = "";

        if (isset($dtlogo)) {
            foreach ($dtlogo as $row) :
                $Clave = $row["Clave"];
                $TpFilePub = $row["TipoArchivoPub"];
                $FilePub = $row["ArchivoPub"];
            endforeach;
        }
        ?>
        <!-- LOGO -->
        <a class="navbar-brand navbar-logo" href="#">
            <img src="data:<?php echo $TpFilePub ?>;base64,<?php echo (base64_encode($FilePub)) ?>" alt="<?= $Clave ?>" />
        </a>

        <!-- Botón para dispositivos móviles -->
        <button class="navbar-toggler navbar-btn-mobile" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li class="nav-item <?= !isset($_GET['page']) || $_GET['page'] == '' || !in_array($_GET['page'], ['Productos', 'Contacto', 'Nosotros', 'Servicios', 'Sistemas', 'DetalleSistema', 'PreguntasFrecuentes']) ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page="><i class="fa fa-home nav-icon"></i>Inicio</a>
                </li>
                <li class="nav-item <?= isset($_GET['page']) && $_GET['page'] == 'Productos' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=Productos"><i class="fa fa-tag nav-icon"></i>Productos</a>
                </li>
                <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'Contacto') echo 'active'; ?>">
                    <a class="nav-link" href="index.php?page=Contacto"><i class="fa fa-envelope nav-icon"></i>Contacto</a>
                </li>
                <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'Nosotros') echo 'active'; ?>">
                    <a class="nav-link" href="index.php?page=Nosotros"><i class="fa fa-users nav-icon"></i>Nosotros</a>
                </li>
                <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'Servicios') echo 'active'; ?>">
                    <a class="nav-link" href="index.php?page=Servicios"> <i class="fa fa-cogs nav-icon"></i></i>Servicios</a>
                </li>
                <li class="nav-item <?php if (isset($_GET['page']) && ($_GET['page'] == 'Sistemas' || $_GET['page'] == 'DetalleSistema')) echo 'active'; ?>">
                    <a class="nav-link" href="index.php?page=Sistemas"><i class="fa fa-desktop nav-icon"></i>Sistemas</a>
                </li>
                <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'PreguntasFrecuentes') echo 'active'; ?>">
                    <a class="nav-link" href="index.php?page=PreguntasFrecuentes"><i class="fas fa-question-circle nav-icon"></i>Preguntas Frecuentes</a>
                </li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>
                    <!-- Boton para el menu de admin -->
                    <button id="navbarSupportedContent" class="btn nav-item admin-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDark" aria-controls="offcanvasDark"><i class="fas fa-cog nav-icon"></i> Menú Admin</button>
                    <!-- Fin del boton para el menu de admin -->
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Menu de admin -->
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDark" aria-labelledby="offcanvasDarkLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkLabel">Menu para administrar la pagina</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=InfoContacto">Edicion de Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=ImgCarruselAdmin">Edicion de Imágenes del Carrusel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=PublicidadesAdmin">Edicion de Imágenes de Publicidad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=EdicionLogo">Edicion de Logo de Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=ProductosAdmin">Edicion de Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=ServiciosAdmin">Edicion de Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=SistemasAdmin">Edicion de Sistemas</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=TiposProductos">Edicion de Tipos de Productos</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=NosotrosAdmin">Edicion de Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=PreguntasAdmin">Edicion Preguntas Frecuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-link" href="index.php?page=TerminosPrivacidad">Edicion de Información de Privacidad</a>
                </li>
                <?php
                if ($_SESSION != null) {
                    if ($_SESSION['loggedin'] == true) {
                        echo '<li class="nav-item mt-3"><a class="nav-link admin-link admin-logout" href="cerrar.php">Cerrar Sesión</a></li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- Menu de admin -->
</body>

</html>