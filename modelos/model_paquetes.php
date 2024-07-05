<?php

require_once ("recursos/config/db.php");
require_once ("controladores/controller_paquetes.php");


$paquete = new Paquetes();
$paquete->setTable("Paquetes");
$paquete->setView('view_paquetes');

$paquete->setKey('IdPaquete');

$paquete->setColumns('NombrePaquete');
$paquete->setColumns('Caracteristicas');
$paquete->setColumns('IdSistema');

$paquete->setFk('IdSistema');

if ((!empty($_GET['IdPaquete'])) && (isset($_GET['IdPaquete']))) {
    $IdPaquete = $_GET['IdPaquete'];
    $dtpaquetewhere = $paquete->getWhere($IdPaquete);
    $dtviewpaquete = $paquete->getWhereview($IdPaquete);
    // } else if ((!empty($_POST['IdPaquete'])) && (isset($_POST['IdPaquete']))) {
//     $IdPaquete = $_POST['IdPaquete'];
//     $dtpaquetewhere = $paquete->getWhere($IdPaquete);
//     $dtviewpaquete = $paquete->getWhereview($IdPaquete);
} else if ((!empty($_GET['IdSistema'])) && (isset($_GET['IdSistema']))) {
    $IdSistema = $_GET['IdSistema'];
    $dtpaquetewhere = $paquete->getWhereFK($_GET['IdSistema']);
} else if ((!empty($_GET['IdDetSis'])) && (isset($_GET['IdDetSis']))) {
    $dtpaqview = $paquete->getWhereVS($_GET['IdDetSis']);
} else {
    $IdPaquete = null;
    $dtpaquetewhere = null;
    $dtviewpaquete = null;
    $dtpaquetes = $paquete->getAll();
    $dtpaqview = $paquete->getView();
}

$pexist = array();
// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionpaq'])) && (isset($_GET['actionpaq']))) {
    $actionpaq = $_GET['actionpaq'];

    if ($actionpaq === 'insert') {

        if (!empty($_POST['NombrePaquete']) && isset($_POST['NombrePaquete'])) {
            foreach ($_POST['NombrePaquete'] as $paq => $existe):
                if (str_contains($paq, 'e')) {
                    $pexist = $_POST['NombrePaquete'];//[$paq];
                    if (!empty($pexist) && isset($pexist)) {
                        for ($i = 0; $i < count($pexist); $i++) {
                            $IdPaquete = $_POST['IdPaquete'][$paq][$i];
                            $paquete->values[] = "" . $_POST['NombrePaquete'][$paq][$i] . "";
                            $paquete->values[] = "" . $_POST['Caracteristicas'][$paq][$i] . "";
                            $paquete->values[] = "" . $_POST['IdSistema'] . "";

                            $paquete->updatePaquete($IdPaquete);
                            $paquete->values = array();
                        }
                        $pexist = array();
                    }
                }else if (str_contains($paq, 'n')) {
                    $pnew = $_POST['NombrePaquete'][$paq];
                    if (!empty($pnew) && isset($pnew)) {
                        for ($i = 0; $i < count($pnew); $i++) {
                            $paquete->values[] = "'" . $_POST['NombrePaquete'][$paq][$i] . "'";
                            $paquete->values[] = "'" . $_POST['Caracteristicas'][$paq][$i] . "'";
                            $paquete->values[] = "" . $_POST['IdSistema'] . "";

                            $paquete->insertPaquete();
                            $paquete->values = array();
                        }
                        $pnew = array();
                    }
                }

            endforeach;
        }

        if (!empty($_POST['IdPaquete']) && isset($_POST['IdPaquete'])) {    
            foreach ($_POST['IdPaquete'] as $key => $paq):
                if (str_contains($key, 'e'))
                    $pexist = $paq;
                else if (str_contains($key, 'r'))
                    $premove = $paq;
            endforeach;

            for ($i = 0; $i < count($premove); $i++) {
                if ($pexist !== null){
                    $valid = in_array($premove[$i], $pexist);
                    
                    if (!in_array($premove[$i], $pexist)) {
                        $paquete->deletePaquete($premove[$i]);
                    }
                }
            } 
        } 
        //echo '<script>location.replace("index.php?page=SistemasAdmin");</script>';

    } elseif ($actionpaq === 'update') {

        $paquete->values[] = "" . $_POST['NombrePaquete'] . "";
        $paquete->values[] = "" . $_POST['Caracteristicas'] . "";
        $paquete->values[] = "'" . $_POST['IdSistema'] . "'";

        $paquete->updatePaquete($IdPaquete);

        //echo '<script>location.replace("index.php?page=PaqueteAdmin&upd=Ok");</script>';

    } elseif ($actionpaq === 'delete') {

        $paquete->deletePaqueteWhereSistema($IdSistema);

         //echo '<script>location.replace("index.php?page=PaqueteAdmin&del=Ok");</script>';
    }
}