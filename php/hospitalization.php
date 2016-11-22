<?php
include_once 'connection.php';

class HospitalizationTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($initialdate, $finaldate, $comments, $recomendations, $formulanumber, $formula, $receivedby, $idpet) {
		$sql = "INSERT hospitalization(initialdate,finaldate,comments,recomendations,formulanumber,formula,receivedby,idpet) 
		VALUES('$initialdate','$finaldate','$comments','$recomendations',$formulanumber,'$formula','$receivedby',$idpet)";
		return $this -> conn -> query($sql);
	}
	
	public function insertNonFinalDate($initialdate, $comments, $recomendations, $formulanumber, $formula, $receivedby, $idpet) {
		$sql = "INSERT hospitalization(initialdate,comments,recomendations,formulanumber,formula,receivedby,idpet) 
		VALUES('$initialdate','$comments','$recomendations',$formulanumber,'$formula','$receivedby',$idpet)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $initialdate, $finaldate, $comments, $recomendations, $formulanumber, $formula, $receivedby) {
		$sql = "UPDATE hospitalization SET initialdate = '$initialdate', finaldate = '$finaldate', comments = '$comments',
		recomendations = '$recomendations', formulanumber = $formulanumber, formula = 'formula', receivedby = '$receivedby' 
		WHERE id = $id";
		return $this -> conn -> query($sql);
	}
	
	public function updateNonFinalDate($id, $initialdate, $comments, $recomendations, $formulanumber, $formula, $receivedby) {
		$sql = "UPDATE hospitalization SET initialdate = '$initialdate', finaldate = null, comments = '$comments',
		recomendations = '$recomendations', formulanumber = $formulanumber, formula = 'formula', receivedby = '$receivedby' 
		WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE hospitalization SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idpet) {
		$sql = "SELECT * FROM hospitalization WHERE idpet = $idpet AND enabled = 1 ORDER BY initialdate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM hospitalization WHERE id = $id";
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