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