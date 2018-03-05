<?php

class GeneralData {

    public $id;
    public $date;
    public $heart_rate;
    public $breathing_frequency;
    public $temperature;
    public $heart_beat;
    public $corporal_condition;
    public $linfonodulos;
    public $mucous;
    public $trc;
    public $dh;
    public $weight;
    public $mood;
    public $tusigo;
    public $anamnesis;
    public $findings;
    public $clinical_treatment;
    public $formula_number;
    public $formula;
    public $recomendations;
    public $observations;
    public $id_company;

    function __construct($id, $date, $heart_rate, $breathing_frequency, $temperature, $heart_beat, $corporal_condition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinical_treatment, $formula_number, $formula, $recomendations, $observations, $id_company) {
        $this->id = $id;
        $this->date = $date;
        $this->heart_rate = $heart_rate;
        $this->breathing_frequency = $breathing_frequency;
        $this->temperature = $temperature;
        $this->heart_beat = $heart_beat;
        $this->corporal_condition = $corporal_condition;
        $this->linfonodulos = $linfonodulos;
        $this->mucous = $mucous;
        $this->trc = $trc;
        $this->dh = $dh;
        $this->weight = $weight;
        $this->mood = $mood;
        $this->tusigo = $tusigo;
        $this->anamnesis = $anamnesis;
        $this->findings = $findings;
        $this->clinical_treatment = $clinical_treatment;
        $this->formula_number = $formula_number;
        $this->formula = $formula;
        $this->recomendations = $recomendations;
        $this->observations = $observations;
        $this->id_company = $id_company;
    }

}
