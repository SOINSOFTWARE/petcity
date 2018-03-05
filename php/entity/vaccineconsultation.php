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

}
