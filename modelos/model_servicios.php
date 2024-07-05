<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_servicios.php");
require_once("modelos/model_archivos.php");


$servicio = new Servicios();
$servicio->setTable("Servicios");
$servicio->setView('view_servicios');

$servicio->setKey('IdServicio');

$servicio->setColumns('Nombre');
$servicio->setColumns('Descripcion');
$servicio->setColumns('IdArchivo');

$servicio->setColumnsView('NombreServicio');
$servicio->setColumnsView('Descripcion');

if ((!empty($_GET['IdServicio'])) && (isset($_GET['IdServicio']))) {
    $IdServicio = $_GET['IdServicio'];
    $dtserviciowhere = $servicio->getWhere($IdServicio);
    $dtviewservicio = $servicio->getWhereview($IdServicio);
} else if ((!empty($_POST['IdServicio'])) && (isset($_POST['IdServicio']))) {
    $IdServicio = $_POST['IdServicio'];
    $dtserviciowhere = $servicio->getWhere($IdServicio);
    $dtviewservicio = $servicio->getWhereview($IdServicio);
} else {
    $IdServicio = null;
    $dtserviciowhere = null;
    $dtviewservicio = null;

    if (!empty($_GET['page']) && $_GET['page'] == "Servicios") {
        $dtservview = !empty($_POST['filter']) ? $servicio->getWhereFilter($_POST['filter']) : $servicio->getView();
        $filter = $_POST['filter'] ?? "";
    } else {
        $dtservview = $servicio->getView();
    }    // $dtproductos = $productos->getAll();

    // $dtservicio = $servicio->getAll();
}


// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionserv'])) && (isset($_GET['actionserv']))) {
    $actionserv = $_GET['actionserv'];

    if ($actionserv === 'insert') {

        $servicio->values[] = "'" . $_POST['Nombre'] . "'";
        $servicio->values[] = "'" . $_POST['Descripcion'] . "'";
        $servicio->values[] = $Idfile;

        $servicio->insertServicio();

        echo '<script>location.replace("index.php?page=ServiciosAdmin&ins=Ok");</script>';

    } elseif ($actionserv === 'update') {

        foreach ($dtserviciowhere as $rowid):
            $IdArchivoServ = $rowid['IdArchivo'];
        endforeach;

        $servicio->values[] = "" . $_POST['Nombre'] . "";
        $servicio->values[] = "" . $_POST['Descripcion'] . "";

        if($Idfile !== "NULL"){
            $servicio->values[] = $Idfile;
        }else{
            $servicio->values[] = $IdArchivoServ;
        }

        $servicio->updateServicio($IdServicio);

        echo '<script>location.replace("index.php?page=ServiciosAdmin&upd=Ok");</script>';

    } elseif ($actionserv === 'delete') {
        foreach ($dtserviciowhere as $rowid):
            $IdArchivoServ = $rowid['IdArchivo'];
        endforeach;

        $servicio->deleteServicio($IdServicio);

        if (isset($IdArchivoServ)) {
            $archivo->deleteArchivo($IdArchivoServ);
        }

        echo '<script>location.replace("index.php?page=ServiciosAdmin&del=Ok");</script>';
    }
}