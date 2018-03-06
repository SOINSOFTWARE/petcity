<?php

class VaccineConsultation {

    public $id, $id_general_data, $apply_vaccine, $id_vaccine, $batch, $expiration, $id_pet;

    function __construct($id, $id_general_data, $apply_vaccine, $id_vaccine, $batch, $expiration, $id_pet) {
        $this->id = $id;
        $this->id_general_data = $id_general_data;
        $this->apply_vaccine = $apply_vaccine;
        $this->id_vaccine = $id_vaccine;
        $this->batch = $batch;
        $this->expiration = $expiration;
        $this->id_pet = $id_pet;
    }

    public function getIdGeneralData() {
        if ($this->id_general_data !== NULL) {
            return $this->id_general_data;
        } else {
            return 'null';
        }
    }

    public function isApplyVaccine() {
        if ($this->apply_vaccine !== NULL) {
            return $this->apply_vaccine;
        } else {
            return FALSE;
        }
    }

    public function getIdVaccine() {
        if ($this->id_vaccine !== NULL) {
            return $this->id_vaccine;
        } else {
            return 'null';
        }
    }
    
    public function getBatch() {
        if ($this->batch !== NULL && $this->batch !== '') {
            return "'" . $this->batch . "'";
        } else {
            return 'null';
        }
    }
    
    public function getExpiration() {
        if ($this->expiration !== NULL && $this->expiration !== '') {
            return "'" . $this->expiration . "'";
        } else {
            return 'null';
        }
    }
    
    public function getIdPet() {
        if ($this->id_pet !== NULL) {
            return $this->id_pet;
        } else {
            return 'null';
        }
    }

}
