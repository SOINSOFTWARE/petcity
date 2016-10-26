<?php
include_once 'connection.php';

class OwnerTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($document, $name, $lastName, $email, $address, $phone1, $phone2, $idcompany) {
		$sql = "INSERT owner(document,name,lastname,email,address,phone,phone2,idcompany) VALUES('$document','$name','$lastName','$email','$address','$phone1','$phone2',$idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $document, $name, $lastName, $email, $address, $phone1, $phone2) {
		$sql = "UPDATE owner SET document = '$document', name = '$name', lastname = '$lastName', email = '$email', address = '$address', phone = '$phone1', phone2 = '$phone2' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE owner SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT * FROM owner WHERE (idcompany IS NULL OR idcompany = $idcompany) AND enabled = 1 ORDER BY name ASC";
		return mysqli_query($this -> conn, $sql);
	}
	
	public function selectIdByDocument($document, $idcompany) {
		$id = 0;
		$sql = "SELECT * FROM owner WHERE document = '$document' AND idcompany = $idcompany";
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