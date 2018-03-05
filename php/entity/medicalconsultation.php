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

}
