<?php
require_once('modelos/model_configuraciones.php');
include_once('modelos/model_sistemas.php');
?>

</div>

<footer class="footer footer-fondo">
    <div class="container">
        <div class="row">
            <?php
            $Direccion = "";
            $CodigoPostal = "";
            $Ciudad = "";
            $Estado = "";
            $Telefono = "";
            $Correo = "";
            $Facebook = "";
            $Instagram = "";
            $Youtube = "";
            $Whatsapp = "";
            $CorreoEnvios = "";

            foreach ($dtcontactos as $row) :
                switch ($row["CampoKey"]) {
                    case "Direccion":
                        $Direccion = $row["Descripcion"];
                        break;
                    case "CodigoPostal":
                        $CodigoPostal = $row["Descripcion"];
                        break;
                    case "Ciudad":
                        $Ciudad = $row["Descripcion"];
                        break;
                    case "Estado":
                        $Estado = $row["Descripcion"];
                        break;
                    case "Telefono":
                        $Telefono = $row["Descripcion"];
                        break;
                    case "Correo":
                        $Correo = $row["Descripcion"];
                        break;
                    case "Facebook":
                        $Facebook = $row["Descripcion"] ?? "";
                        break;
                    case "Instagram":
                        $Instagram = $row["Descripcion"] ?? "";
                        break;
                    case "Youtube":
                        $Youtube = $row["Descripcion"] ?? "";
                        break;
                    case "Whatsapp":
                        $Whatsapp = $row["Descripcion"] ?? "";
                        break;
                    case "CorreoEnvios":
                        $CorreoEnvios = $row["Descripcion"] ?? "";
                        break;
                }
            endforeach;

            $Address = "";
            $Dir = array();
            if (!empty($Direccion))
                $Dir[] = $Direccion;
            if (!empty($Estado))
                $Dir[] = $Estado;
            if (!empty($Ciudad))
                $Dir[] = $Ciudad;
            if (!empty($CodigoPostal))
                $Dir[] = $CodigoPostal;

            $Address = implode(", ", $Dir);
            ?>
            <div class="col-sm-6 col-md-4 mt-4 col-lg-3 text-center text-sm-start col-custom">
                <div class="resources">
                    <?php if (!empty($dtsistemas) && isset($dtsistemas)) { ?>
                        <h6 class="footer-heading text-uppercase fw-bold">Sistemas</h6>
                        <ul class="list-unstyled footer-link mt-4">
                            <?php
                            $sistemasFooter = array_chunk($dtsistemas, 4);
                            foreach ($sistemasFooter[0] as $row) :
                            ?>
                                <li class="mb-1"><a href="index.php?page=DetalleSistema&IdDetSis=<?php echo $row['IdSistema'] ?>" class="fw-semibold"><?php echo $row['Nombre'] ?></a></li>
                            <?php
                            endforeach;
                            ?>
                            <li class=""><a href="index.php?page=Sistemas" class="fw-semibold">Ver mas..</a></li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-4 col-lg-2 text-center text-sm-start col-custom">
                <div class="social">
                    <h6 class="footer-heading text-uppercase text-white fw-bold">Redes</h6>
                    <ul class="list-inline my-3">
                        <?php
                        if (!empty($Facebook)) { ?>
                            <li class="list-inline-item"><a href="<?php echo $Facebook ?>" class="btn-sm btn btn-primary mb-2" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a></li>
                        <?php
                        }
                        if (!empty($Whatsapp)) { ?>
                            <li class="list-inline-item"><a href="<?php echo $Whatsapp ?>" class="text-danger btn-sm btn btn-light mb-2">

                                    <i class="fab fa-whatsapp"></i>
                                </a></li>
                        <?php
                        }
                        if (!empty($Youtube)) { ?>
                            <li class="list-inline-item"><a href="<?php echo $Youtube ?>" class="btn-sm btn btn-primary mb-2">

                                    <i class="fab fa-youtube"></i>
                                </a></li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 mt-4 col-lg-4 text-center text-sm-start col-custom col-custom">
                <div class="contact footer-link">
                    <h6 class="footer-heading text-uppercase fw-bold">Contáctanos</h6>
                    <address class="mt-4 m-0 mb-1">
                        <?php if (!empty($Address)) { ?>
                            <i class="fas fa-map-marker-alt fw-semibold"></i>
                        <?php }
                        echo $Address
                        ?>
                    </address>
                    <a href="tel:+" class="mb-1 fw-semibold">
                        <?php if (!empty($Telefono)) { ?>
                            <i class="fas fa-phone"></i>
                        <?php }
                        echo $Telefono
                        ?>
                    </a>
                    <a href="mailto:" class="mb-1 fw-semibold">
                        <?php if (!empty($Correo)) { ?>
                            <i class="fas fa-envelope"></i>
                        <?php }
                        echo $Correo
                        ?>
                    </a>
                </div>
            </div>
            <!-- Privacidad -->
            <div class="col-sm-6 col-md-4 mt-4 col-lg-3 text-center text-sm-start col-custom">
                <div class="resources">
                    <h6 class="footer-heading text-uppercase fw-bold">Privacidad</h6>
                    <ul class="list-unstyled footer-link mt-4">
                        <li class="#"><a href="#" class="fw-semibold" id="terms-link">Términos y Condiciones</a></li>
                        <li class="#"><a href="#" class="fw-semibold" id="privacy-link">Aviso de Privacidad</a></li>
                    </ul>
                </div>
            </div>
            <?php
            $Aviso = "";
            $Terminos = "";

            foreach ($dtcontactos as $row) :
                switch ($row["CampoKey"]) {
                    case "Aviso":
                        $Aviso = $row["Descripcion"] ?? "";
                        break;
                    case "Terminos":
                        $Terminos = $row["Descripcion"] ?? "";
                        break;
                }
            endforeach;
            ?>
            <!-- Modal de Términos y Condiciones -->
            <div id="terms-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="terms-content">
                        <h2 class="text-black text-center fw-bold mb-3">Términos y Condiciones</h2>
                        <p class="text-black"><?= $Terminos ?></p>
                    </div>
                </div>
            </div>
            <!-- Modal de Aviso de Privacidad -->
            <div id="privacy-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="privacy-content">
                        <h2 class="text-black text-center fw-bold mb-3">Aviso de Privacidad</h2>
                        <p class="text-black"><?= $Aviso ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="recursos/lib/jquery/dist/jquery.js"></script>
<script src="recursos/lib/jquery/dist/jquery.min.js"></script>
<script src="recursos/lib/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="recursos/lib/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js"></script>

<script type="text/javascript" src="recursos/JS/site.js"></script>
<script type="text/javascript" src="recursos/JS/nav.js"></script>
<script type="text/javascript" src="recursos/JS/faq.js"></script>
<script type="text/javascript" src="recursos/JS/preguntas-funciones.js"></script>
<script type="text/javascript" src="recursos/JS/modal.js"></script>

<script src="recursos/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>