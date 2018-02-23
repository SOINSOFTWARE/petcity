<?php

include_once '../phpfragments/validations.php';
include_once './php/owner_pet/data_loader.php';
$clinichistory = new ClinicHistoryTable();
$owner = new OwnerTable();
$pet = new PetTable();
$success_saved = FALSE;
if (is_viewing_object()) {
    $id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
    $results = $clinichistory->selectById($id_clinic_history);
    $rows = mysqli_fetch_array($results);
    if ($rows !== NULL) {
        $record_custom_id = $rows['recordcustomid'];

        $id_owner = $rows['idowner'];
        $document = $rows['document'];
        $owner_name = $rows['ownername'];
        $last_name = $rows['lastname'];
        $owner_email = $rows['email'];
        $address = $rows['address'];
        $phone1 = $rows['phone'];
        $phone2 = $rows['phone2'];

        $id_pet = $rows['idpet'];
        $pet_name = $rows['petname'];
        $id_pet_type = $rows['idpettype'];
        $pet_type = $rows['pettypename'];
        $id_breed = $rows['idbreed'];
        $pet_breed = $rows['breedname'];
        $id_reproduction = $rows['idreproduction'];
        $color = $rows['color'];
        $sex = $rows['sex'];
        $born_place = $rows['bornplace'];
        $pet_photo = $rows['photo'];
        $history = $rows['history'];
        $born_date = format_string_date($rows['borndate'], "m/Y");
    }
} else if (is_creating_new_object() || is_updating_object()) {
    $id_clinic_history = filter_input(INPUT_POST, 'idhistory');
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

    $is_owner_saved = save_owner_data($owner, $id_owner, $document, $owner_name, $last_name, $owner_email, $address, $phone1, $phone2, $companyId);
    if ($is_owner_saved === TRUE) {
        if (is_creating_new_object()) {
            $id_owner = $owner->selectLastInsertId();
        }
        $is_pet_saved = save_pet_data($pet, $id_pet, $pet_name, $color, $sex, $full_born_date, $born_place, $pet_photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $companyId);
        if ($is_pet_saved === TRUE) {
            if (is_creating_new_object()) {
                $id_pet = $pet->selectLastInsertId();
                $is_clinic_history_saved = $clinichistory->insert($id_pet, $companyId);
                if ($is_clinic_history_saved === TRUE) {
                    $id_clinic_history = $clinichistory->selectLastInsertId();
                    $success_saved = TRUE;
                } else {
                    saveError($clinichistorysaved->getError());
                }
            } else {
                $success_saved = TRUE;
            }
        } else {
            saveError($pet->getError());
        }
    } else {
        saveError($owner->getError());
    }
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
