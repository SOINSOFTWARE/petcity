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

    public function insert($evidence_file) {
        $id_medical_consultation = $evidence_file->getIdMedicalConsultation();
        $name = $evidence_file->getName();
        $file_path = $evidence_file->getFilePath();
        $file_date = $evidence_file->getFileDate();
        $description = $evidence_file->getDescription();
        $sql = "INSERT evidencefiles(idmedicalconsultation,name,filepath,filedate,description) "
                . "VALUES($id_medical_consultation, $name, $file_path, $file_date, $description)";
        return $this->conn->query($sql);
    }

    public function update($evidence_file) {
        $id = $evidence_file->id;
        $name = $evidence_file->getName();
        $file_date = $evidence_file->getFileDate();
        $description = $evidence_file->getDescription();
        $sql = "UPDATE evidencefiles "
                . "SET name = $name, "
                . "filedate = $file_date, "
                . "description = $description "               
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE evidencefiles SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function selectById($id) {
        $sql = "SELECT * FROM evidencefiles WHERE id = $id";
        $results = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_array($results);
        if ($row !== NULL) {
            return new EvidenceFiles($row["id"], $row["idmedicalconsultation"], $row["name"], $row["filepath"], $row["filedate"], $row["description"]);
        } else {
            return NULL;
        }
    }

    public function selectByMedicalConsultation($id_medical_consultation) {
        $sql = "SELECT * FROM evidencefiles WHERE idmedicalconsultation = $id_medical_consultation AND enabled = 1";
        $results = mysqli_query($this->conn, $sql);
        $evidencefiles_array = array();
        while ($row = mysqli_fetch_array($results)) {
            array_push($evidencefiles_array, new EvidenceFiles($row["id"], $row["idmedicalconsultation"], $row["name"], $row["filepath"], $row["filedate"], $row["description"]));
        }
        return $evidencefiles_array;
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
