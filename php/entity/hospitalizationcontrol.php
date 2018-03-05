<?php

class HospitalizationControl {

    public $id;
    public $id_hospitalization;
    public $id_general_data;
    public $evolution;
    public $diagnosis_recomendations;
    public $diagnosis_samples;
    public $diagnosis_exams;
    public $next_date;

    function __construct($id, $id_hospitalization, $id_general_data, $evolution, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $next_date) {
        $this->id = $id;
        $this->id_hospitalization = $id_hospitalization;
        $this->id_general_data = $id_general_data;
        $this->evolution = $evolution;
        $this->diagnosis_recomendations = $diagnosis_recomendations;
        $this->diagnosis_samples = $diagnosis_samples;
        $this->diagnosis_exams = $diagnosis_exams;
        $this->next_date = $next_date;
    }

}
