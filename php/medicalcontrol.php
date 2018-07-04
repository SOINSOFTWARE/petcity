<?php

include_once 'connection.php';
include_once 'entity/medicalcontrol.php';

class MedicalControlTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($medical_control) {
        $id_medical_consultation = $medical_control->getIdMedicalConsultation();
        $id_general_data = $medical_control->getIdGeneralData();
        $evolution = $medical_control->getEvolution();
        $diagnosis_recomendations = $medical_control->getDiagnosisRecomendations();
        $diagnosis_samples = $medical_control->getDiagnosisSamples();
        $diagnosis_exams = $medical_control->getDiagnosisExams();
        $next_date = $medical_control->getNextDate();
        $sql = "INSERT medicalcontrol(idmedicalconsultation,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams,nextdate) 
		VALUES($id_medical_consultation,$id_general_data,$evolution,$diagnosis_recomendations,$diagnosis_samples,$diagnosis_exams,$next_date)";
        return $this->conn->query($sql);
    }

    public function update($medical_control) {
        $evolution = $medical_control->getEvolution();
        $diagnosis_recomendations = $medical_control->getDiagnosisRecomendations();
        $diagnosis_samples = $medical_control->getDiagnosisSamples();
        $diagnosis_exams = $medical_control->getDiagnosisExams();
        $next_date = $medical_control->getNextDate();
        $id = $medical_control->id;
        $sql = "UPDATE medicalcontrol "
                . "SET evolution = $evolution,"
                . "diagnosisrecomendations = $diagnosis_recomendations,"
                . "diagnosissamples = $diagnosis_samples,"
                . "diagnosisexams = $diagnosis_exams,"
                . "nextdate = $next_date "
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE medicalcontrol SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function select($idmedicalconsultation) {
        $sql = "SELECT mc.id AS idmedicalcontrol, mc.*, gd.* FROM medicalcontrol mc JOIN generaldata gd ON mc.idgeneraldata = gd.id WHERE mc.idmedicalconsultation = $idmedicalconsultation AND mc.enabled = 1 ORDER BY gd.generaldatadate DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function selectById($id) {
        $sql = "SELECT * FROM medicalcontrol WHERE id = $id";
        $results = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_array($results);
        if ($row !== NULL) {
            return new MedicalControl($row["id"], $row["idmedicalconsultation"], $row["idgeneraldata"], $row["evolution"], $row["diagnosisrecomendations"], $row["diagnosissamples"], $row["diagnosisexams"], $row["nextdate"]);
        }
        return NULL;
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
