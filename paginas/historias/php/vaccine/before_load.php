<?php

include_once '../phpfragments/validations.php';
$generalDataTable = new GeneralDataTable();
$vacConsultationtable = new VaccineConsultationTable();
if (filter_input(INPUT_POST, 'idvaccineconsultation') !== NULL) {
    $id = filter_input(INPUT_POST, 'idvaccineconsultation');
} else if (filter_input(INPUT_POST, 'idvaccineconsultation1') !== NULL) {
    $id = filter_input(INPUT_POST, 'idvaccineconsultation1');
} else {
    $id = 0;
}
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
$id_pet = filter_input(INPUT_POST, 'idpet');
$applied_number = 0;
$generaldatadate = date('d/m/Y');
$anamnesis = "";
$findings = "";
$vaccine_array = NULL;
if (filter_input(INPUT_POST, 'save') !== NULL) {
    include_once './php/general_data/before_load.php';
    try {
        $saved_general_data = saveGeneralData($general_data, $generalDataTable);
        $apply_vaccine = filter_input(INPUT_POST, 'vaccineapplication');
        $applied_number = filter_input(INPUT_POST, 'appliednumberselector');
        for ($i = 1; $i <= $applied_number; $i++) {
            $id_vaccine_consultation = filter_input(INPUT_POST, 'idvaccineconsultation' . $i);
            $id_vaccine = filter_input(INPUT_POST, 'vaccineselector' . $i);
            $batch = filter_input(INPUT_POST, 'batch' . $i);
            $expiration = filter_input(INPUT_POST, 'expiration' . $i);
            $vaccine_consultation = new VaccineConsultation($id_vaccine_consultation, $saved_general_data->id, $apply_vaccine, $id_vaccine, $batch, $expiration, $id_pet);
            if ($vaccine_consultation->id === 0) {
                $saved = $vacConsultationtable->insert($vaccine_consultation);
                if ($saved) {
                    $vaccine_consultation->id = $vacConsultationtable->selectLastInsertId();
                    $id = $vaccine_consultation->id;
                }
            } else {
                $saved = $vacConsultationtable->update($vaccine_consultation);
            }
            if (!$saved) {
                saveError($vacConsultationtable->getError());
                break;
            }
        }
    } catch (Exception $ex) {
        saveError($generalDataTable->getError());
        $generaldatasaved = FALSE;
    }
}
$loaded_vc = $vacConsultationtable->selectById($id);
if ($loaded_vc !== NULL) {
    $idgeneraldata = $loaded_vc->id_general_data;
    $general_data = $generalDataTable->selectByIdObject($idgeneraldata);
    if ($general_data !== NULL) {
        $generaldatadate = format_string_date($general_data->date, "d/m/Y");
        $weight = $general_data->weight;
        $corporalcondition = $general_data->corporal_condition;
        $heartrate = $general_data->heart_rate;
        $breathingfrequency = $general_data->breathing_frequency;
        $temperature = $general_data->temperature;
        $heartbeat = $general_data->heart_beat;
        $linfonodulos = $general_data->linfonodulos;
        $mucous = $general_data->mucous;
        $trc = $general_data->trc;
        $dh = $general_data->dh;
        $mood = $general_data->mood;
        $tusigo = $general_data->tusigo;
        $anamnesis = $general_data->anamnesis;
        $findings = $general_data->findings;
        $clinicaltreatment = $general_data->clinical_treatment;
        $formulanumber = $general_data->formula_number;
        $formula = $general_data->formula;
        $recomendations = $general_data->recomendations;
        $observations = $general_data->observations;
        $vaccine_array = $vacConsultationtable->selectByIdGeneralData($general_data->id);
        if ($vaccine_array !== NULL && count($vaccine_array) > 0) {
            $applied_number = count($vaccine_array);
        }
    }
}

if ($vaccine_array === NULL || count($vaccine_array) == 0) {
    $vaccine_array[0] = new VaccineConsultation(0, 0, 0, 0, NULL, NULL, $id_pet);
    $vaccine_array[1] = new VaccineConsultation(0, 0, 0, 0, NULL, NULL, $id_pet);
    $vaccine_array[2] = new VaccineConsultation(0, 0, 0, 0, NULL, NULL, $id_pet);
}else if ($vaccine_array !== NULL && count($vaccine_array) == 1) {
    $vaccine_array[1] = new VaccineConsultation(0, 0, 0, 0, NULL, NULL, $id_pet);
    $vaccine_array[2] = new VaccineConsultation(0, 0, 0, 0, NULL, NULL, $id_pet);
} else if ($vaccine_array !== NULL && count($vaccine_array) == 2) {
    $vaccine_array[2] = new VaccineConsultation(0, 0, 0, 0, NULL, NULL, $id_pet);
}

$vaccinetable = new VaccineTable();
$results = $vaccinetable->select($companyId);

function saveError($message) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($message);
}
