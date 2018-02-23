<?php
$id_clinic_history = 0;
$id_owner = 0;
$document = '';
$owner_name = '';
$last_name = '';
$owner_email = '';
$address = '';
$phone1 = '';
$phone2 = '';

$id_pet = 0;
$pet_name = '';
$id_pet_type = 0;
$pet_type = '';
$id_breed = 0;
$pet_breed = '';
$id_reproduction = 0;
$color = '';
$sex = 'M';
$born_place = '';
$pet_photo = '';
$history = '';
$born_date = '';

$record_custom_id = '';

function get_numeric_value($numeric_var) {
    if ($numeric_var === NULL) {
        $numeric_var = 0;
    }
    return $numeric_var;
}

function get_string_value($string_var) {
    if ($string_var === NULL) {
        $string_var = '';
    }
    return $string_var;
}

function print_checked_if_needed($sex, $expected) {
    if (isset($sex)) {
        if ($sex === $expected) {
            echo "checked";
        }
    }
}

function print_id_for_form() {
    if (is_viewing_object() || is_updating_object()) {
        echo 'update';
    } else {
        echo 'new';
    }
}
