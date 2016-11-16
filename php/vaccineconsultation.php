<?php
include_once 'connection.php';

class VaccineConsultationTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idgeneraldata, $applyvaccine, $idvaccine, $batch, $expiration, $idpet) {
		$sql = "INSERT vaccineconsultation(idgeneraldata,applyvaccine,idvaccine,batch,expiration,idpet) VALUES($idgeneraldata, $applyvaccine, $idvaccine, '$batch', '$expiration', $idpet)";
		return $this -> conn -> query($sql);
	}
	
	public function insertNonVaccine($idgeneraldata, $applyvaccine, $idpet) {
		$sql = "INSERT vaccineconsultation(idgeneraldata,applyvaccine,idpet) VALUES($idgeneraldata, $applyvaccine, $idpet)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $applyvaccine, $idvaccine, $batch, $expiration) {
		$sql = "UPDATE vaccineconsultation SET applyvaccine = $applyvaccine, idvaccine = $idvaccine, batch = '$batch', expiration = '$expiration' WHERE id = $id";
		return $this -> conn -> query($sql);
	}
	
	public function updateNonVaccine($id) {
		$sql = "UPDATE vaccineconsultation SET applyvaccine = 0, idvaccine = null, batch = null, expiration = null WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE vaccineconsultation SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idpet) {
		$sql = "SELECT vc.id AS idvaccineconsultation, vc.*, gd.*, v.* FROM vaccineconsultation vc JOIN generaldata gd ON vc.idgeneraldata = gd.id LEFT JOIN vaccine v ON vc.idvaccine = v.id  WHERE vc.idpet = $idpet AND vc.enabled = 1 ORDER BY gd.generaldatadate";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM vaccineconsultation WHERE id = $id";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectLastInsertId() {
		return mysqli_insert_id($this -> conn);
	}

	public function getConnection() {
		return $this -> conn;
	}

	public function getError() {
		return $this -> conn -> error;
	}

}
?>