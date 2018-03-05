<?php

class Notification {

    public $id;
    public $title;
    public $message;
    public $date;
    public $id_pet;

    function __construct($id, $title, $message, $date, $id_pet) {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
        $this->date = $date;
        $this->id_pet = $id_pet;
    }

}
