<?php
include_once 'connection.php';

class AdverseReactionsTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($adversereactiondate, $type, $allergen, $presentation, $comercialname, $dose, $administration, $clinicalsign, $idpet) {
		$sql = "INSERT adversereactions(adversereactiondate,type,allergen,presentation,comercialname,dose,administration,clinicalsign,idpet) VALUES('$adversereactiondate','$type','$allergen','$presentation','$comercialname','$dose','$administration','$clinicalsign',$idpet)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $adversereactiondate, $type, $allergen, $presentation, $comercialname, $dose, $administration, $clinicalsign) {
		$sql = "UPDATE adversereactions SET adversereactiondate = '$adversereactiondate', type = '$type',
		allergen = '$allergen', presentation = '$presentation', comercialname = '$comercialname',
		dose = '$dose', administration = '$administration', clinicalsign = '$clinicalsign' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE adversereactions SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idpet) {
		$sql = "SELECT * FROM adversereactions WHERE idpet = $idpet AND enabled = 1 ORDER BY adversereactiondate";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM adversereactions WHERE id = $id";
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