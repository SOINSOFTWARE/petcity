<?php

if (isset($saved) || isset($updated) || isset($deleted)) {
    if (isset($saved)) {
        if ($saved) {
            show_success_message('Un nueva especie ha sido creada.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    } else if (isset($updated)) {
        if ($updated) {
            show_success_message('La especie ha sido actualizada.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar actualizar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    } else if (isset($deleted)) {
        if ($deleted) {
            show_success_message('la especie ha sido eliminada.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    }
}