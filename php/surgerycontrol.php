<?php
include_once 'connection.php';

class SurgeryControlTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idsurgery, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdate) {
		$sql = "INSERT surgerycontrol(idsurgery,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams,nextdate) 
		VALUES($idsurgery,$idgeneraldata,'$evolution','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams','$nextdate')";
		return $this -> conn -> query($sql);
	}

	public function insertNonNextDate($idsurgery, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams) {
		$sql = "INSERT surgerycontrol(idsurgery,idgeneraldata,evolution,diagnosisrecomendations,diagnosissamples,diagnosisexams) 
		VALUES($idsurgery,$idgeneraldata,'$evolution','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdate) {
		$sql = "UPDATE surgerycontrol SET evolution = '$evolution', diagnosisrecomendations = '$diagnosisrecomendations',
		diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams', nextdate = '$nextdate' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function updateNonNextDate($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams) {
		$sql = "UPDATE surgerycontrol SET evolution = '$evolution', diagnosisrecomendations = '$diagnosisrecomendations',
		diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams', nextdate = null WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE surgerycontrol SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idsurgery) {
		$sql = "SELECT mc.id AS idsurgerycontrol, mc.*, gd.* FROM surgerycontrol mc JOIN generaldata gd ON mc.idgeneraldata = gd.id WHERE mc.idsurgery = $idsurgery AND mc.enabled = 1 ORDER BY gd.generaldatadate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM surgerycontrol WHERE id = $id";
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