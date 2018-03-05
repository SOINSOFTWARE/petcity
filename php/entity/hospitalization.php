<?php

class Hospitalization {

    public $id;
    public $initial_date;
    public $final_date;
    public $comments;
    public $recomendations;
    public $formula_number;
    public $formula;
    public $received_by;
    public $id_pet;

    function __construct($id, $initial_date, $final_date, $comments, $recomendations, $formula_number, $formula, $received_by, $id_pet) {
        $this->id = $id;
        $this->initial_date = $initial_date;
        $this->final_date = $final_date;
        $this->comments = $comments;
        $this->recomendations = $recomendations;
        $this->formula_number = $formula_number;
        $this->formula = $formula;
        $this->received_by = $received_by;
        $this->id_pet = $id_pet;
    }

}
