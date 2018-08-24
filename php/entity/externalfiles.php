<?php

class ExternalFiles {

    public $id;
    public $id_clinic_history;
    public $name;
    public $file_path;
    public $file_date;
    public $description;

    function __construct($id, $id_clinic_history, $name, $file_path) {
        $this->id = intval($id);
        $this->id_clinic_history = intval($id_clinic_history);
        $this->name = $name;
        $this->file_path = $file_path;
    }

    public function getIdClinicHistory() {
        if ($this->id_clinic_history !== NULL && $this->id_clinic_history > 0) {
            return $this->id_clinic_history;
        } else {
            return 0;
        }
    }

    public function getName() {
        if ($this->name !== NULL && $this->name !== '') {
            return "'" . $this->name . "'";
        } else {
            return 'null';
        }
    }

    public function getFilePath() {
        if ($this->file_path !== NULL && $this->file_path !== '') {
            return "'" . $this->file_path . "'";
        } else {
            return 'null';
        }
    }
    
    public function getFileDate() {
        if ($this->file_date !== NULL && $this->file_date !== '') {
            $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $this->file_date . ' 00:00:00');
            return "'" . $dateobj->format("Y-m-d") . "'";
        } else {
            return 'null';
        }
    }
    
    public function getDescription() {
        if ($this->description !== NULL && $this->description !== '') {
            return "'" . $this->description . "'";
        } else {
            return 'null';
        }
    }

}
