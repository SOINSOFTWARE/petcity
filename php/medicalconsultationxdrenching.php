<?php
include_once 'connection.php';

class MedicalConsultationXDrenchingTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idmedicalconsultation, $iddrenching) {
		$sql = "INSERT medicalconsultationxdrenching(idmedicalconsultation,iddrenching) VALUES($idmedicalconsultation,$iddrenching)";
		return $this -> conn -> query($sql);
	}

	public function select($idmedicalconsultation) {
		$sql = "SELECT * FROM medicalconsultationxdrenching WHERE idmedicalconsultation = $idmedicalconsultation AND enabled = 1";
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