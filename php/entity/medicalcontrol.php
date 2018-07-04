<?php

class MedicalControl {

    public $id;
    public $id_medical_consultation;
    public $id_general_data;
    public $evolution;
    public $diagnosis_recomendations;
    public $diagnosis_samples;
    public $diagnosis_exams;
    public $next_date;

    function __construct($id, $id_medical_consultation, $id_general_data, $evolution, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $next_date) {
        $this->id = $id;
        $this->id_medical_consultation = $id_medical_consultation;
        $this->id_general_data = $id_general_data;
        $this->evolution = $evolution;
        $this->diagnosis_recomendations = $diagnosis_recomendations;
        $this->diagnosis_samples = $diagnosis_samples;
        $this->diagnosis_exams = $diagnosis_exams;
        $this->next_date = $next_date;
    }

    public function getIdMedicalConsultation() {
        if ($this->id_medical_consultation !== NULL) {
            return $this->id_medical_consultation;
        } else {
            return 0;
        }
    }
    
    public function getIdGeneralData() {
        if ($this->id_general_data !== NULL) {
            return $this->id_general_data;
        } else {
            return 0;
        }
    }
    
    public function getEvolution() {
        if ($this->evolution !== NULL) {
            return "'" . $this->evolution . "'";
        } else {
            return "''";
        }
    }
    
    public function getDiagnosisRecomendations() {
        if ($this->diagnosis_recomendations !== NULL) {
            return "'" . $this->diagnosis_recomendations . "'";
        } else {
            return 'null';
        }
    }
    
    public function getDiagnosisSamples() {
        if ($this->diagnosis_samples !== NULL) {
            return "'" . $this->diagnosis_samples . "'";
        } else {
            return 'null';
        }
    }
    
    public function getDiagnosisExams() {
        if ($this->diagnosis_exams !== NULL) {
            return "'" . $this->diagnosis_exams . "'";
        } else {
            return 'null';
        }
    }
    
    public function getNextDate() {
        if ($this->next_date !== NULL && $this->next_date !== '') {
            $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $this->next_date . ' 00:00:00');
            return "'" . $dateobj->format("Y-m-d") . "'";
        } else {
            return 'null';
        }
    }
}
