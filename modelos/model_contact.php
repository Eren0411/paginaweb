<?php

require_once('controladores/controller_contact.php');
require_once('modelos/model_configuraciones.php');

foreach($dtcontactos as $row):
    switch ($row["CampoKey"]) {
        case "CorreoEnvios":
            $CorreoEnvios = $row["Descripcion"] ?? "";
            break;
        }
endforeach;

$contact = new ContactMail();
if(!empty($_POST) && isset($_POST)){
    $contact->setTo($CorreoEnvios);
    $contact->setFrom($_POST['Email']);
    $contact->setContent($contact->GenerarContenido($_POST['Nombre'], $_POST['Telefono'], $_POST['Msj']));
    $contact->setAsunto("" . $_POST['IdAsunto'] . $_POST['Asunto'] . "");
    $contact->SendMail();
}

?>