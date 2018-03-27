<?php

include_once 'owner.php';

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
    public $type_name;
    public $breed_name;
    public $owner;

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

    public function getName() {
        if ($this->name !== NULL) {
            return "'" . $this->name . "'";
        } else {
            return "''";
        }
    }

    public function getColor() {
        if ($this->color !== NULL) {
            return "'" . $this->color . "'";
        } else {
            return "''";
        }
    }

    public function getSex() {
        if ($this->sex !== NULL) {
            return "'" . $this->sex . "'";
        } else {
            return "''";
        }
    }

    public function getBornDate() {
        if ($this->born_date !== NULL) {
            return "'" . $this->born_date . "'";
        } else {
            return 'null';
        }
    }

    public function getBornPlace() {
        if ($this->born_place !== NULL) {
            return "'" . $this->born_place . "'";
        } else {
            return "''";
        }
    }

    public function getPhoto() {
        if ($this->photo !== NULL) {
            return "'" . $this->photo . "'";
        } else {
            return 'null';
        }
    }

    public function getHistory() {
        if ($this->history !== NULL) {
            return "'" . $this->history . "'";
        } else {
            return 'null';
        }
    }

    public function getIdReproduction() {
        if ($this->id_reproduction !== NULL) {
            return $this->id_reproduction;
        } else {
            return 0;
        }
    }

    public function getIdPetType() {
        if ($this->id_pet_type !== NULL) {
            return $this->id_pet_type;
        } else {
            return 0;
        }
    }

    public function getIdBreed() {
        if ($this->id_breed !== NULL) {
            return $this->id_breed;
        } else {
            return 0;
        }
    }

    public function getIdOwner() {
        if ($this->id_owner !== NULL) {
            return $this->id_owner;
        } else {
            return 0;
        }
    }

    public function getIdCompany() {
        if ($this->id_company !== NULL) {
            return $this->id_company;
        } else {
            return 0;
        }
    }

}
