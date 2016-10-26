<?php
include_once 'connection.php';

class ReproductionTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($name, $idcompany) {
		$sql = "INSERT reproduction(name,idcompany) VALUES('$name',$idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $name) {
		$sql = "UPDATE reproduction SET name = '$name' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE reproduction SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT * FROM reproduction WHERE (idcompany IS NULL OR idcompany = $idcompany) AND enabled = 1 ORDER BY name ASC";
		return mysqli_query($this -> conn, $sql);
	}

	public function getConnection() {
		return $this -> conn;
	}

	public function getError() {
		return $this -> conn -> error;
	}

}
?>