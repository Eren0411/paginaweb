<?php

require_once("recursos/config/db.php");
require_once("controladores/controller_configuraciones.php");

$config = new Configuraciones();
$config->setTable("Configuraciones");
$config->setView('');

$config->setKey('CampoKey');

$config->setColumns('Descripcion');

$Contacto = array('Direccion', 'CodigoPostal', 'Ciudad','Estado','Telefono', 'Correo', 'Facebook', 'Instagram', 'Youtube', 'Whatsapp', 'CorreoEnvios');
$Nosotros = array('Mision','Vision','Valores','Somos', 'Empresa');
$Rules = array('Aviso', 'Terminos');
if ((!empty($_GET['CampoKey'])) && (isset($_GET['CampoKey']))) {
    $CampoKey = $_GET['CampoKey'];
    $dtcontactowhere = $config->getWhere($CampoKey);
} else {
    $CampoKey = null;
    $dtcontactowhere = null;
}
$dtcontactos = $config->getAll();

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if ((!empty($_GET['actioncon'])) && (isset($_GET['actioncon']))) {
    $actioncon = $_GET['actioncon'];

    $Values = array();

    if($actioncon === 'contacto'){

        $Values[] = "" . $_POST['Direccion'] . "";
        $Values[] = "" . $_POST['CodigoPostal'] . "";
        $Values[] = "" . $_POST['Ciudad'] . "";
        $Values[] = "" . $_POST['Estado'] . "";
        $Values[] = "" . $_POST['Telefono'] . "";
        $Values[] = "" . $_POST['Correo'] . "";
        $Values[] = "" . $_POST['Facebook'] . "";
        $Values[] = "" . $_POST['Instagram'] . "";
        $Values[] = "" . $_POST['Youtube'] . "";
        $Values[] = "" . $_POST['Whatsapp'] . "";
        $Values[] = "" . $_POST['CorreoEnvios'] . "";

        for($i=0;$i < count($Contacto); $i++){
            $exist = $config->getWhere($Contacto[$i]);
            if(!empty($exist) && $Contacto[$i] === $exist[0]["CampoKey"]){
                $val = $config->column[0] ."='". $Values[$i] ."'";
                $config->updateConfiguracion($Contacto[$i], $val);
            }else{
                $config->values[] = "'" . $Contacto[$i] . "'";
                $config->values[] = "'" . $Values[$i] . "'";
                $config->insertConfiguracion();
                $config->values = array();
            }
            $exist = array();
        }
        echo '<script>location.replace("index.php?page=InfoContacto");</script>';
    }else if($actioncon === 'nosotros'){

        $Values[] = "" . $_POST['Mision'] . "";
        $Values[] = "" . $_POST['Vision'] . "";
        $Values[] = "" . $_POST['Valores'] . "";
        $Values[] = "" . $_POST['Somos'] . "";

        for($i=0;$i < count($Nosotros); $i++){
            $exist = $config->getWhere($Nosotros[$i]);
            if(!empty($exist) && $Nosotros[$i] === $exist[0]["CampoKey"]){
                $val = $config->column[0] ."='". $Values[$i] ."'";
                $config->updateConfiguracion($Nosotros[$i], $val);
            }else{
                $config->values[] = "'" . $Nosotros[$i] . "'";
                $config->values[] = "'" . $Values[$i] . "'";
                $config->insertConfiguracion();
                $config->values = array();
            }
            $exist = array();
        }

        echo '<script>location.replace("index.php?page=NosotrosAdmin");</script>';
    }else if($actioncon === 'rules'){

        $Values[] = "" . $_POST['Aviso'] . "";
        $Values[] = "" . $_POST['Terminos'] . "";

        for($i=0;$i < count($Rules); $i++){
            $exist = $config->getWhere($Rules[$i]);
            if(!empty($exist) && $Rules[$i] === $exist[0]["CampoKey"]){
                $val = $config->column[0] ."='". $Values[$i] ."'";
                $config->updateConfiguracion($Rules[$i], $val);
            }else{
                $config->values[] = "'" . $Rules[$i] . "'";
                $config->values[] = "'" . $Values[$i] . "'";
                $config->insertConfiguracion();
                $config->values = array();
            }
            $exist = array();
        }

        echo '<script>location.replace("index.php?page=TerminosPrivacidad");</script>';
    }
}
