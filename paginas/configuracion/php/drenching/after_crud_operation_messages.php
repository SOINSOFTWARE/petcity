<?php

if (isset($saved) || isset($updated) || isset($deleted)) {
    if (isset($saved)) {
        if ($saved) {
            show_success_message('Un nuevo producto antiparasitario ha sido creado.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    } else if (isset($updated)) {
        if ($updated) {
            show_success_message('El producto antiparasitario ha sido actualizado.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar actualizar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    } else if (isset($deleted)) {
        if ($deleted) {
            show_success_message('El producto antiparasitario ha sido eliminado.');
        } else {
            show_error_message('Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
        }
    }
}