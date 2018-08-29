<?php

if (isset($saved) || isset($updated)) {
    if (isset($saved)) {
        if ($saved) {
            show_success_message('Un nuevo evento ha sido creado.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    } else if (isset($updated)) {
        if ($updated) {
            show_success_message('El evento ha sido actualizado.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar actualizar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    }
}