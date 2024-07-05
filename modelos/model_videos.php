<?php

require_once ("recursos/config/db.php");
require_once ("controladores/controller_videos.php");


$video = new Videos();
$video->setTable("Videos");
$video->setView('view_videos');

$video->setKey('IdVideos');

$video->setColumns('TituloVideo');
$video->setColumns('UrlVideo');
$video->setColumns('IdSistema');

$video->setFk('IdSistema');

if ((!empty($_GET['IdVideos'])) && (isset($_GET['IdVideos']))) {
    $IdVideos = $_GET['IdVideos'];
    $dtvideoswhere = $video->getWhere($IdVideos);
    $dtviewvideos = $video->getWhereview($IdVideos);
    // } else if ((!empty($_POST['IdFuncion'])) && (isset($_POST['IdFuncion']))) {
//     $IdFuncion = $_POST['IdFuncion'];
//     $dtfuncionwhere = $funcion->getWhere($IdFuncion);
//     $dtviewfuncion = $funcion->getWhereview($IdFuncion);
} else if ((!empty($_GET['IdSistema'])) && (isset($_GET['IdSistema']))) {
    $IdSistema = $_GET['IdSistema'];
    $dtvideoswhere = $video->getWhereFK($_GET['IdSistema']);
} else if ((!empty($_GET['IdDetSis'])) && (isset($_GET['IdDetSis']))) {
    $dtvidview = $video->getWhereVS($_GET['IdDetSis']);
} else {
    $IdVideos = null;
    $dtvideoswhere = null;
    $dtviewvideos = null;
    $dtvideos = $video->getAll();
    $dtvidview = $video->getView();
}


$vexist = array(); /* se define la variable $vexist
                    la manda vacía o como no existente si no se define fuera del if*/
// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionvid'])) && (isset($_GET['actionvid']))) {
    $actionvid = $_GET['actionvid'];

    if ($actionvid === 'insert') {

        if (!empty($_POST['TituloVideo']) && isset($_POST['TituloVideo'])) {
            foreach ($_POST['TituloVideo'] as $vid => $existe):
                if (str_contains($vid, 'e')) {
                    $vexist = $_POST['TituloVideo'];
                    if (!empty($vexist) && isset($vexist)) {
                        for ($i = 0; $i < count($vexist); $i++) {
                            $IdVideos = $_POST['IdVideos'][$vid][$i];
                            $video->values[] = "" . $_POST['TituloVideo'][$vid][$i] . "";
                            $video->values[] = "" . $_POST['UrlVideo'][$vid][$i] . "";
                            $video->values[] = "" . $_POST['IdSistema'] . "";

                            $video->updateVideo($IdVideos);
                            $video->values = array();
                        }
                        $vexist = array();
                    }
                }else if (str_contains($vid, 'n')) {
                    $vnew = $_POST['TituloVideo'][$vid];
                    if (!empty($vnew) && isset($vnew)) {
                        for ($i = 0; $i < count($vnew); $i++) {
                            $video->values[] = "'" . $_POST['TituloVideo'][$vid][$i] . "'";
                            $video->values[] = "'" . $_POST['UrlVideo'][$vid][$i] . "'";
                            $video->values[] = "" . $_POST['IdSistema'] . "";

                            $video->insertVideo();
                            $video->values = array();
                        }
                        $vnew = array();
                    }
                }

            endforeach;
        }

        if (!empty($_POST['IdVideos']) && isset($_POST['IdVideos'])) {    
            foreach ($_POST['IdVideos'] as $key => $vid):
                if (str_contains($key, 'e'))
                    $vexist = $vid;
                else if (str_contains($key, 'r'))
                    $vremove = $vid;
            endforeach;
            
            for ($i = 0; $i < count($vremove); $i++) {
                if ($vexist !== null){
                    $valid = in_array($vremove[$i], $vexist);
                    if (!in_array($vremove[$i], $vexist)) {
                        $video->deleteVideo($vremove[$i]);
                    }
                }
            }
        }
        echo '<script>location.replace("index.php?page=SistemasAdmin");</script>';

    } elseif ($actionvid === 'update') {

        foreach ($dtserviciowhere as $rowid):
            $IdArchivoServ = $rowid['IdArchivo'];
        endforeach;

        $video->values[] = "" . $_POST['TituloVideo'] . "";
        $video->values[] = "" . $_POST['UrlVideo'] . "";
        $video->values[] = "'" . $_POST['IdSistema'] . "'";

        $video->updateVideo($IdVideo);

        echo '<script>location.replace("index.php?page=VideoAdmin&upd=Ok");</script>';

    } elseif ($actionvid === 'delete') {

        $video->deleteVideoWhereSistema($IdVideo);

         echo '<script>location.replace("index.php?page=VideoAdmin&del=Ok");</script>';
    }
}