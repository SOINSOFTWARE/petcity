<?php
include_once 'connection.php';

class MedicalConsultationTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idclinichistory, $idfoodbrand, $weight, $corporalcondition, $consultationdate, $motive, $anamnesis, $illness, $findings, $diagnosis, $treatment, $control, $idcompany) {
		$sql = "INSERT medicalconsultation(idclinichistory,idfoodbrand,weight,corporalcondition,consultationdate,motive,anamnesis,illness,findings,diagnosis,treatment,control,idcompany) 
		VALUES($idclinichistory,$idfoodbrand,$weight,'$corporalcondition','$consultationdate','$motive','$anamnesis','$illness','$findings','$diagnosis','$treatment','$control',$idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $idfoodbrand, $weight, $corporalcondition, $consultationdate, $motive, $anamnesis, $illness, $findings, $diagnosis, $treatment, $control) {
		$sql = "UPDATE medicalconsultation SET idfoodbrand = $idfoodbrand, weight = $weight, corporalcondition = '$corporalcondition',
			consultationdate = '$consultationdate', motive = '$motive', anamnesis = '$anamnesis', illness = '$illness',
			findings = '$findings', diagnosis = '$diagnosis', treatment = '$treatment', control = '$control' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE medicalconsultation SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT * FROM medicalconsultation WHERE idcompany = $idcompany AND enabled = 1 ORDER BY name ASC";
		return mysqli_query($this -> conn, $sql);
	}
	
	public function selectById($id) {
		$sql = "SELECT * FROM medicalconsultation WHERE id = $id";
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