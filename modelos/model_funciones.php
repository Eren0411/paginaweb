<?php

require_once ("recursos/config/db.php");
require_once ("controladores/controller_funciones.php");
require_once ("modelos/model_archivos.php");


$funcion = new Funciones();
$funcion->setTable("Funciones");
$funcion->setView('view_funciones');

$funcion->setKey('IdFuncion');

$funcion->setColumns('Funcion');
$funcion->setColumns('Descripcion');
$funcion->setColumns('IdSistema');

$funcion->setFk('IdSistema');

if ((!empty($_GET['IdFuncion'])) && (isset($_GET['IdFuncion']))) {
    $IdFuncion = $_GET['IdFuncion'];
    $dtfuncionwhere = $funcion->getWhere($IdFuncion);
    $dtviewfuncion = $funcion->getWhereview($IdFuncion);
    // } else if ((!empty($_POST['IdFuncion'])) && (isset($_POST['IdFuncion']))) {
//     $IdFuncion = $_POST['IdFuncion'];
//     $dtfuncionwhere = $funcion->getWhere($IdFuncion);
//     $dtviewfuncion = $funcion->getWhereview($IdFuncion);
} else if ((!empty($_GET['IdSistema'])) && (isset($_GET['IdSistema']))) {
    $IdSistema = $_GET['IdSistema'];
    $dtfuncionwhere = $funcion->getWhereFK($_GET['IdSistema']);
} else if ((!empty($_GET['IdDetSis'])) && (isset($_GET['IdDetSis']))) {
    $dtfuncview = $funcion->getWhereVS($_GET['IdDetSis']);
} else {
    $IdFuncion = null;
    $dtfuncionwhere = null;
    $dtviewfuncion = null;
    $dtfunciones = $funcion->getAll();
    $dtfuncview = $funcion->getView();
}

$fexist = array();
// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionfunc'])) && (isset($_GET['actionfunc']))) {
    $actionfunc = $_GET['actionfunc'];

    if ($actionfunc === 'insert') {

        if (!empty($_POST['Funcion']) && isset($_POST['Funcion'])) {
            foreach ($_POST['Funcion'] as $func => $existe):
                if (str_contains($func, 'e')) {
                    $fexist = $_POST['Funcion'][$func];
                    if (!empty($fexist) && isset($fexist)) {
                        for ($i = 0; $i < count($fexist); $i++) {
                            $IdFuncion = $_POST['IdFuncion'][$func][$i];
                            $funcion->values[] = "" . $_POST['Funcion'][$func][$i] . "";
                            $funcion->values[] = "" . $_POST['Descripcion'][$func][$i] . "";
                            $funcion->values[] = "" . $_POST['IdSistema'] . "";

                            $funcion->updateFuncion($IdFuncion);
                            $funcion->values = array();
                        }
                        $fexist = array();
                    }
                }else if (str_contains($func, 'n')) {
                    $fnew = $_POST['Funcion'][$func];
                    if (!empty($fnew) && isset($fnew)) {
                        for ($i = 0; $i < count($fnew); $i++) {
                            $funcion->values[] = "'" . $_POST['Funcion'][$func][$i] . "'";
                            $funcion->values[] = "'" . $_POST['Descripcion'][$func][$i] . "'";
                            $funcion->values[] = "" . $_POST['IdSistema'] . "";

                            $funcion->insertFuncion();
                            $funcion->values = array();
                        }
                        $fnew = array();
                    }
                }

            endforeach;
        }

        if (!empty($_POST['IdFuncion']) && isset($_POST['IdFuncion'])) {    
            foreach ($_POST['IdFuncion'] as $key => $func):
                if (str_contains($key, 'e'))
                    $fexist = $func;
                else if (str_contains($key, 'r'))
                    $fremove = $func;
            endforeach;

            for ($i = 0; $i < count($fremove); $i++) {
                if ($fexist !== null){
                    $valid = in_array($fremove[$i], $fexist);
                    
                    if (!in_array($fremove[$i], $fexist)) {
                        $funcion->deleteFuncion($fremove[$i]);
                    }
                }
            } 
        } 
        echo '<script>location.replace("index.php?page=SistemasAdmin");</script>';

    } elseif ($actionfunc === 'update') {

        foreach ($dtserviciowhere as $rowid):
            $IdArchivoServ = $rowid['IdArchivo'];
        endforeach;

        $funcion->values[] = "" . $_POST['Nombre'] . "";
        $funcion->values[] = "" . $_POST['Descripcion'] . "";
        $funcion->values[] = "'" . $_POST['IdSistema'] . "'";

        $funcion->updateFuncion($IdFuncion);

        echo '<script>location.replace("index.php?page=FuncionesAdmin&upd=Ok");</script>';

    } elseif ($actionfunc === 'delete') {

        $funcion->deleteFunctionWhereSistema($IdSistema);

         echo '<script>location.replace("index.php?page=FuncionesAdmin&del=Ok");</script>';
    }
}