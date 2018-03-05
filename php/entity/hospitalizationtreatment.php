<?php

class HospitalizationTreatment {

    public $id;
    public $id_hospitalization;
    public $drug_name;
    public $posol;
    public $dose;
    public $frequency;
    public $administration;
    public $schedule;

    function __construct($id, $id_hospitalization, $drug_name, $posol, $dose, $frequency, $administration, $schedule) {
        $this->id = $id;
        $this->id_hospitalization = $id_hospitalization;
        $this->drug_name = $drug_name;
        $this->posol = $posol;
        $this->dose = $dose;
        $this->frequency = $frequency;
        $this->administration = $administration;
        $this->schedule = $schedule;
    }

}
