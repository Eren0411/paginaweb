<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_preguntas.php");
// require_once("modelos/model_archivos.php");


$preguntas = new Preguntas();
$preguntas->setTable("Preguntas");
$preguntas->setView('view_preguntas');

$preguntas->setKey('IdPregunta');

$preguntas->setColumns('Pregunta');
$preguntas->setColumns('Respuesta');
$preguntas->setColumns('IdRelacion');

$preguntas->setFk('IdRelacion');

if ((!empty($_GET['IdPregunta'])) && (isset($_GET['IdPregunta']))) {
    $IdPregunta = $_GET['IdPregunta'];
    $dtpregwhere = $preguntas->getWhere($IdPregunta);
    $dtviewpreg = $preguntas->getWhereview($IdPregunta);
} else if ((!empty($_POST['IdPregunta'])) && (isset($_POST['IdPregunta']))) {
    $IdPregunta = $_POST['IdPregunta'];
    $dtpregwhere = $preguntas->getWhere($IdPregunta);
    $dtviewpreg = $preguntas->getWhereview($IdPregunta);
}else if ((!empty($_POST['filter'])) && (isset($_POST['filter']))) {
    $filterId = $_POST['filter'];
    $dtpregview = $preguntas->getWhereVS($_POST['filter']);
}else if ((!empty($_GET['IdDetSis'])) && (isset($_GET['IdDetSis']))) {
    $dtpregview = $preguntas->getWhereVS($_GET['IdDetSis']);
} else {
    $IdPregunta = null;
    $dtserviciodtpregwherehere = null;
    $dtviewpreg = null;

    $page = $_GET['page'] ?? null;
    $dtpregunta = ($page === "PreguntasFrecuentes") ? $preguntas->getWhereVS('0') : $preguntas->getAll();
    $dtpregview = $preguntas->getView();
}


// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionpreg'])) && (isset($_GET['actionpreg']))) {
    $actionpreg = $_GET['actionpreg'];

    if ($actionpreg === 'insert') {

        $preguntas->values[] = "'" . $_POST['Pregunta'] . "'";
        $preguntas->values[] = "'" . $_POST['Respuesta'] . "'";
        $preguntas->values[] = "'" . ($_POST['IdRelacion'] ?? "") . "'";

        $preguntas->insertPregunta();

        echo '<script>location.replace("index.php?page=PreguntasAdmin&ins=Ok");</script>';

    } elseif ($actionpreg === 'update') {

        $preguntas->values[] = "" . $_POST['Pregunta'] . "";
        $preguntas->values[] = "" . $_POST['Respuesta'] . "";
        $preguntas->values[] = "" . ($_POST['IdRelacion'] ?? "") . "";

        $preguntas->updatePregunta($IdPregunta);

        echo '<script>location.replace("index.php?page=PreguntasAdmin&upd=Ok");</script>';

    } elseif ($actionpreg === 'delete') {
        $preguntas->deletePregunta($IdPregunta);
        echo '<script>location.replace("index.php?page=PreguntasAdmin&del=Ok");</script>';
    }
}