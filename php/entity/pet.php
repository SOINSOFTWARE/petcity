<?php

class Pet {

    public $id;
    public $name;
    public $color;
    public $sex;
    public $born_date;
    public $born_place;
    public $photo;
    public $history;
    public $id_reproduction;
    public $id_pet_type;
    public $id_breed;
    public $id_owner;
    public $id_company;

    function __construct($id, $name, $color, $sex, $born_date, $born_place, $photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $id_company) {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->sex = $sex;
        $this->born_date = $born_date;
        $this->born_place = $born_place;
        $this->photo = $photo;
        $this->history = $history;
        $this->id_reproduction = $id_reproduction;
        $this->id_pet_type = $id_pet_type;
        $this->id_breed = $id_breed;
        $this->id_owner = $id_owner;
        $this->id_company = $id_company;
    }

}
