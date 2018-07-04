<?php

class MedicalConsultation {

    public $id;
    public $id_clinic_history;
    public $id_general_data;
    public $motive;
    public $presumptive_diagnosis;
    public $differential_diagnosis;
    public $diagnosis_recomendations;
    public $diagnosis_samples;
    public $diagnosis_exams;
    public $definitive_diagnosis;
    public $forecast;
    public $next_date;
    public $id_company;
    public $general_data;
    
    function __construct($id, $id_clinic_history, $id_general_data, $motive, $presumptive_diagnosis, $differential_diagnosis, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $definitive_diagnosis, $forecast, $next_date, $id_company) {
        $this->id = $id;
        $this->id_clinic_history = $id_clinic_history;
        $this->id_general_data = $id_general_data;
        $this->motive = $motive;
        $this->presumptive_diagnosis = $presumptive_diagnosis;
        $this->differential_diagnosis = $differential_diagnosis;
        $this->diagnosis_recomendations = $diagnosis_recomendations;
        $this->diagnosis_samples = $diagnosis_samples;
        $this->diagnosis_exams = $diagnosis_exams;
        $this->definitive_diagnosis = $definitive_diagnosis;
        $this->forecast = $forecast;
        $this->next_date = $next_date;
        $this->id_company = $id_company;
    }
    
    public function getIdClinicHistory() {
        if ($this->id_clinic_history !== NULL) {
            return $this->id_clinic_history;
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
    
    public function getMotive() {
        if ($this->motive !== NULL) {
            return "'" . $this->motive . "'";
        } else {
            return "''";
        }
    }
    
    public function getPresumptiveDiagnosis() {
        if ($this->presumptive_diagnosis !== NULL) {
            return "'" . $this->presumptive_diagnosis . "'";
        } else {
            return "''";
        }
    }
    
    public function getDifferentialDiagnosis() {
        if ($this->differential_diagnosis !== NULL) {
            return "'" . $this->differential_diagnosis . "'";
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
    
    public function getDefinitiveDiagnosis() {
        if ($this->definitive_diagnosis !== NULL) {
            return "'" . $this->definitive_diagnosis . "'";
        } else {
            return 'null';
        }
    }
    
    public function getForecast() {
        if ($this->forecast !== NULL) {
            return "'" . $this->forecast . "'";
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
    
    public function getIdCompany() {
        if ($this->id_company !== NULL) {
            return $this->id_company;
        } else {
            return 0;
        }
    }
}
