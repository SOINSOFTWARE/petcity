<?php
include_once 'connection.php';

class ClinicHistoryTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idpet, $idcompany) {
		$sql = "INSERT clinichistory(idpet,idcompany) VALUES($idpet,$idcompany)";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE clinichistory SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT ch.id AS id, idpet, p.name AS petname, color, sex, borndate, bornplace, idreproduction, p.idpettype, idbreed, idowner, document, o.name AS ownername, lastname, email, address, phone, phone2, pt.name AS pettypename, b.name AS breedname  
		FROM clinichistory ch 
		JOIN pet p ON ch.idpet = p.id 
		JOIN owner o ON p.idowner = o.id 
		JOIN pettype pt ON p.idpettype = pt.id 
		JOIN breed b ON p.idbreed = b.id 
		WHERE ch.idcompany = $idcompany AND ch.enabled = 1 
		ORDER BY petname, pettypename, breedname, lastname, ownername ASC";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectIdByPet($idpet, $idcompany) {
		$id = 0;
		$sql = "SELECT * FROM clinichistory WHERE idpet = $idpet AND idcompany = $idcompany";
		$results = mysqli_query($this -> conn, $sql);
		if ($rows = mysqli_fetch_array($results)) {
			$id = $rows["id"];
		}
		return $id;
	}
	
	public function selectById($id) {
		$sql = "SELECT ch.id AS id, idpet, p.name AS petname, color, sex, borndate, bornplace, idreproduction, p.idpettype, idbreed, idowner, document, o.name AS ownername, lastname, email, address, phone, phone2, pt.name AS pettypename, b.name AS breedname  
		FROM clinichistory ch 
		JOIN pet p ON ch.idpet = p.id 
		JOIN owner o ON p.idowner = o.id 
		JOIN pettype pt ON p.idpettype = pt.id 
		JOIN breed b ON p.idbreed = b.id 
		WHERE ch.id = $id AND ch.enabled = 1";
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