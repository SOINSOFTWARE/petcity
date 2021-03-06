<?php

class SurgeryControl {

    public $id;
    public $id_surgery;
    public $id_general_data;
    public $evolution;
    public $diagnosis_recomendations;
    public $diagnosis_samples;
    public $diagnosis_exams;
    public $next_date;

    function __construct($id, $id_surgery, $id_general_data, $evolution, $diagnosis_recomendations, $diagnosis_samples, $diagnosis_exams, $next_date) {
        $this->id = $id;
        $this->id_surgery = $id_surgery;
        $this->id_general_data = $id_general_data;
        $this->evolution = $evolution;
        $this->diagnosis_recomendations = $diagnosis_recomendations;
        $this->diagnosis_samples = $diagnosis_samples;
        $this->diagnosis_exams = $diagnosis_exams;
        $this->next_date = $next_date;
    }

}
