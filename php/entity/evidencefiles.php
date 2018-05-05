<?php

class EvidenceFiles {

    public $id, $id_medical_consultation, $name, $file_path;

    function __construct($id, $id_medical_consultation, $name, $file_path) {
        $this->id = intval($id);
        $this->id_medical_consultation = intval($id_medical_consultation);
        $this->name = $name;
        $this->file_path = $file_path;
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

}
