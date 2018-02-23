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