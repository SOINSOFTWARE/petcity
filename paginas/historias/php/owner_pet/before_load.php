<?php

include_once '../phpfragments/validations.php';
include_once './php/owner_pet/data_loader.php';
$company_table = new CompanyTable();
$clinichistory_table = new ClinicHistoryTable();
$owner_table = new OwnerTable();
$pet_table = new PetTable();
$success_saved = FALSE;
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
$owner = new Owner(0, '', '', '', '', '', '', '', $companyId);
$pet = new Pet(0, '', '', 'M', '', '', '', '', '', 0, 0, 0, $companyId);
$pet->owner = $owner;
$clinic_history = new ClinicHistory($id_clinic_history, 0, $companyId, $current_clinic_history_id);
$clinic_history->pet = $pet;
if (is_creating_new_object() || is_updating_object()) {
    $record_custom_id = filter_input(INPUT_POST, 'recordcustomid');
    $id_owner = filter_input(INPUT_POST, 'idowner');
    $document = str_replace("_", "", filter_input(INPUT_POST, 'ownerdocument'));
    $owner_name = filter_input(INPUT_POST, 'ownername');
    $last_name = filter_input(INPUT_POST, 'ownerlastname');
    $owner_email = filter_input(INPUT_POST, 'owneremail');
    $address = filter_input(INPUT_POST, 'owneraddress');
    $phone1 = str_replace("_", "", filter_input(INPUT_POST, 'ownerphone'));
    $phone2 = str_replace("_", "", filter_input(INPUT_POST, 'ownerphone2'));

    $id_pet = filter_input(INPUT_POST, 'idpet');
    $pet_name = filter_input(INPUT_POST, 'petname');
    $id_pet_type = filter_input(INPUT_POST, 'pettype');
    $pet_type = filter_input(INPUT_POST, 'pettypename');
    $id_breed = filter_input(INPUT_POST, 'petbreed');
    $pet_breed = filter_input(INPUT_POST, 'petbreedname');
    $id_reproduction = filter_input(INPUT_POST, 'petreproduction');
    $color = filter_input(INPUT_POST, 'petcolor');
    $sex = filter_input(INPUT_POST, 'petsex');
    $born_date = filter_input(INPUT_POST, 'petborndate');
    $born_place = filter_input(INPUT_POST, 'petbornplace');
    $pet_photo = upload_photo_to_server($companyId, filter_input(INPUT_POST, 'petphoto'));
    $history = filter_input(INPUT_POST, 'history');
    $full_born_date = get_full_born_date($born_date);

    if (intval($id_breed) == -1) {
        $id_breed = save_pet_breed($id_pet_type, $pet_breed, $companyId);
    }

    $is_owner_saved = save_owner_data($owner_table, $id_owner, $document, $owner_name, $last_name, $owner_email, $address, $phone1, $phone2, $companyId);
    if ($is_owner_saved === TRUE) {
        if (is_creating_new_object()) {
            $id_owner = $owner_table->selectLastInsertId();
        }
        $is_pet_saved = save_pet_data($pet_table, $id_pet, $pet_name, $color, $sex, $full_born_date, $born_place, $pet_photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $companyId);
        if ($is_pet_saved === TRUE) {
            if (is_creating_new_object()) {
                $id_pet = $pet_table->selectLastInsertId();
                $is_clinic_history_saved = $clinichistory_table->insert($id_pet, $companyId, $record_custom_id);
                if ($is_clinic_history_saved === TRUE) {
                    if ($record_custom_id == $current_clinic_history_id) {
                        $id_clinic_history = $clinichistory_table->selectLastInsertId();
                        $company_table->updateActualCustomId($companyId, $record_custom_id + 1);
                        $_SESSION['petcity_actualcustomid'] = $record_custom_id + 1;
                    }
                }
            } else {
                $is_clinic_history_saved = $clinichistory_table->update($id_clinic_history, $record_custom_id);
            }
            if ($is_clinic_history_saved === TRUE) {
                $success_saved = TRUE;
            } else {
                saveError($clinichistory_table->getError());
            }
        } else {
            saveError($pet_table->getError());
        }
    } else {
        saveError($owner_table->getError());
    }
}
if (!is_null($id_clinic_history)) {
    $clinic_history = load_clinic_history($clinichistory_table, $id_clinic_history, $clinic_history);
}

function saveError($log) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($log);
}

function get_full_born_date($born_date) {
    $format = "d/m/Y H:i:s";
    $complete_born_date = "01/" . $born_date . ' 00:00:00';
    return DateTime::createFromFormat($format, $complete_born_date)->format("Y-m-d");
}

function save_owner_data($owner, $id_owner, $document, $owner_name, $last_name, $owner_email, $address, $phone1, $phone2, $companyId) {
    $is_saved = FALSE;
    if (is_creating_new_object()) {
        $is_saved = $owner->insert($document, $owner_name, $last_name, $owner_email, $address, $phone1, $phone2, $companyId);
    } else {
        $is_saved = $owner->update($id_owner, $document, $owner_name, $last_name, $owner_email, $address, $phone1, $phone2);
    }
    return $is_saved;
}

function save_pet_data($pet, $id_pet, $pet_name, $color, $sex, $full_born_date, $born_place, $pet_photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $companyId) {
    $is_saved = FALSE;
    if (is_creating_new_object()) {
        $is_saved = $pet->insert($pet_name, $color, $sex, $full_born_date, $born_place, $pet_photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $companyId);
    } else {
        $is_saved = $pet->update($id_pet, $pet_name, $color, $sex, $full_born_date, $born_place, $pet_photo, $history, $id_reproduction, $id_pet_type, $id_breed);
    }
    return $is_saved;
}

function upload_photo_to_server($companyId, $pet_photo) {
    if ($_FILES["pet_photo_file"]["tmp_name"] != NULL && $_FILES["pet_photo_file"]["tmp_name"] != '') {
        $targetdir = '../../pets/' . $companyId . "/";
        $filepath = $targetdir . rand() . basename($_FILES["pet_photo_file"]["name"]);
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        if (move_uploaded_file($_FILES["pet_photo_file"]["tmp_name"], $filepath)) {
            return $filepath;
        } else {
            return $pet_photo;
        }
    } else {
        return $pet_photo;
    }
}

function save_pet_breed($id_pet_type, $name, $companyId) {
    include_once '../../php/breed.php';
    $breed = new BreedTable();
    $success_saved = $breed->insert($name, $id_pet_type, $companyId);
    if (!$success_saved) {
        saveError($breed->getError());
    }
    return $breed->selectLastInsertId();
}

function load_clinic_history($clinichistory_table, $id_clinic_history, $clinic_history) {
    $results = $clinichistory_table->selectById($id_clinic_history);
    $rows = mysqli_fetch_array($results);
    if ($rows !== NULL) {
        $clinic_history->pet->owner->id = $rows['idowner'];
        $clinic_history->pet->owner->document = $rows['document'];
        $clinic_history->pet->owner->name = $rows['ownername'];
        $clinic_history->pet->owner->last_name = $rows['lastname'];
        $clinic_history->pet->owner->email = $rows['email'];
        $clinic_history->pet->owner->address = $rows['address'];
        $clinic_history->pet->owner->phone1 = $rows['phone'];
        $clinic_history->pet->owner->phone2 = $rows['phone2'];

        $clinic_history->pet->id = $rows['idpet'];
        $clinic_history->pet->id_owner = $rows['idowner'];
        $clinic_history->pet->name = $rows['petname'];
        $clinic_history->pet->id_pet_type = $rows['idpettype'];
        $clinic_history->pet->type_name = $rows['pettypename'];
        $clinic_history->pet->id_breed = $rows['idbreed'];
        $clinic_history->pet->breed_name = $rows['breedname'];
        $clinic_history->pet->id_reproduction = $rows['idreproduction'];
        $clinic_history->pet->color = $rows['color'];
        $clinic_history->pet->sex = $rows['sex'];
        $clinic_history->pet->born_place = $rows['bornplace'];
        $clinic_history->pet->photo = $rows['photo'];
        $clinic_history->pet->history = $rows['history'];
        $clinic_history->pet->born_date = $rows['borndate'];
        # format_string_date($rows['borndate'], "m/Y");
        
        $clinic_history->id_pet = $rows['idpet'];
        $clinic_history->record_custom_id = $rows['recordcustomid'];
    }
    return $clinic_history;
}
