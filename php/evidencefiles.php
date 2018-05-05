<?php

include_once 'connection.php';
include_once 'entity/evidencefiles.php';

class EvidenceFilesTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($evidence_files) {
        $id_medical_consultation = $evidence_files->getIdMedicalConsultation();
        $name = $evidence_files->getName();
        $file_path = $evidence_files->getFilePath();
        $sql = "INSERT evidencefiles(idmedicalconsultation,name,filepath) "
                . "VALUES($id_medical_consultation, $name, $file_path)";
        return $this->conn->query($sql);
    }

    public function update($id, $name) {            
        $sql = "UPDATE evidencefiles "
                . "SET name = '$name '"               
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE evidencefiles SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function selectById($id) {
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM evidencefiles WHERE id = $id";
            return mysqli_query($this->conn, $sql);
        } else {
            return NULL;
        }
    }

    public function selectByMedicalConsultarion($id_medical_consultation) {
        $sql = "SELECT * FROM evidencefiles WHERE idmedicalconsultation = $id_medical_consultation";
        $results = mysqli_query($this->conn, $sql);
        $evidencefiles_array = NULL;
        while ($row = mysqli_fetch_array($results)) {
            if ($evidencefiles_array === NULL) {
                $evidencefiles_array = [];
            }
            $evidencefiles_array[] = EvidenceFiles($row["id"], $row["idmedicalconsultation"], $row["name"], $row["filepath"]);
        }
        return $evidencefiles_array;
    }

    public function select($id_medical_consultation) {
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM evidencefiles WHERE idmedicalconsultation = $id_medical_consultation AND enabled = 1";
            return mysqli_query($this->conn, $sql);
        } else {
            return NULL;
        }
    }

    public function selectLastInsertId() {
        return mysqli_insert_id($this->conn);
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getError() {
        return $this->conn->error;
    }

}

?>