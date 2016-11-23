<?php
include_once 'connection.php';

class SurgeryExamTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idsurgery, $examdate, $name, $results, $filepath, $formulanumber, $formula) {
		$sql = "INSERT surgeryexam(idsurgery,examdate,name,results,filepath,formulanumber,formula) 
		VALUES($idsurgery,'$examdate','$name','$results','$filepath',$formulanumber,'$formula')";
		return $this -> conn -> query($sql);
	}

	public function update($id, $examdate, $name, $results, $formulanumber, $formula) {
		$sql = "UPDATE surgeryexam SET examdate = '$examdate', name = '$name', results = '$results',
		formulanumber = $formulanumber, formula = '$formula' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE surgeryexam SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idsurgery) {
		$sql = "SELECT * FROM surgeryexam WHERE idsurgery = $idsurgery AND enabled = 1 ORDER BY examdate DESC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM surgeryexam WHERE id = $id";
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