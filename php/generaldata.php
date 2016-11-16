<?php
include_once 'connection.php';

class GeneralDataTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($generaldatadate, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $idcompany) {
		$sql = "INSERT generaldata(generaldatadate,heartrate,breathingfrequency,temperature,heartbeat,corporalcondition,linfonodulos,mucous,dh,weight,mood,tusigo,anamnesis,findings,clinicaltreatment,formulanumber,formula,recomendations,observations,idcompany) VALUES('$generaldatadate', $heartrate, $breathingfrequency, $temperature, '$heartbeat', '$corporalcondition', '$linfonodulos', '$mucous', $dh, $weight, '$mood', '$tusigo', '$anamnesis', '$findings', '$clinicaltreatment', $formulanumber, '$formula', '$recomendations', '$observations', $idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $generaldatadate, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations) {
		$sql = "UPDATE generaldata SET generaldatadate = '$generaldatadate', heartrate = $heartrate, breathingfrequency = $breathingfrequency, temperature = $temperature, heartbeat = '$heartbeat', corporalcondition = '$corporalcondition', linfonodulos = '$linfonodulos', mucous = '$mucous', dh = $dh, weight = $weight, mood = '$mood', tusigo = '$tusigo', anamnesis = '$anamnesis', findings = '$findings', clinicaltreatment = '$clinicaltreatment', formulanumber = $formulanumber, formula = '$formula', recomendations = '$recomendations', observations = '$observations' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE generaldata SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM generaldata WHERE id = $id";
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