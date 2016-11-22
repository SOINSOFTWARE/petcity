<?php
include_once 'connection.php';

class HospitalizationTreatmentTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idhospitalization, $drugname, $posol, $dose, $frequency, $administration, $schedule) {
		$sql = "INSERT hospitalizationtreatment(idhospitalization,drugname,posol,dose,frequency,administration,schedule) 
		VALUES($idhospitalization,'$drugname','$posol','$dose','$frequency','$administration','$schedule')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $drugname, $posol, $dose, $frequency, $administration, $schedule) {
		$sql = "UPDATE hospitalizationtreatment SET drugname = '$drugname', posol = '$posol',
		dose = '$dose', frequency = '$frequency', administration = '$administration', schedule = '$schedule' 
		WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE hospitalizationtreatment SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idhospitalization) {
		$sql = "SELECT * FROM hospitalizationtreatment WHERE idhospitalization = $idhospitalization AND enabled = 1 ORDER BY drugname";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM hospitalizationtreatment WHERE id = $id";
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