<?php
include_once '../phpfragments/validations.php';
$breed = new BreedTable();
$success_saved = NULL;
if (is_creating_new_object()) {
    $id_pet_type = filter_input(INPUT_POST, 'type');
    $name = filter_input(INPUT_POST, 'breedname');
    $success_saved = $breed->insert($name, $id_pet_type, $companyId);
    $saved = $success_saved;
} else if (is_updating_object()) {
    $id = filter_input(INPUT_POST, 'idrecord');
    $name = filter_input(INPUT_POST, 'updatedname');
    $success_saved = $breed->update($id, $name);
    $updated = $success_saved;
} else if (is_deleting_object()) {
    $id = filter_input(INPUT_POST, 'idrecord');
    $success_saved = $breed->delete($id);
    $deleted = $success_saved;
}
if ($success_saved !== NULL && $success_saved === FALSE) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($breed->getError());
}