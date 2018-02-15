<?php
include_once '../phpfragments/validations.php';
$drenching = new DrenchingTable();
$success_saved = NULL;
if (is_creating_new_object()) {
    $name = filter_input(INPUT_POST, 'newname');
    $success_saved = $drenching->insert($name, $companyId);
    $saved = $success_saved;
} else if (is_updating_object()) {
    $id = filter_input(INPUT_POST, 'idrecord');
    $name = filter_input(INPUT_POST, 'updatedname');
    $success_saved = $drenching->update($id, $name);
    $updated = $success_saved;
} else if (is_deleting_object()) {
    $id = filter_input(INPUT_POST, 'idrecord');
    $success_saved = $drenching->delete($id);
    $deleted = $success_saved;
}
if ($success_saved !== NULL && $success_saved === FALSE) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($drenching->getError());
}