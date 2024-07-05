<?php
require_once('modelos/model_contact.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web | Contacto</title>
</head>

<body>

    <header class="contacto-header">
        <h1>Contacto</h1>
    </header>

    <div class="contacto-form-container container">
        <form id="contacto-form" action="index.php?page=Contacto" method="post">
            <h2>Contacta con Nosotros</h2>
            <div class="form-floating contacto-form-group">
                <input id="Nombre" name="Nombre" class="form-control form-control-custom" type="text" placeholder="Nombre Completo" required />
                <label for="Nombre">Nombre Completo</label>
            </div>
            <div class="form-floating contacto-form-group">
                <input id="Email" name="Email" class="form-control form-control-custom" type="email" placeholder="Correo Electrónico" required>
                <label for="Email">Correo Electrónico:</label>
            </div>
            <div class="form-floating contacto-form-group">
                <input id="Tel" name="Telefono" class="form-control form-control-custom" type="tel" placeholder="Número de Teléfono" required>
                <label for="Tel">Teléfono:</label>
            </div>
            <div class="form-floating form-group form-group-custom">
                <select id="IdAsunto" name="IdAsunto" class="form-select form-select-custom" required>
                    <option value="" disabled selected hidden>Selecciona un motivo</option>
                    <option value="1">Sugerencias</option>
                    <option value="2">Cotización</option>
                    <option value="3">Dudas y Aclaraciones</option>
                    <option value="4">Otros</option>
                </select>
                <label for="IdAsunto">Motivo</label>
            </div>

            <div class="form-floating contacto-form-group">
                <input id="Asunto" name="Asunto" class="form-control form-control-custom" type="text" placeholder="Asunto" required>
                <label for="Asunto">Asunto:</label>
            </div>

            <div class="form-floating contacto-form-group">
                <textarea id="Msj" name="Msj" class="form-control contacto-textarea" placeholder="Mensaje" required></textarea>
                <label for="Msj">Mensaje:</label>
            </div>
            <button type="submit" class="contacto-button">Enviar</button>
        </form>
    </div>

</body>

</html>