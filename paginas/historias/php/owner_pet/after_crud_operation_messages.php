<?php

if (isset($is_owner_saved) && isset($is_pet_saved) && isset($is_clinic_history_saved) && $is_owner_saved && $is_pet_saved && $is_clinic_history_saved) {
    show_success_message('Los datos b&aacute;sicos de la historia cl&iacute;nica han sido guardados exitosamente.');
}
if (isset($is_owner_saved) && isset($is_pet_saved) && !isset($is_clinic_history_saved) && $is_owner_saved && $is_pet_saved) {
    show_success_message('Los datos b&aacute;sicos de la historia cl&iacute;nica han sido actualizados exitosamente.');
}
if ((isset($is_owner_saved) && !$is_owner_saved) || (isset($is_pet_saved) && !$is_pet_saved) || (isset($is_clinic_history_saved) && !$is_clinic_history_saved)) {
    show_error_message('Ocurri&oacute; un error al intentar guardar los datos b&aacute;sicos de la historia cl&iacute;nica, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).');
}