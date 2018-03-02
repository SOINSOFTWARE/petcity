<?php
if (isset($success_saved)) {
    if ($success_saved) {
        show_success_message('Los datos de la veterinaria han sido actualizados.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar actualizar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
    }
}