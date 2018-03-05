<?php

class Company {

    private $id;
    private $document;
    private $name;
    private $paid;
    private $creation;
    private $enabled;
    private $photo;
    private $initial_custom_id;
    private $actual_custom_id;

    function __construct($id, $document, $name, $paid, $creation, $enabled, $photo, $initial_custom_id, $actual_custom_id) {
        $this->id = $id;
        $this->document = $document;
        $this->name = $name;
        $this->paid = $paid;
        $this->creation = $creation;
        $this->enabled = $enabled;
        $this->photo = $photo;
        $this->initial_custom_id = $initial_custom_id;
        $this->actual_custom_id = $actual_custom_id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDocument() {
        return $this->document;
    }

    public function setDocument($document) {
        $this->document = $document;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function isPaid() {
        return $this->paid;
    }

    public function setPaid($paid) {
        $this->paid = $paid;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function getInitialCustomId() {
        return $this->initial_custom_id;
    }

    public function setInitialCustomId($initial_custom_id) {
        $this->initial_custom_id = $initial_custom_id;
    }

    public function getActualCustomId() {
        return $this->actual_custom_id;
    }

    public function setActualCustomId($actual_custom_id) {
        $this->actual_custom_id = $actual_custom_id;
    }

}
