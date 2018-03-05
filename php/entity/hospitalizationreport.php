<?php

class HospitalizationReport {

    public $id;
    public $id_hospitalization;
    public $id_general_data;
    public $report_time;
    public $evolution;

    function __construct($id, $id_hospitalization, $id_general_data, $report_time, $evolution) {
        $this->id = $id;
        $this->id_hospitalization = $id_hospitalization;
        $this->id_general_data = $id_general_data;
        $this->report_time = $report_time;
        $this->evolution = $evolution;
    }

}
