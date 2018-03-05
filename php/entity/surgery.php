<?php

class Surgery {

    public $id;
    public $id_clinic_history;
    public $id_general_data;
    public $name;
    public $have_surgery;
    public $anesthetic_protocol;
    public $premedication;
    public $presumptive_diagnosis;
    public $differential_diagnosis;
    public $diagnosis_recomendations;
    public $diagnosis_samples;
    public $diagnosis_exams;
    public $have_hospitalization;
    public $definitive_diagnosis;
    public $forecast;
    public $next_date;
    public $id_company;
    public $id_surgery;

    function __construct($id, $id_clinic_history, $id_general_data, $name, $have_surgery, $anesthetic_protocol, $premedication, $presumptive_diagnosis, $differential_diagnosis, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $have_hospitalization, $definitive_diagnosis, $forecast, $next_date, $id_company, $id_surgery) {
        $this->id = $id;
        $this->id_clinic_history = $id_clinic_history;
        $this->id_general_data = $id_general_data;
        $this->name = $name;
        $this->have_surgery = $have_surgery;
        $this->anesthetic_protocol = $anesthetic_protocol;
        $this->premedication = $premedication;
        $this->presumptive_diagnosis = $presumptive_diagnosis;
        $this->differential_diagnosis = $differential_diagnosis;
        $this->diagnosis_recomendations = $diagnosis_recomendations;
        $this->diagnosis_samples = $diagnosis_samples;
        $this->diagnosis_exams = $diagnosis_exams;
        $this->have_hospitalization = $have_hospitalization;
        $this->definitive_diagnosis = $definitive_diagnosis;
        $this->forecast = $forecast;
        $this->next_date = $next_date;
        $this->id_company = $id_company;
        $this->id_surgery = $id_surgery;
    }

}
