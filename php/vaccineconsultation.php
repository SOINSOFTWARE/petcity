<?php

include_once 'connection.php';
include_once 'entity/vaccineconsultation.php';

class VaccineConsultationTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($vaccine_consultation) {
        $id_general_data = $vaccine_consultation->getIdGeneralData();
        $apply_vaccine = $vaccine_consultation->getApplyVaccine();
        $id_vaccine = $vaccine_consultation->getIdVaccine();
        $batch = $vaccine_consultation->getBatch();
        $expiration = $vaccine_consultation->getExpiration();
        $id_pet = $vaccine_consultation->getIdPet();
        $sql = "INSERT vaccineconsultation(idgeneraldata,applyvaccine,idvaccine,batch,expiration,idpet) "
                . "VALUES($id_general_data, $apply_vaccine, $id_vaccine, $batch, $expiration, $id_pet)";
        return $this->conn->query($sql);
    }

    public function update($vaccine_consultation) {
        $id = $vaccine_consultation->id;
        $apply_vaccine = $vaccine_consultation->getApplyVaccine();
        $id_vaccine = $vaccine_consultation->getIdVaccine();
        $batch = $vaccine_consultation->getBatch();
        $expiration = $vaccine_consultation->getExpiration();
        $sql = "UPDATE vaccineconsultation "
                . "SET applyvaccine = $apply_vaccine, "
                . "idvaccine = $id_vaccine, "
                . "batch = $batch, "
                . "expiration = $expiration "
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE vaccineconsultation SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function select($idpet) {
        $sql = "SELECT vc.id AS idvaccineconsultation, vc.*, gd.*, v.* "
                . "FROM vaccineconsultation vc "
                . "LEFT JOIN generaldata gd ON vc.idgeneraldata = gd.id "
                . "LEFT JOIN vaccine v ON vc.idvaccine = v.id  "
                . "WHERE vc.idpet = $idpet AND vc.enabled = 1 "
                . "ORDER BY gd.generaldatadate DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function selectById($id) {
        $sql = "SELECT * FROM vaccineconsultation WHERE id = $id";
        $results = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_array($results);
        if ($row !== NULL) {
            return new VaccineConsultation($row["id"], $row["idgeneraldata"], $row["applyvaccine"], $row["idvaccine"], $row["batch"], $row["expiration"], $row["idpet"]);
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

?>