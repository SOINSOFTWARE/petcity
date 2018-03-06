<?php

if (isset($generaldatasaved) || isset($saved)) {
    if (isset($saved) && $saved) {
        show_success_message('La vacunaci&oacute;n ha sido guardada exitosamente.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
    }
}