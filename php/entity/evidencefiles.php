<?php

class EvidenceFiles {

    public $id;
    public $id_medical_consultation;
    public $name;
    public $file_path;
    public $file_date;
    public $description;

    function __construct($id, $id_medical_consultation, $name, $file_path, $file_date, $description) {
        $this->id = intval($id);
        $this->id_medical_consultation = intval($id_medical_consultation);
        $this->name = $name;
        $this->file_path = $file_path;
        $this->file_date = $file_date;
        $this->description = $description;
    }

    public function getIdMedicalConsultation() {
        if ($this->id_medical_consultation !== NULL && $this->id_medical_consultation > 0) {
            return $this->id_medical_consultation;
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
