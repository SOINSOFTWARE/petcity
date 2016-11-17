<?php
include_once 'connection.php';

class MedicalControlTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idmedicalconsultation, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdate) {
		$sql = "INSERT medicalcontrol(idmedicalconsultation,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams,nextdate) 
		VALUES($idmedicalconsultation,$idgeneraldata,'$evolution','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams','$nextdate')";
		return $this -> conn -> query($sql);
	}

	public function insertNonNextDate($idmedicalconsultation, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams) {
		$sql = "INSERT medicalcontrol(idmedicalconsultation,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams) 
		VALUES($idmedicalconsultation,$idgeneraldata,'$evolution','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdate) {
		$sql = "UPDATE medicalcontrol SET evolution = '$evolution', diagnosisrecomendations = '$diagnosisrecomendations',
		diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams', nextdate = '$nextdate' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function updateNonNextDate($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams) {
		$sql = "UPDATE medicalcontrol SET evolution = '$evolution', diagnosisrecomendations = '$diagnosisrecomendations',
		diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams', nextdate = null WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE medicalcontrol SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idmedicalconsultation) {
		$sql = "SELECT mc.id AS idmedicalcontrol, mc.*, gd.* FROM medicalcontrol mc JOIN generaldata gd ON mc.idgeneraldata = gd.id WHERE mc.idmedicalconsultation = $idmedicalconsultation AND mc.enabled = 1 ORDER BY gd.generaldatadate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM medicalcontrol WHERE id = $id";
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