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

}
