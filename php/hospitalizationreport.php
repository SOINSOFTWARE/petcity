<?php
include_once 'connection.php';

class HospitalizationReportTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idhospitalization, $idgeneraldata, $reporttime, $evolution) {
		$sql = "INSERT hospitalizationreport(idhospitalization,idgeneraldata,reporttime,evolution) 
		VALUES($idhospitalization,$idgeneraldata,'$reporttime','$evolution')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $reporttime, $evolution) {
		$sql = "UPDATE hospitalizationreport SET reporttime = '$reporttime', evolution = '$evolution'
		WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE hospitalizationreport SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idhospitalization) {
		$sql = "SELECT hr.id AS idhospitalreport, hr.*, gd.* FROM hospitalizationreport hr JOIN generaldata gd ON hr.idgeneraldata = gd.id WHERE hr.idhospitalization = $idhospitalization AND hr.enabled = 1 ORDER BY gd.generaldatadate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM hospitalizationreport WHERE id = $id";
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