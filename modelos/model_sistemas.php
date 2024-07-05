<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_sistemas.php");
require_once("modelos/model_archivos.php");
require_once("modelos/model_funciones.php");
require_once("modelos/model_videos.php");
require_once("modelos/model_paquetes.php");

$sistema = new Sistemas();
$sistema->setTable("Sistemas");
$sistema->setView('view_sistemas');

$sistema->setKey('IdSistema');

$sistema->setColumns('Nombre');
$sistema->setColumns('Descripcion');
$sistema->setColumns('Requisitos');
$sistema->setColumns('TipoSistema');
$sistema->setColumns('IdArchivo');

if ((!empty($_GET['IdSistema'])) && (isset($_GET['IdSistema']))) {
    $IdSistema = $_GET['IdSistema'];
    $dtsistemawhere = $sistema->getWhere($IdSistema);
    $dtviewsistema = $sistema->getWhereview($IdSistema);
} else if ((!empty($_POST['IdSistema'])) && (isset($_POST['IdSistema']))) {
    $IdSistema = $_POST['IdSistema'];
    $dtsistemawhere = $sistema->getWhere($IdSistema);
    $dtviewsistema = $sistema->getWhereview($IdSistema);
} else if ((!empty($_GET['IdDetSis'])) && (isset($_GET['IdDetSis']))) {
    $filesGallery = new GallerySistems();
    $dtfuncview = (empty($dtfuncview)) ? $sistema->getWhereview($_GET['IdDetSis']) : $dtfuncview;
    $gallery = $filesGallery->ObtenerGaleria($_GET['IdDetSis']);
} else {
    $IdSistema = null;
    $dtsistemawhere = null;
    $dtviewsistema = null;
    $dtsisviews = $sistema->getView();
}
$dtsistemas = $sistema->getAll();

$dir_doc = "recursos/Archivos/";

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionsist'])) && (isset($_GET['actionsist']))) {
    $actionsist = $_GET['actionsist'];

    if ($actionsist === 'insert') {

        $sistema->values[] = "'" . $_POST['Nombre'] . "'";
        $sistema->values[] = "'" . $_POST['Descripcion'] . "'";
        $sistema->values[] = "'" . $_POST['Requisitos'] . "'";
        $sistema->values[] = "'" . $_POST['TipoSistema'] . "'";
        $sistema->values[] = $Idfile;

        $sistema->insertSistema();
        $Id = $sistema->lastId();

        $filesCarga = new GallerySistems();
        $filesCarga->MoverArchivos($_FILES['Gallery'], $Id);

        echo '<script>location.replace("index.php?page=SistemasAdmin&ins=Ok");</script>';

    } elseif ($actionsist === 'update') {

        foreach ($dtsistemawhere as $rowid):
            $IdArchivoSist = $rowid['IdArchivo'];
        endforeach;

        $sistema->values[] = "" . $_POST['Nombre'] . "";
        $sistema->values[] = "" . $_POST['Descripcion'] . "";
        $sistema->values[] = "" . $_POST['Requisitos'] . "";
        $sistema->values[] = "" . $_POST['TipoSistema'] . "";

        if($Idfile !== "NULL" || (!empty($Idfile) && isset($Idfile))){
            $sistema->values[] = $Idfile;
        }else{
            $sistema->values[] = $Idfile;
        }
                
        $sistema->updateSistema($IdSistema);
        
        $filesCarga = new GallerySistems();
        $filesCarga->MoverArchivos($_FILES['Gallery'], $IdSistema);

         echo '<script>location.replace("index.php?page=SistemasAdmin&upd=Ok");</script>';

    } elseif ($actionsist === 'delete') {
        foreach ($dtsistemawhere as $rowid):
            $IdArchivoSist = $rowid['IdArchivo'];
        endforeach;

        $filesGallery = new GallerySistems();
        $filesGallery->DeleteGallery($IdSistema);

        $funcion->deleteFunctionWhereSistema($IdSistema);

        $video->deleteVideoWhereSistema($IdSistema);

        $paquete->deletePaqueteWhereSistema($IdSistema);

        $sistema->deleteSistema($IdSistema);
        if (isset($IdArchivoSist)) {
            $archivo->deleteArchivo($IdArchivoSist);
        }
        echo '<script>location.replace("index.php?page=SistemasAdmin&del=Ok");</script>';
    }
}
