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
        $this->id = intval($id);
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

    public function getDate() {
        if ($this->date !== NULL && $this->date !== '') {
            $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $this->date . ' 00:00:00');
            return "'" . $dateobj->format("Y-m-d") . "'";
        } else {
            return 'null';
        }
    }

    public function getHeartRate() {
        if ($this->heart_rate !== NULL) {
            return $this->heart_rate;
        } else {
            return 0;
        }
    }

    public function getBreathingFrequency() {
        if ($this->breathing_frequency !== NULL) {
            return $this->breathing_frequency;
        } else {
            return 0;
        }
    }

    public function getTemperature() {
        if ($this->temperature !== NULL) {
            return $this->temperature;
        } else {
            return 0;
        }
    }

    public function getHeartBeat() {
        if ($this->heart_beat !== NULL) {
            return "'" . $this->heart_beat . "'";
        } else {
            return "''";
        }
    }

    public function getCorporalCondition() {
        if ($this->corporal_condition !== NULL) {
            return "'" . $this->corporal_condition . "'";
        } else {
            return "''";
        }
    }

    public function getLinfonodulos() {
        if ($this->linfonodulos !== NULL) {
            return "'" . $this->linfonodulos . "'";
        } else {
            return "''";
        }
    }
    
    public function getMucous() {
        if ($this->mucous !== NULL) {
            return "'" . $this->mucous . "'";
        } else {
            return "''";
        }
    }
    
    public function getTrc() {
        if ($this->trc !== NULL) {
            return "'" . $this->trc . "'";
        } else {
            return "''";
        }
    }
    
    public function getDh() {
        if ($this->dh !== NULL) {
            return $this->dh;
        } else {
            return 0;
        }
    }
    
    public function getWeight() {
        if ($this->weight !== NULL) {
            return $this->weight;
        } else {
            return 0;
        }
    }
    
    public function getMood() {
        if ($this->mood !== NULL) {
            return "'" . $this->mood . "'";
        } else {
            return "''";
        }
    }
    
    public function getTusigo() {
        if ($this->tusigo !== NULL) {
            return "'" . $this->tusigo . "'";
        } else {
            return "''";
        }
    }
    
    public function getAnamnesis() {
        if ($this->anamnesis !== NULL) {
            return "'" . $this->anamnesis . "'";
        } else {
            return "''";
        }
    }
    
    public function getFindings() {
        if ($this->findings !== NULL) {
            return "'" . $this->findings . "'";
        } else {
            return "''";
        }
    }
    
    public function getClinicalTreatment() {
        if ($this->clinical_treatment !== NULL) {
            return "'" . $this->clinical_treatment . "'";
        } else {
            return 'null';
        }
    }
    
    public function getFormulaNumber() {
        if ($this->formula_number !== NULL) {
            return $this->formula_number;
        } else {
            return 0;
        }
    }
    
    public function getFormula() {
        if ($this->formula !== NULL) {
            return "'" . $this->formula . "'";
        } else {
            return 'null';
        }
    }
    
    public function getRecomendations() {
        if ($this->recomendations !== NULL) {
            return "'" . $this->recomendations . "'";
        } else {
            return 'null';
        }
    }
    
    public function getObservations() {
        if ($this->observations !== NULL) {
            return "'" . $this->observations . "'";
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
