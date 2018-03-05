<?php

class Breed {

    public $id;
    public $name;
    public $id_pet_type;
    public $id_company;

    function __construct($id, $name, $id_pet_type, $id_company) {
        $this->id = $id;
        $this->name = $name;
        $this->id_pet_type = $id_pet_type;
        $this->id_company = $id_company;
    }

}
