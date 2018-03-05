<?php

class AdverseReaction {

    public $id;
    public $date;
    public $type;
    public $allergen;
    public $presentation;
    public $comercial_name;
    public $dose;
    public $administration;
    public $clinical_sign;
    public $id_pet;

    function __construct($id, $date, $type, $allergen, $presentation, $comercial_name, $dose, $administration, $clinical_sign, $id_pet) {
        $this->id = $id;
        $this->date = $date;
        $this->type = $type;
        $this->allergen = $allergen;
        $this->presentation = $presentation;
        $this->comercial_name = $comercial_name;
        $this->dose = $dose;
        $this->administration = $administration;
        $this->clinical_sign = $clinical_sign;
        $this->id_pet = $id_pet;
    }

}
