<?php

class HospitalizationExam {

    public $id;
    public $id_hospitalization;
    public $date;
    public $name;
    public $results;
    public $file_path;

    function __construct($id, $id_hospitalization, $date, $name, $results, $file_path) {
        $this->id = $id;
        $this->id_hospitalization = $id_hospitalization;
        $this->date = $date;
        $this->name = $name;
        $this->results = $results;
        $this->file_path = $file_path;
    }

}
