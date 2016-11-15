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

	public function insert($iddrenching, $drenchingdate, $weight, $dose, $administration, $idpet) {
		$sql = "INSERT medicalconsultationxdrenching(iddrenching,drenchingdate,weight,dose,administration,idpet) VALUES($iddrenching,'$drenchingdate',$weight,'$dose','$administration',$idpet)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $iddrenching, $drenchingdate, $weight, $dose, $administration) {
		$sql = "UPDATE medicalconsultationxdrenching SET iddrenching = $iddrenching, drenchingdate = '$drenchingdate', weight = $weight, dose = '$dose', administration = '$administration'";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE medicalconsultationxdrenching SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idpet) {
		$sql = "SELECT * FROM medicalconsultationxdrenching md JOIN drenching dr ON md.iddrenching = dr.id  WHERE md.idpet = $idpet AND md.enabled = 1 ORDER BY md.drenchingdate";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM medicalconsultationxdrenching WHERE id = $id";
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