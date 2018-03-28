<?php

include_once '../session.php';
include_once '../../php/externalfiles.php';
include_once '../../php/entity/externalfiles.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';

$externalfilestable = new ExternalFilesTable();

if (filter_input(INPUT_POST, 'idclinichistory') !== NULL) {
    $idclinichistory = filter_input(INPUT_POST, 'idclinichistory');
} else {
    $idclinichistory = 1;
}

if (isset($_POST['save'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];

    if (intval($id) === 0) {
        $targetdir = '../../externalfiles/' . $companyId . "/" . $idclinichistory . "/";
        $filepath = $targetdir . rand() . basename($_FILES["fileToUpload"]["name"]);
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
            $external_files = new ExternalFiles($id, $idclinichistory, $name, $filepath);
            $saved = $externalfilestable->insert($external_files);
            if ($saved === TRUE) {
                $id = $externalfilestable->selectLastInsertId();
            }
        } else {
            $errormovingfile = TRUE;
        }
    } else {        
        $saved = $externalfilestable->update($id, $name);
    }
    if ($saved === FALSE) {
        $errorLog = new ErrorLogTable();
        $errorLog->insert($externalfilestable->getError());
    }
}
if (isset($_POST['view'])) {
    $id = $_POST['idexternalfile'];
    $idclinichistory = $_POST['idclinichistory'];
    $results = $externalfilestable->selectById($id);
    if ($rows = mysqli_fetch_array($results)) {
        $name = $rows['name'];
        $filepath = $rows['filepath'];
    }
}
