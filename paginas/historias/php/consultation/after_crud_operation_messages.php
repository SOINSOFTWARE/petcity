<?php

if (isset($generaldatasaved) && isset($saved)) {
    if ($generaldatasaved && $saved) {
        show_success_message('La consulta m&eacute;dica ha sido guardada exitosamente.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405).');
    }
} else if (isset($generaldatasaved) || isset($saved)) {
    show_error_message('Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405).');
}
if (isset($controldeleted)) {
    if ($controldeleted) {
        show_success_message('El control ha sido eliminado exitosamente.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405).');
    }
}
if (isset($examdeleted)) {
    if ($examdeleted) {
        show_success_message('El ex&aacute;men ha sido eliminado exitosamente.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405).');
    }
}
if (isset($evidencedeleted)) {
    if ($evidencedeleted) {
        show_success_message('La evidencia ha sido eliminado exitosamente.');
    } else {
        show_error_message('Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405).');
    }
}