<?php

class User {

    public $id, $document, $name, $last_name, $phone, $email, $password, $id_company;

    function __construct($id, $document, $name, $last_name, $phone, $email, $password, $id_company) {
        $this->id = $id;
        $this->document = $document;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->id_company = $id_company;
    }

}
