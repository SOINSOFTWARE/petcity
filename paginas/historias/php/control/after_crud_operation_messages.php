<?php

if (isset($generaldatasaved) && isset($saved)) {
    if ($generaldatasaved && $saved) {
        show_success_message('El control post-consulta ha sido guardado exitosamente.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405).');
    }
} else if (isset($generaldatasaved) || isset($saved)) {
    show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405).');
}