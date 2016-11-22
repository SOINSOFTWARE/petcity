<?php
include_once 'connection.php';

class HospitalizationExamTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idhospitalization, $examdate, $name, $results, $filepath) {
		$sql = "INSERT hospitalizationexam(idhospitalization,examdate,name,results,filepath) 
		VALUES($idhospitalization,'$examdate','$name','$results','$filepath')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $examdate, $name, $results) {
		$sql = "UPDATE hospitalizationexam SET examdate = '$examdate', name = '$name', results = '$results',
		WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE hospitalizationexam SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idhospitalization) {
		$sql = "SELECT * FROM hospitalizationexam WHERE idhospitalization = $idhospitalization AND enabled = 1 ORDER BY examdate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM hospitalizationexam WHERE id = $id";
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