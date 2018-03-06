<?php

function is_creating_new_object() {
    return filter_input(INPUT_POST, 'new') !== NULL;
}
function is_updating_object() {
    return filter_input(INPUT_POST, 'update') !== NULL;
}
function is_deleting_object() {
    return filter_input(INPUT_POST, 'delete') !== NULL;
}
function is_viewing_object() {
    return filter_input(INPUT_POST, 'view') !== NULL;
}

function get_numeric_value($numeric_var) {
    if (!isset($numeric_var) || $numeric_var === NULL) {
        $numeric_var = 0;
    }
    return $numeric_var;
}

function get_string_value($string_var) {
    if (!isset($string_var) || $string_var === NULL) {
        $string_var = '';
    }
    return $string_var;
}

function get_boolean_from_db_value($boolean_db_var) {
    if (!isset($boolean_db_var) || $boolean_db_var === NULL || intval($boolean_db_var) == 1) {
        return FALSE;
    }
    return TRUE;
}

function get_boolean_for_db_value($boolean_var) {
    if (!isset($boolean_var) || $boolean_var === NULL || !boolval($boolean_var)) {
        return 1;
    }
    return 0;
}