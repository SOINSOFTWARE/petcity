<?php

class ClinicHistory {

    public $id;
    public $id_pet;
    public $id_company;
    public $record_custom_id;

    function __construct($id, $id_pet, $id_company, $record_custom_id) {
        $this->id = $id;
        $this->id_pet = $id_pet;
        $this->id_company = $id_company;
        $this->record_custom_id = $record_custom_id;
    }

}
