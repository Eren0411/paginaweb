<?php
require_once("modelos/model_sistemas.php");
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Web | Editar Sistema</title>
        <style>
            
        </style>
    </head>

    <body>
        <div class="edicionProd-container container">
            <h1 class="edicionProd-heading text-center">Edición de Sistema</h1>
            <?php
            $Id = "";
            $Nombre = "";
            $Descripcion = "";
            $Requisitos = "";
            $TpFileSis = "";
            $FileSis = "";
            $IdFile = "";
            $TipoSistema = "";
            $Videos = "";

            if (isset($dtviewsistema)) {
                foreach ($dtviewsistema as $row) :
                    $Id = $row["IdSistema"];
                    $Nombre = $row["Nombre"];
                    $Descripcion = $row["Descripcion"];
                    $Requisitos = $row["Requisitos"];
                    $TpFileSis = $row["Tipo"];
                    $FileSis = $row["Archivo"];
                    $IdFile = $row["IdArchivo"];
                    $TipoSistema = $row["TipoSistema"];
                endforeach;
            }

            $actionS = "";
            $actionF = "";
            $actionS = (!empty($Id) && isset($Id)) ? "update" : "insert";
            $actionF = (!empty($IdFile) && isset($IdFile)) ? "update" : "insert";

            $action = "index.php?page=SistemasAdmin&actionsist=$actionS&actionfile=$actionF";
            ?>
            <form method="post" action="<?php echo $action ?>" enctype="multipart/form-data">
                <div class="form-group form-group-custom">
                    <h5>Seleccione la imagen para el logo del sistema</h5>
                    <input id="Archivo" name="Archivo" class="form-control form-control-custom form-control-lg" type="file" onchange="myimg()" />
                </div>
                <div class="form-group form-group-custom">
                    <h5>Seleccione la imagen para el encabezado del sistema</h5>
                    <input id="Header" name="Header" class="form-control form-control-custom form-control-lg" type="file" onchange="myimg()"/>
                </div>
                <div class="form-floating form-group-custom">
                    <input id="Nombre" name="Nombre" class="form-control form-control-custom" value="<?php echo $Nombre ?>" type="text" placeholder="Nombre del sistema" required />
                    <label for="Nombre">Nombre del sistema</label>
                </div>
                <div class="form-floating form-group form-group-custom">
                    <textarea id="Descripcion" name="Descripcion" class="form-control form-control-custom" rows="5" placeholder="Inserte la descripción del sistema" style="resize: none; min-height: 90px"><?php echo $Descripcion ?></textarea>
                    <label for="Descripcion">Descripción del sistema</label>
                </div>
                <div class="form-floating form-group form-group-custom">
                    <textarea id="Requisitos" name="Requisitos" class="form-control form-control-custom" rows="5" placeholder="Inserte los requisitos del sistema" style="resize: none; min-height: 90px"><?php echo $Requisitos ?></textarea>
                    <label for="Requisitos">Requisitos del sistema</label>
                </div>

                <div class="form-floating form-group form-group-custom">
                    <select id="TipoSistema" name="TipoSistema" class="form-select form-select-custom" value="<?php echo $TipoSistema ?>">
                        <option disabled selected hidden >Selecciona un sistema</option>
                        <option value="Propio" >Sistema Propio</option>
                        <option value="Terceros">Sistema de Terceros</option>
                    </select>
                    <label for="TipoSistema">Tipo de Sistema</label>
                </div>

                <div class="form-group form-group-custom">
                    <input id="Gallery" name="Gallery[]" class="form-control form-control-custom form-control-lg" type="file" multiple />
                </div>

                <div style="display: none;">
                    <input id="IdSistema" name="IdSistema" value="<?php echo $Id ?>" hidden readonly />
                    <input id="IdArchivo" name="IdArchivo" value="<?php echo $IdFile ?>" hidden readonly />
                </div>

                <div class="form-group form-group-custom">
                    <img class="img-thumbnail img-thumbnailProd" id="muestra" src="data:<?php echo $TpFileSis ?>;base64,<?php echo (base64_encode($FileSis)) ?>" alt="Imagen seleccionada" />
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-success btn-success-custom">Enviar</button>
                    <a href="index.php?page=SistemasAdmin" class="btn btn-success btn-success-custom">Volver</a>
                </div>
            </form>
        </div>

        <script>
            function myimg() {
                var input = document.getElementById('Archivo');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('muestra').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script>
            function agregarInput() {
                var container = document.getElementById('inputContainer');
                var newInputGroup = document.createElement('div');
                newInputGroup.className = 'input-group function-input-group';
                newInputGroup.innerHTML = `
                    <div class="form-floating form-group form-group-custom function-form-group-custom">
                        <input type="text" name="funcion[]" class="form-control form-control-custom function-form-control-custom function-form" value="" required>
                        <label class="function-label">Agrega Funciones al Sistema</label>
                    </div>
                    <button type="button" onclick="eliminarInput(this)" class="contacto-button function-delete-btn">Eliminar</button>
                `;
                container.appendChild(newInputGroup);
            }

            function eliminarInput(btn) {
                var container = document.getElementById('inputContainer');
                var inputGroup = btn.parentElement;
                container.removeChild(inputGroup);
            }

            function valSel(x, val) {
                const select = document.getElementById(x);
                if (select != null) {
                    // const valor = select.value;
                    const selectnew = select.children;
                
                    for (k = 0; k < selectnew.length; k++) {
                        if (selectnew[k].value == val) {
                            selectnew[k].setAttribute("selected", "");
                        } else {
                            selectnew[k].removeAttribute("selected");
                        }
                    }
                }
            }
                valSel('TipoSistema',<?php echo "'".$TipoSistema."'" ?>);
        </script>
    </body>

</html>