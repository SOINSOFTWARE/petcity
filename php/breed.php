<?php
include_once 'connection.php';

class BreedTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($name, $idpettype, $idcompany) {
		$sql = "INSERT breed(name,idpettype,idcompany) VALUES('$name',$idpettype,$idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $name) {
		$sql = "UPDATE breed SET name = '$name' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE breed SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT br.id AS id, br.name AS breed, ty.name AS pettype, br.idcompany AS idcompany FROM breed br JOIN pettype ty ON br.idpettype = ty.id WHERE (br.idcompany IS NULL OR br.idcompany = $idcompany) AND br.enabled = 1 AND ty.enabled = 1 ORDER BY ty.name, br.name ASC";
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