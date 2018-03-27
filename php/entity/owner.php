<?php

class Owner {

    public $id;
    public $document;
    public $name;
    public $last_name;
    public $email;
    public $address;
    public $phone1;
    public $phone2;
    public $id_company;

    function __construct($id, $document, $name, $last_name, $email, $address, $phone1, $phone2, $id_company) {
        $this->id = $id;
        $this->document = $document;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->address = $address;
        $this->phone1 = $phone1;
        $this->phone2 = $phone2;
        $this->id_company = $id_company;
    }

    public function getDocument() {
        if ($this->document !== NULL) {
            return "'" . $this->document . "'";
        } else {
            return "''";
        }
    }

    public function getName() {
        if ($this->name !== NULL) {
            return "'" . $this->name . "'";
        } else {
            return "''";
        }
    }

    public function getLastName() {
        if ($this->last_name !== NULL) {
            return "'" . $this->last_name . "'";
        } else {
            return "''";
        }
    }

    public function getEmail() {
        if ($this->email !== NULL) {
            return "'" . $this->email . "'";
        } else {
            return 'null';
        }
    }

    public function getAddress() {
        if ($this->address !== NULL) {
            return "'" . $this->address . "'";
        } else {
            return 'null';
        }
    }

    public function getPhone() {
        if ($this->phone1 !== NULL) {
            return "'" . $this->phone1 . "'";
        } else {
            return "''";
        }
    }

    public function getPhone2() {
        if ($this->phone2 !== NULL) {
            return "'" . $this->phone2 . "'";
        } else {
            return 'null';
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
