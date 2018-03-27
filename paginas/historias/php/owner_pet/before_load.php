<?php

include_once '../phpfragments/validations.php';
$clinichistory_table = new ClinicHistoryTable();
$owner_table = new OwnerTable();
$pet_table = new PetTable();
$success_saved = FALSE;
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
$clinic_history = build_empty_clinic_history($id_clinic_history, $current_clinic_history_id, $companyId);
if (filter_input(INPUT_POST, 'save') !== NULL) {
    load_clinic_history_from_post($clinic_history, $companyId);
    save_pet_breed_when_needed($clinic_history, $companyId);
    $is_owner_saved = save_owner_data($owner_table, $clinic_history);
    if ($is_owner_saved) {
        $is_pet_saved = save_pet_data($pet_table, $clinic_history);
        if ($is_pet_saved) {
            $is_clinic_history_saved = save_clinic_history($clinichistory_table, $clinic_history);
            if ($is_clinic_history_saved) {
                $success_saved = TRUE;
                $id_clinic_history = $clinic_history->id;
                update_custom_record_id_when_needed($clinic_history->record_custom_id, $current_clinic_history_id, $companyId);
            } else {
                saveError('Clinic History: ' . $clinichistory_table->getError());
            }
        } else {
            saveError('Pet: ' . $pet_table->getError());
        }
    } else {
        saveError('Owner: ' . $owner_table->getError());
    }
}
if (!is_null($id_clinic_history)) {
    $clinic_history = load_clinic_history($clinichistory_table, $id_clinic_history, $clinic_history);
}

function build_empty_clinic_history($id_clinic_history, $current_clinic_history_id, $id_company) {
    $owner = new Owner(0, '', '', '', '', '', '', '', $id_company);
    $pet = new Pet(0, '', '', 'M', '', '', '', '', '', 0, 0, 0, $id_company);
    $pet->owner = $owner;
    $clinic_history = new ClinicHistory($id_clinic_history, 0, $id_company, $current_clinic_history_id);
    $clinic_history->pet = $pet;
    return $clinic_history;
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

function save_pet_breed_when_needed($clinic_history, $companyId) {
    if ($clinic_history->pet->id_breed == -1) {
        echo 'Saving ' . $clinic_history->pet->breed_name;
        $clinic_history->pet->id_breed = save_pet_breed($clinic_history->pet->id_pet_type, $clinic_history->pet->breed_name, $companyId);
    }
    return $clinic_history;
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

function save_owner_data($owner_dao, $clinic_history) {
    $is_saved = FALSE;
    if ($clinic_history->pet->owner->id == 0) {
        $is_saved = $owner_dao->insertObject($clinic_history->pet->owner);
        if ($is_saved) {
            $clinic_history->pet->owner->id = $owner_dao->selectLastInsertId();
            $clinic_history->pet->id_owner = $clinic_history->pet->owner->id;
        }
    } else {
        $is_saved = $owner_dao->updateObject($clinic_history->pet->owner);
    }
    return $is_saved;
}

function save_pet_data($pet_dao, $clinic_history) {
    $is_saved = FALSE;
    if ($clinic_history->pet->id == 0) {
        $is_saved = $pet_dao->insertObject($clinic_history->pet);
        if ($is_saved) {
            $clinic_history->pet->id = $pet_dao->selectLastInsertId();
            $clinic_history->id_pet = $clinic_history->pet->id;
        }
    } else {
        $is_saved = $pet_dao->updateObject($clinic_history->pet);
    }
    return $is_saved;
}

function save_clinic_history($clinic_his_dao, $clinic_history) {
    $is_saved = FALSE;
    if ($clinic_history->id == 0) {
        $is_saved = $clinic_his_dao->insertObject($clinic_history);
        if ($is_saved) {
            $clinic_history->id = $clinic_his_dao->selectLastInsertId();
        }
    } else {
        $is_saved = $clinic_his_dao->updateObject($clinic_history);
    }
    return $is_saved;
}

function update_custom_record_id_when_needed($id_custom_record, $current_clinic_history_id, $id_company) {
    if (!is_null($id_custom_record) && !is_null($current_clinic_history_id) && $id_custom_record == $current_clinic_history_id) {
        $id_current_cust_rec = $id_custom_record + 1;
        $company_dao = new CompanyTable();
        $company_dao->updateActualCustomId($id_company, $id_current_cust_rec);
        $_SESSION['petcity_actualcustomid'] = $id_current_cust_rec;
    }
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

function load_clinic_history($clinichistory_table, $id_clinic_history, $clinic_history) {
    $results = $clinichistory_table->selectById($id_clinic_history);
    $rows = mysqli_fetch_array($results);
    if ($rows !== NULL) {
        load_owner($clinic_history, $rows);
        load_pet($clinic_history, $rows);
        $clinic_history->id_pet = $rows['idpet'];
        $clinic_history->record_custom_id = $rows['recordcustomid'];
    }
    return $clinic_history;
}

function load_owner($clinic_history, $rows) {
    $clinic_history->pet->owner->id = $rows['idowner'];
    $clinic_history->pet->owner->document = $rows['document'];
    $clinic_history->pet->owner->name = $rows['ownername'];
    $clinic_history->pet->owner->last_name = $rows['lastname'];
    $clinic_history->pet->owner->email = $rows['email'];
    $clinic_history->pet->owner->address = $rows['address'];
    $clinic_history->pet->owner->phone1 = $rows['phone'];
    $clinic_history->pet->owner->phone2 = $rows['phone2'];
    return $clinic_history;
}

function load_pet($clinic_history, $rows) {
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
    return $clinic_history;
}

function load_clinic_history_from_post($clinic_history, $companyId) {
    load_owner_from_post($clinic_history);
    load_pet_from_post($clinic_history, $companyId);
    $clinic_history->id_pet = intval(filter_input(INPUT_POST, 'idpet'));
    $clinic_history->record_custom_id = filter_input(INPUT_POST, 'recordcustomid');
    return $clinic_history;
}

function load_owner_from_post($clinic_history) {
    $clinic_history->pet->owner->id = intval(filter_input(INPUT_POST, 'idowner'));
    $clinic_history->pet->owner->document = str_replace("_", "", filter_input(INPUT_POST, 'ownerdocument'));
    $clinic_history->pet->owner->name = filter_input(INPUT_POST, 'ownername');
    $clinic_history->pet->owner->last_name = filter_input(INPUT_POST, 'ownerlastname');
    $clinic_history->pet->owner->email = filter_input(INPUT_POST, 'owneremail');
    $clinic_history->pet->owner->address = filter_input(INPUT_POST, 'owneraddress');
    $clinic_history->pet->owner->phone1 = str_replace("_", "", filter_input(INPUT_POST, 'ownerphone'));
    $clinic_history->pet->owner->phone2 = str_replace("_", "", filter_input(INPUT_POST, 'ownerphone2'));
    return $clinic_history;
}

function load_pet_from_post($clinic_history, $companyId) {
    $clinic_history->pet->id = intval(filter_input(INPUT_POST, 'idpet'));
    $clinic_history->pet->id_owner = intval(filter_input(INPUT_POST, 'idowner'));
    $clinic_history->pet->name = filter_input(INPUT_POST, 'petname');
    $clinic_history->pet->id_pet_type = intval(filter_input(INPUT_POST, 'pettype'));
    $clinic_history->pet->type_name = filter_input(INPUT_POST, 'pettypename');
    $clinic_history->pet->id_breed = intval(filter_input(INPUT_POST, 'petbreed'));
    $clinic_history->pet->breed_name = filter_input(INPUT_POST, 'petbreedname');
    $clinic_history->pet->id_reproduction = filter_input(INPUT_POST, 'petreproduction');
    $clinic_history->pet->color = filter_input(INPUT_POST, 'petcolor');
    $clinic_history->pet->sex = filter_input(INPUT_POST, 'petsex');
    $clinic_history->pet->born_place = filter_input(INPUT_POST, 'petbornplace');
    $clinic_history->pet->photo = upload_photo_to_server($companyId, filter_input(INPUT_POST, 'petphoto'));
    $clinic_history->pet->history = filter_input(INPUT_POST, 'history');
    $born_date = filter_input(INPUT_POST, 'petborndate');
    $clinic_history->pet->born_date = get_full_born_date($born_date);
    return $clinic_history;
}

function print_checked_if_needed($sex, $expected) {
    if (isset($sex)) {
        if ($sex === $expected) {
            echo "checked";
        }
    }
}
