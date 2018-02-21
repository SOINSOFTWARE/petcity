<?php

if (isset($send) || isset($deleted)) {
    if (isset($send)) {
        if ($send) {
            show_message('Recordatorio enviado!', 'La notificaci&oacute;n fue enviada al correo electr&oacute;nico del propietario.', 'fa fa-check');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar enviar el recordatorio, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    } else if (isset($deleted)) {
        if ($deleted) {
            show_success_message('La nota ha sido eliminada exitosamente.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    }
}