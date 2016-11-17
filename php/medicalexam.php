<?php
include_once 'connection.php';

class MedicalExamTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idmedicalconsultation, $examdate, $name, $results, $filepath, $formulanumber, $formula) {
		$sql = "INSERT medicalexam(idmedicalconsultation,examdate,name,results,filepath,formulanumber,formula) 
		VALUES($idmedicalconsultation,'$examdate','$name','$results','$filepath',$formulanumber,'$formula')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $examdate, $name, $results, $formulanumber, $formula) {
		$sql = "UPDATE medicalexam SET examdate = '$examdate', name = '$name', results = '$results',
		formulanumber = $formulanumber, formula = '$formula' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE medicalexam SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idmedicalconsultation) {
		$sql = "SELECT * FROM medicalexam WHERE idmedicalconsultation = $idmedicalconsultation AND enabled = 1 ORDER BY examdate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM medicalexam WHERE id = $id";
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