<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_archivos.php");


$archivo = new Archivos();
$archivo->setTable("Archivos");
$archivo->setView('');

$archivo->setKey('IdArchivo');

$archivo->setColumns('Archivo');
$archivo->setColumns('MimeType');
// $archivo->setColumns('Descripcion');

$dtarc = $archivo->getAll();

if ((!empty($_POST['IdArchivo'])) && (isset($_POST['IdArchivo']))) {
    $IdArchivo = $_POST['IdArchivo'];
    $dtarchwhere = $archivo->getWhere($IdArchivo);
} else {
    $IdArchivo = "";
}

$dir_doc = "recursos/Archivos/";

// $fch_r = date('Y-m-d');     //OBTIENE LA FECHA ACTUAL

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actionfile'])) && (isset($_GET['actionfile']))) {

    $actionfile = $_GET['actionfile'];

    $archivoname = $_FILES['Archivo']['name'];
    $archivotype = $_FILES['Archivo']['type'];
    $archivosize = $_FILES['Archivo']['size'];
    $archivofile = $_FILES['Archivo']['tmp_name'];

    if ($actionfile === 'insert') {

        //VERIFICA QUE $_FILES NO ESTE VACIO Y QUE SI CONTENGA ALGUN OBJETO
        if (!empty($archivofile) && isset($archivofile)) {

            $upload = new ArchivosModel();
            $arch = $upload->uploadFile($archivoname, $archivotype, $archivosize, $archivofile);

            // COMPROBAMOS QUE TODOS LOS ARCHIVOS HAYAN SIDO CORRECTOS
            if ($arch == 0) {
                echo '<script>alert("Ocurrio un error al cargar el archivo, favor de verificar o intente nuevamente.");</script>';
                echo '<script>location.replace("index.php?page=' . $_GET['page'] . '&ins=Error");</script>';
            } else {

                //  MOVEMOS EL ARCHIVO A UNA RUTA DEL SERVIDOR LOCAL DE MANERA TEMPORAL
                $dir_file = $dir_doc . basename($archivoname);   //  ATRAPA EL ARCHIVO
                $typefile = strtolower(pathinfo($dir_file, PATHINFO_EXTENSION)); //  OBTIENE LA INFORMACION DEL ARCHIVO COMO: RUTA, NOMBRE Y EXTENSION
                $rtfile = $dir_doc . "Archivo_" . $archivoname . $typefile;
                $filetype = mime_content_type($rtfile);

                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->insertArchivo($arch, $filetype);
                $Idfile = $archivo->lastId();

                // BORRA LOS ARCHIVOS QUE SE GUARDARON TEMPORALMENTE EN EL SERVIDOR
                unlink($rtfile);
            }
        } else {
            $Idfile = "NULL";
        }
    } else if ($actionfile === 'update') {
        //VERIFICA QUE $_FILES NO ESTE VACIO Y QUE SI CONTENGA ALGUN OBJETO
        if (!empty($archivofile) && isset($archivofile)) {
            $upload = new ArchivosModel();
            $arch = $upload->uploadFile($archivoname, $archivotype, $archivosize, $archivofile);

            // COMPROBAMOS QUE TODOS LOS ARCHIVOS HAYAN SIDO CORRECTOS
            if ($arch == 0) {
                echo '<script>alert("Ocurrio un error al cargar el archivo, favor de verificar o intente nuevamente.");</script>';
                echo '<script>location.replace("index.php?page=' . $_GET['page'] . '&ins=Error");</script>';
            } else {

                //  MOVEMOS EL ARCHIVO A UNA RUTA DEL SERVIDOR LOCAL DE MANERA TEMPORAL
                $dir_file = $dir_doc . basename($archivoname);   //  ATRAPA EL ARCHIVO
                $typefile = strtolower(pathinfo($dir_file, PATHINFO_EXTENSION)); //  OBTIENE LA INFORMACION DEL ARCHIVO COMO: RUTA, NOMBRE Y EXTENSION
                $rtfile = $dir_doc . "Archivo_" . $archivoname . $typefile;
                $filetype = mime_content_type($rtfile);

                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->updateArchivo($IdArchivo, $arch, $filetype);

                // BORRA LOS ARCHIVOS QUE SE GUARDARON TEMPORALMENTE EN EL SERVIDOR
                unlink($rtfile);
            }
        }
        $Idfile = $IdArchivo;
    }
}

?>