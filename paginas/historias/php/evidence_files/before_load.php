<?php

include_once '../session.php';
include_once '../../php/evidencefiles.php';
include_once '../../php/entity/evidencefiles.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';

$evidencefilestable = new EvidenceFilesTable();
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
$id_medical_consultation = filter_input(INPUT_POST, 'idconsultation');
if (filter_input(INPUT_POST, 'id') !== NULL) {
    $id = filter_input(INPUT_POST, 'id');
} else if (filter_input(INPUT_POST, 'idevidencefile') !== NULL) {
    $id = filter_input(INPUT_POST, 'idevidencefile');
} else {
    $id = 0;
}

$evidence_file = new EvidenceFiles($id, $id_medical_consultation, '', '', NULL, NULL);
if (filter_input(INPUT_POST, 'save') !== NULL) {
    $name = filter_input(INPUT_POST, 'name');

    if (intval($id) === 0) {
        $targetdir = '../../evidencefiles/' . $companyId . "/" . $id_medical_consultation . "/";
        $filepath = $targetdir . rand() . basename($_FILES["fileToUpload"]["name"]);
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
            $evidence_file = new EvidenceFiles($id, $id_medical_consultation, $name, $filepath, NULL, NULL);
            $saved = $evidencefilestable->insert($evidence_file);
            if ($saved === TRUE) {
                $id = $evidencefilestable->selectLastInsertId();
            }
        } else {
            $errormovingfile = TRUE;
        }
    } else {
        $saved = $evidencefilestable->update($id, $name);
    }
    if ($saved === FALSE) {
        $errorLog = new ErrorLogTable();
        $errorLog->insert($evidencefilestable->getError());
    }
}

if (intval($id) > 0) {
    $evidence_file = $evidencefilestable->selectById($id);
}
