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
    
    public function getTitle() {
        if ($this->title !== NULL) {
            return "'" . $this->title . "'";
        } else {
            return "''";
        }
    }
    
    public function getMessage() {
        if ($this->message !== NULL) {
            return "'" . $this->message . "'";
        } else {
            return "''";
        }
    }
    
    public function getDate() {
        if ($this->date !== NULL && $this->date !== '') {
            $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $this->date . ' 00:00:00');
            return "'" . $dateobj->format("Y-m-d") . "'";
        } else {
            return 'null';
        }
    }
    
    public function getIdPet() {
        if ($this->id_pet !== NULL) {
            return $this->id_pet;
        } else {
            return 0;
        }
    }
}
