<?php

$success_saved = NULL;
$company_table = new CompanyTable();
$veterinary = $company_table->selectById($companyId);
if ($veterinary == NULL) {
    $veterinary = new Company(0, NULL, NULL, FALSE, NULL, FALSE, NULL, 0, 0);
}
if (filter_input(INPUT_POST, 'initialcustomid') !== NULL && filter_input(INPUT_POST, 'initialcustomid') !== '') {
    $veterinary->setInitialCustomId(filter_input(INPUT_POST, 'initialcustomid'));
}
if (filter_input(INPUT_POST, 'actualcustomid') !== NULL && filter_input(INPUT_POST, 'actualcustomid') !== '') {
    $veterinary->setActualCustomId(filter_input(INPUT_POST, 'actualcustomid'));
}
if ($veterinary->getInitialCustomId() > 0 && $veterinary->getActualCustomId() == 0 
        || $veterinary->getInitialCustomId() > $veterinary->getActualCustomId()) {
    $veterinary->setActualCustomId($veterinary->getInitialCustomId());
}
if (filter_input(INPUT_POST, 'save') !== NULL) {
    $veterinary->setPhoto(upload_photo_to_server($companyId, $veterinary->getPhoto()));
    $success_saved = $company_table->update($veterinary);
}

function upload_photo_to_server($companyId, $photo_file) {
    if ($_FILES["photo_file"]["tmp_name"] != NULL && $_FILES["photo_file"]["tmp_name"] != '') {
        $targetdir = '../../companies/' . $companyId . "/";
        $filepath = $targetdir . rand() . basename($_FILES["photo_file"]["name"]);
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        if (move_uploaded_file($_FILES["photo_file"]["tmp_name"], $filepath)) {
            return $filepath;
        } else {
            return $photo_file;
        }
    } else {
        return $photo_file;
    }
}
