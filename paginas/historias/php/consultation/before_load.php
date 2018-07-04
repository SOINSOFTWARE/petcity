<?php

include_once '../phpfragments/validations.php';
$generalDataTable = new GeneralDataTable();
$mdconsultable = new MedicalConsultationTable();
$id_clinic_history = filter_input(INPUT_POST, 'idclinichistory');
if (filter_input(INPUT_POST, 'id') !== NULL) {
    $id = filter_input(INPUT_POST, 'id');
} else if (filter_input(INPUT_POST, 'idconsultation') !== NULL) {
    $id = filter_input(INPUT_POST, 'idconsultation');
} else {
    $id = 0;
}
include_once './php/general_data/before_load.php';
$medical_consultation = new MedicalConsultation($id, $id_clinic_history, 0, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, $companyId);
if (filter_input(INPUT_POST, 'save') !== NULL) {
    try {
        $motive = filter_input(INPUT_POST, 'motive');
        $presumptive_diagnosis = filter_input(INPUT_POST, 'presumptivediagnosis');
        $differential_diagnosis = filter_input(INPUT_POST, 'differentialdiagnosis');
        $diagnosis_recomendations = filter_input(INPUT_POST, 'diagnosisrecomendations');
        $diagnosis_samples = filter_input(INPUT_POST, 'diagnosissamples');
        $diagnosis_exams = filter_input(INPUT_POST, 'diagnosisexams');
        $definitive_diagnosis = filter_input(INPUT_POST, 'definitivediagnosis');
        $forecast = filter_input(INPUT_POST, 'forecast');
        $next_date = filter_input(INPUT_POST, 'nextdate');
        $not_saved_medical_consultation = new MedicalConsultation($id, $id_clinic_history, $general_data->id, $motive, $presumptive_diagnosis, $differential_diagnosis, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $definitive_diagnosis, $forecast, $next_date, $companyId);
        $saved_general_data = saveGeneralData($general_data, $generalDataTable);
        $generaldatasaved = TRUE;
        if ($not_saved_medical_consultation->id_general_data === 0) {
            $not_saved_medical_consultation->id_general_data = $general_data->id;
        }

        try {
            $medical_consultation = saveMedicalConsultation($not_saved_medical_consultation, $mdconsultable);
            $id = $medical_consultation->id;
            $saved = TRUE;
        } catch (Exception $ex) {
            saveError($mdconsultable->getError());
            $medical_consultation = $not_saved_medical_consultation;
            $saved = FALSE;
        }
    } catch (Exception $ex) {
        saveError($generalDataTable->getError());
        $generaldatasaved = FALSE;
    }
}
if ($id > 0) {
    $medical_consultation = $mdconsultable->selectById($id);
    if (!is_null($medical_consultation)) {
        $general_data = $generalDataTable->selectByIdObject($medical_consultation->id_general_data);
    }
    
    $mdcontroltable = new MedicalControlTable();
    if (filter_input(INPUT_POST, 'deletecontrol') !== NULL) {
        $idmedicalcontrol = filter_input(INPUT_POST, 'idmedicalcontrol');
        $controldeleted = $mdcontroltable->delete($idmedicalcontrol);
        if ($controldeleted === FALSE) {
            $errorLog = new ErrorLogTable();
            $errorLog->insert($mdcontroltable->getError());
        }
    }
    $mdexamtable = new MedicalExamTable();
    if (filter_input(INPUT_POST, 'deleteexam') !== NULL) {
        $idmedicalexam = filter_input(INPUT_POST, 'idmedicalexam');
        $examdeleted = $mdexamtable->delete($idmedicalexam);
        if ($examdeleted === FALSE) {
            $errorLog = new ErrorLogTable();
            $errorLog->insert($mdexamtable->getError());
        }
    }

    $evidencefilestable = new EvidenceFilesTable();
    if (filter_input(INPUT_POST, 'deleteevidence') !== NULL) {
        $idevidencefile = filter_input(INPUT_POST, 'idevidencefile');
        $evidencedeleted = $evidencefilestable->delete($idevidencefile);
        if ($evidencedeleted === FALSE) {
            $errorLog = new ErrorLogTable();
            $errorLog->insert($evidencefilestable->getError());
        }
    }
}

function saveMedicalConsultation($medical_consultation, $medical_consultation_table) {
    if ($medical_consultation->id == 0) {
        $saved = $medical_consultation_table->insert($medical_consultation);
        if ($saved) {
            $medical_consultation->id = $medical_consultation_table->selectLastInsertId();
        }
    } else {
        $saved = $medical_consultation_table->update($medical_consultation);
    }
    if (!$saved) {
        throw new Exception();
    }
    return $medical_consultation;
}
