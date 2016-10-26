<?php
include_once 'connection.php';

class PetTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($name, $color, $sex, $borndate, $bornplace, $idreproduction, $idpettype, $idbreed, $idowner, $idcompany) {
		$sql = "INSERT pet(name,color,sex,borndate,bornplace,idreproduction,idpettype,idbreed,idowner,idcompany) VALUES('$name', '$color', '$sex', '$borndate', '$bornplace', $idreproduction, $idpettype, $idbreed, $idowner, $idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $name, $color, $sex, $borndate, $bornplace, $idreproduction, $idpettype, $idbreed) {
		$sql = "UPDATE pet SET name = '$name', color = '$color', sex = '$sex', borndate = '$borndate', bornplace = '$bornplace', idreproduction = $idreproduction, idpettype = $idpettype, idbreed = $idbreed WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE pet SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT * FROM pet WHERE (idcompany IS NULL OR idcompany = $idcompany) AND enabled = 1 ORDER BY name ASC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectIdByOwner($name, $idowner, $idcompany) {
		$id = 0;
		$sql = "SELECT * FROM pet WHERE name = '$name' AND idowner = $idowner AND idcompany = $idcompany";
		$results = mysqli_query($this -> conn, $sql);
		if ($rows = mysqli_fetch_array($results)) {
			$id = $rows["id"];
		}
		return $id;
	}

	public function getConnection() {
		return $this -> conn;
	}

	public function getError() {
		return $this -> conn -> error;
	}

}
?>