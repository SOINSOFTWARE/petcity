<?php

include_once '../session.php';
include_once '../../php/evidencefiles.php';
include_once '../../php/entity/evidencefiles.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';

$evidencefilestable = new EvidenceFilesTable();

if (filter_input(INPUT_POST, 'idconsultation') !== NULL) {
    $idconsultation = filter_input(INPUT_POST, 'idconsultation');
    $idclinichistory = filter_input(INPUT_POST, 'idclinichistory');
    
} else {
    $idconsultation = 0;
    $idclinichistory =0;
}

if (isset($_POST['save'])) { 
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (intval($id) === 0) {
        $targetdir = '../../evidencefiles/' . $companyId . "/" . $idconsultation . "/";
        $filepath = $targetdir . rand() . basename($_FILES["fileToUpload"]["name"]);
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
            $evidence_files = new EvidenceFiles($id, $idconsultation, $name, $filepath);
            $saved = $evidencefilestable->insert($evidence_files);
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
if (isset($_POST['view'])) {
    $id = $_POST['idevidencefile'];
    $idclinichistory = $_POST['idclinichistory'];
    $idconsultation = $_POST['idconsultation'];
    $results = $evidencefilestable->selectById($id);
    if ($rows = mysqli_fetch_array($results)) {
        $name = $rows['name'];
        $filepath = $rows['filepath'];
    }
}
