<?php

require_once('recursos/config/db.php');
require_once('controladores/controller_publicaciones.php');
require_once('modelos/model_archivos.php');

$publicacion = new Publicacion();
$publicacion->setTable("Publicaciones");
$publicacion->setView('view_publicaciones');

$publicacion->setKey('IdPublicacion');

$publicacion->setColumns('CampoKey');
$publicacion->setColumns('Titulo');
$publicacion->setColumns('Descripcion');
// $publicacion->setColumns('IdServicio');
$publicacion->setColumns('IdSistema');
$publicacion->setColumns('IdArchivo');

$fch_r = date('Y-m-d'); //OBTIENE LA FECHA ACTUAL

// if ((!empty($_GET['IdPublicacion'])) && (isset($_GET['IdPublicacion']))) {
//     $IdPublicacion = $_GET['IdPublicacion'];
//     $dtpubwhere = $publicacion->getWhereview($IdPublicacion);
// }else if ((!empty($_POST['IdPublicacion'])) && (isset($_POST['IdPublicacion']))) {
//     $IdPublicacion = $_POST['IdPublicacion'];
//     $dtpubwhere = $publicacion->getWhereview($IdPublicacion);
// } else {
//     $IdPublicacion = null;
//     $dtpubwhere = null;
// }

$IdPublicacion = $_GET['IdPublicacion'] ?? $_POST['IdPublicacion'] ?? null;

if(isset($IdPublicacion) && !empty($IdPublicacion)){
    $dtpubwhere = $publicacion->getWhereview($IdPublicacion);
}else{
    $dtpubwhere = null;
}

$dtlogo = $publicacion->getWhereClave('Logo');

$dtpublicaciones = $publicacion->getView();

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionpub'])) && (isset($_GET['actionpub']))) {
    $actionpub = $_GET['actionpub'];
    if ($actionpub === 'insert') {
        // COMPROBAMOS QUE TODOS LOS ARCHIVOS HAYAN SIDO CORRECTOS
        $publicacion->values[] = "'" . $_POST['CampoKey'] . "'";
        $publicacion->values[] = "'" . $_POST['Titulo'] . "'" ?? "";
        $publicacion->values[] = "'" . $_POST['Descripcion'] . "'" ?? "";
        // $publicacion->values[] = "'" . $_POST['IdServicio'] . "'";
        $publicacion->values[] = "" . $_POST['IdSistema'] . "" ?? "NULL";
        $publicacion->values[] = $Idfile;

        $publicacion->insertPub();

        echo '<script>location.replace("index.php?page='. $_GET['page'] .'&ins=Ok");</script>';

    } else if ($actionpub === 'update') {

        foreach ($dtpubwhere as $rowid):
            $IdArchivoPub = $rowid['IdArchivo'];
        endforeach;

        $publicacion->values[] = "'" . $_POST['CampoKey'] . "'";
        $publicacion->values[] = "'" . $_POST['Titulo'] . "'";
        $publicacion->values[] = "'" . $_POST['Descripcion'] . "'";
        // $publicacion->values[] = "'" . $_POST['IdServicio'] . "'";
        $publicacion->values[] = "" . $_POST['IdSistema'] . "" ?? "NULL";

        if ($Idfile !== "NULL" || (!empty($Idfile) && isset($Idfile))) {
            $publicacion->values[] = $Idfile;
        } else {
            $publicacion->values[] = $IdArchivoPub;
        }

        $publicacion->updatePub($IdPublicacion);

        echo '<script>location.replace("index.php?page='. $_GET['page'] .'&upd=Ok");</script>';

    } else if ($actionpub === 'delete') {
        foreach ($dtpubwhere as $row):
            $Idarchdel = $row['IdArchivo'];
        endforeach;

        $publicacion->deletePub($IdPublicacion);

        if (isset($Idarchdel)) {
            $archivo->deleteArchivo($Idarchdel);
        }

        echo '<script>location.replace("index.php?page='. $_GET['page'] .'&del=Ok");</script>';
    }
}
