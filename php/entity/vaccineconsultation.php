<?php

class VaccineConsultation {

    public $id, $id_general_data, $apply_vaccine, $id_vaccine, $batch, $expiration, $id_pet;

    function __construct($id, $id_general_data, $apply_vaccine, $id_vaccine, $batch, $expiration, $id_pet) {
        $this->id = intval($id);
        $this->id_general_data = intval($id_general_data);
        $this->apply_vaccine = $apply_vaccine !== NULL ? intval($apply_vaccine) : 0;
        $this->id_vaccine = intval($id_vaccine);
        $this->batch = $batch;
        $this->expiration = $expiration;
        $this->id_pet = intval($id_pet);
    }

    public function getIdGeneralData() {
        if ($this->id_general_data !== NULL && $this->id_general_data > 0) {
            return $this->id_general_data;
        } else {
            return 'null';
        }
    }

    public function getApplyVaccine() {
        if ($this->apply_vaccine !== NULL) {
            return $this->apply_vaccine;
        } else {
            return 0;
        }
    }

    public function getIdVaccine() {
        if ($this->id_vaccine !== NULL && $this->id_vaccine > 0) {
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
        if ($this->id_pet !== NULL && $this->id_pet > 0) {
            return $this->id_pet;
        } else {
            return 0;
        }
    }
    
    public function isApplyVaccine() {
        if ($this->apply_vaccine !== NULL) {
            return ($this->apply_vaccine == 1);
        } else {
            return FALSE;
        }
    }

}
