<?php
include_once '../phpfragments/validations.php';
$vaccine = new VaccineTable();
$success_saved = NULL;
if (is_creating_new_object()) {
    $name = filter_input(INPUT_POST, 'newname');
    $success_saved = $vaccine->insert($name, $companyId);
    $saved = $success_saved;
} else if (is_updating_object()) {
    $id = filter_input(INPUT_POST, 'idrecord');
    $name = filter_input(INPUT_POST, 'updatedname');
    $success_saved = $vaccine->update($id, $name);
    $updated = $success_saved;
} else if (is_deleting_object()) {
    $id = filter_input(INPUT_POST, 'idrecord');
    $success_saved = $vaccine->delete($id);
    $deleted = $success_saved;
}
if ($success_saved !== NULL && $success_saved === FALSE) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($vaccine->getError());
}