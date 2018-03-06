<?php

include_once '../phpfragments/validations.php';
$generalDataTable = new GeneralDataTable();
$vacConsultationtable = new VaccineConsultationTable();
if (filter_input(INPUT_POST, 'idvaccineconsultation') !== NULL) {
    $id = filter_input(INPUT_POST, 'idvaccineconsultation');
} else {
    $id = 0;
}
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
$generaldatadate = date('d/m/Y');

if (filter_input(INPUT_POST, 'save') !== NULL) {
    include_once './php/general_data/before_load.php';

    $vaccineapplication = (filter_input(INPUT_POST, 'vaccineapplication') !== NULL) ? filter_input(INPUT_POST, 'vaccineapplication') : FALSE;
    $applyvaccine = ($vaccineapplication || $vaccineapplication === TRUE) ? 1 : 0;
    $vaccine = filter_input(INPUT_POST, 'vaccine');
    $idvaccine = ($vaccine > 0) ? $vaccine : NULL;
    $batch = filter_input(INPUT_POST, 'batch');
    $expiration = filter_input(INPUT_POST, 'expiration');
    $vaccine_consultation = new VaccineConsultation($id, $idgeneraldata, $applyvaccine, $idvaccine, $batch, $expiration, $idpet);

    $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $generaldatadate . ' 00:00:00');
    $generaldatadateToSQL = $dateobj->format("Y-m-d");

    if (intval($id) === 0) {
        $generaldatasaved = $generalDataTable->insert($generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $companyId);
        if ($generaldatasaved === TRUE) {
            $idgeneraldata = $generalDataTable->selectLastInsertId();
            $vaccine_consultation->id_general_data = $idgeneraldata;
            $saved = $vacConsultationtable->insert($vaccine_consultation);
            if ($saved === TRUE) {
                $id = $vacConsultationtable->selectLastInsertId();
                $vaccine_consultation->id = $id;
            }
        }
    } else {
        $generaldatasaved = $generalDataTable->update($idgeneraldata, $generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations);
        if ($generaldatasaved === TRUE) {
            $saved = $vacConsultationtable->update($vaccine_consultation);
        }
    }
    
    if (isset($generaldatasaved) && $generaldatasaved === FALSE) {
        saveError($generalDataTable->getError());
    }

    if (isset($saved) && $saved === FALSE) {
        saveError($vacConsultationtable->getError());
    }
}

$vaccine_consultation = $vacConsultationtable->selectById($id);
if ($vaccine_consultation !== NULL) {
    $idpet = $vaccine_consultation->id_pet;
    $applyvaccine = $vaccine_consultation->apply_vaccine;
    $vaccineapplication = ($applyvaccine || $applyvaccine == 1) ? TRUE : FALSE;
    $vaccine = $vaccine_consultation->id_vaccine;
    $batch = $vaccine_consultation->batch;
    $expiration = $vaccine_consultation->expiration;
    $idgeneraldata = $vaccine_consultation->id_general_data;

    $resultsGeneralData = $generalDataTable->selectById($idgeneraldata);
    $rowsGeneralData = mysqli_fetch_array($resultsGeneralData);
    if ($rowsGeneralData !== NULL) {
        $generaldatadate = format_string_date($rowsGeneralData['generaldatadate'], "d/m/Y");
        $weight = $rowsGeneralData['weight'];
        $corporalcondition = $rowsGeneralData['corporalcondition'];
        $heartrate = $rowsGeneralData['heartrate'];
        $breathingfrequency = $rowsGeneralData['breathingfrequency'];
        $temperature = $rowsGeneralData['temperature'];
        $heartbeat = $rowsGeneralData['heartbeat'];
        $linfonodulos = $rowsGeneralData['linfonodulos'];
        $mucous = $rowsGeneralData['mucous'];
        $trc = $rowsGeneralData['trc'];
        $dh = $rowsGeneralData['dh'];
        $mood = $rowsGeneralData['mood'];
        $tusigo = $rowsGeneralData['tusigo'];
        $anamnesis = $rowsGeneralData['anamnesis'];
        $findings = $rowsGeneralData['findings'];
        $clinicaltreatment = $rowsGeneralData['clinicaltreatment'];
        $formulanumber = $rowsGeneralData['formulanumber'];
        $formula = $rowsGeneralData['formula'];
        $recomendations = $rowsGeneralData['recomendations'];
        $observations = $rowsGeneralData['observations'];
    }
}

$vaccinetable = new VaccineTable();
$results = $vaccinetable->select($companyId);

function saveError($message) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($message);
}
