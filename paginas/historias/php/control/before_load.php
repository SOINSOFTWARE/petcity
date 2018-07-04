<?php

include_once '../phpfragments/validations.php';
$generalDataTable = new GeneralDataTable();
$mdControltable = new MedicalControlTable();
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
$id_medical_consultation = filter_input(INPUT_POST, 'idconsultation');
if (filter_input(INPUT_POST, 'id') !== NULL) {
    $id = filter_input(INPUT_POST, 'id');
} else if (filter_input(INPUT_POST, 'idmedicalcontrol') !== NULL) {
    $id = filter_input(INPUT_POST, 'idmedicalcontrol');
} else {
    $id = 0;
}

include_once './php/general_data/before_load.php';
$medical_control = new MedicalControl($id, $id_medical_consultation, 0, '', NULL, NULL, NULL, NULL);
if (filter_input(INPUT_POST, 'save') !== NULL) {
    try {
        $evolution = filter_input(INPUT_POST, 'evolution');
        $diagnosis_recomendations = filter_input(INPUT_POST, 'diagnosisrecomendations');
        $diagnosis_samples = filter_input(INPUT_POST, 'diagnosissamples');
        $diagnosis_exams = filter_input(INPUT_POST, 'diagnosisexams');
        $next_date = filter_input(INPUT_POST, 'nextdate');
        $not_saved_medical_control = new MedicalControl($id, $id_medical_consultation, $general_data->id, $evolution, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $next_date);
        $saved_general_data = saveGeneralData($general_data, $generalDataTable);
        $generaldatasaved = TRUE;
        if ($not_saved_medical_control->id_general_data === 0) {
            $not_saved_medical_control->id_general_data = $general_data->id;
        }
        
        try {
            $medical_control = saveMedicalControl($not_saved_medical_control, $mdControltable);
            $id = $medical_control->id;
            $saved = TRUE;
        } catch (Exception $ex) {
            saveError($mdControltable->getError());
            $medical_control = $not_saved_medical_control;
            $saved = FALSE;
        }
    } catch (Exception $ex) {
        saveError($generalDataTable->getError());
        $generaldatasaved = FALSE;
    }
}
if ($id > 0) {
    $medical_control = $mdControltable->selectById($id);
    if (!is_null($medical_control)) {
        $general_data = $generalDataTable->selectByIdObject($medical_control->id_general_data);
    }
}

function saveError($log) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($log);
}

function saveMedicalControl($medical_control, $medical_control_table) {
    if ($medical_control->id == 0) {
        $saved = $medical_control_table->insert($medical_control);
        if ($saved) {
            $medical_control->id = $medical_control_table->selectLastInsertId();
        }
    } else {
        $saved = $medical_control_table->update($medical_control);
    }
    if (!$saved) {
        throw new Exception();
    }
    return $medical_control;
}
