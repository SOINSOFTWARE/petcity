<?php
include_once 'connection.php';

class HospitalizationControlTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idhospitalization, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdate) {
		$sql = "INSERT hospitalizationcontrol(idhospitalization,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams,nextdate) 
		VALUES($idhospitalization,$idgeneraldata,'$evolution','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams','$nextdate')";
		return $this -> conn -> query($sql);
	}

	public function insertNonNextDate($idhospitalization, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams) {
		$sql = "INSERT hospitalizationcontrol(idhospitalization,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams) 
		VALUES($idhospitalization,$idgeneraldata,'$evolution','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdate) {
		$sql = "UPDATE hospitalizationcontrol SET evolution = '$evolution', diagnosisrecomendations = '$diagnosisrecomendations',
		diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams', nextdate = '$nextdate' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function updateNonNextDate($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams) {
		$sql = "UPDATE hospitalizationcontrol SET evolution = '$evolution', diagnosisrecomendations = '$diagnosisrecomendations',
		diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams', nextdate = null WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE hospitalizationcontrol SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idhospitalization) {
		$sql = "SELECT mc.id AS idhospitalcontrol, mc.*, gd.* FROM hospitalizationcontrol mc JOIN generaldata gd ON mc.idgeneraldata = gd.id WHERE mc.idhospitalization = $idhospitalization AND mc.enabled = 1 ORDER BY gd.generaldatadate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM hospitalizationcontrol WHERE id = $id";
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