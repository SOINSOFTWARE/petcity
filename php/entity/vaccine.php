<?php

class Vaccine {

    public $id, $name, $id_company;

    function __construct($id, $name, $id_company) {
        $this->id = $id;
        $this->name = $name;
        $this->id_company = $id_company;
    }

}
