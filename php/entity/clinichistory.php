<?php

include_once 'pet.php';

class ClinicHistory {

    public $id;
    public $id_pet;
    public $id_company;
    public $record_custom_id;
    public $pet;

    function __construct($id, $id_pet, $id_company, $record_custom_id) {
        $this->id = $id;
        $this->id_pet = $id_pet;
        $this->id_company = $id_company;
        $this->record_custom_id = $record_custom_id;
    }
    
    public function getIdPet() {
        if ($this->id_pet !== NULL && $this->id_pet != '') {
            return $this->id_pet;
        } else {
            return 0;
        }
    }
    
    public function getIdCompany() {
        if ($this->id_company !== NULL && $this->id_company != '') {
            return $this->id_company;
        } else {
            return 0;
        }
    }
    
    public function getRecordCustomId() {
        if ($this->record_custom_id !== NULL && $this->record_custom_id != '') {
            return $this->record_custom_id;
        } else {
            return 'null';
        }
    }
}
