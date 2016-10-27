<?php
include_once 'connection.php';

class MedicalConsultationXVaccineTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idmedicalconsultation, $idvaccine) {
		$sql = "INSERT medicalconsultationxvaccine(idmedicalconsultation,idvaccine) VALUES($idmedicalconsultation,$idvaccine)";
		return $this -> conn -> query($sql);
	}

	public function select($idmedicalconsultation) {
		$sql = "SELECT * FROM medicalconsultationxvaccine WHERE idmedicalconsultation = $idmedicalconsultation AND enabled = 1";
		return mysqli_query($this -> conn, $sql);
	}

	public function getConnection() {
		return $this -> conn;
	}

	public function getError() {
		return $this -> conn -> error;
	}

}
?>