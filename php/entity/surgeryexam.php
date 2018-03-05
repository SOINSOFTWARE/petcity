<?php

class SurgeryExam {

    public $id;
    public $id_surgery;
    public $date;
    public $name;
    public $results;
    public $file_path;
    public $formula_number;
    public $formula;

    function __construct($id, $id_surgery, $date, $name, $results, $file_path, $formula_number, $formula) {
        $this->id = $id;
        $this->id_surgery = $id_surgery;
        $this->date = $date;
        $this->name = $name;
        $this->results = $results;
        $this->file_path = $file_path;
        $this->formula_number = $formula_number;
        $this->formula = $formula;
    }

}
