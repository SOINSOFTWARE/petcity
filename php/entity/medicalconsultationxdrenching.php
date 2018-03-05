<?php

class MedicalConsultationXDrenching {

    public $id;
    public $id_drenching;
    public $date;
    public $weight;
    public $dose;
    public $administration;
    public $id_pet;

    function __construct($id, $id_drenching, $date, $weight, $dose, $administration, $id_pet) {
        $this->id = $id;
        $this->id_drenching = $id_drenching;
        $this->date = $date;
        $this->weight = $weight;
        $this->dose = $dose;
        $this->administration = $administration;
        $this->id_pet = $id_pet;
    }

}
