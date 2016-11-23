<?php
include_once 'connection.php';

class SurgeryTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($idclinichistory, $idgeneraldata, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast, $nextdate, $idcompany) {
		$sql = "INSERT surgery(idclinichistory,idgeneraldata,name,havesurgery,anestheticprotocol,premedication,presumptivediagnosis,differentialdiagnosis,diagnosisrecomendations,diagnosissamples,diagnosisexams,havehospitalization,definitivediagnosis,forecast,nextdate,idcompany) 
		VALUES($idclinichistory,$idgeneraldata,'$name',$havesurgery,'$anestheticprotocol','$premedication','$presumptivediagnosis','$differentialdiagnosis','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams',$havehospitalization,'$definitivediagnosis','$forecast','$nextdate',$idcompany)";
		return $this -> conn -> query($sql);
	}
	
	public function insertNonNextDate($idclinichistory, $idgeneraldata, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast, $idcompany) {
		$sql = "INSERT surgery(idclinichistory,idgeneraldata,name,havesurgery,anestheticprotocol,premedication,presumptivediagnosis,differentialdiagnosis,diagnosisrecomendations,diagnosissamples,diagnosisexams,havehospitalization,definitivediagnosis,forecast,idcompany) 
		VALUES($idclinichistory,$idgeneraldata,'$name',$havesurgery,'$anestheticprotocol','$premedication','$presumptivediagnosis','$differentialdiagnosis','$diagnosisrecomendations','$diagnosissamples','$diagnosisexams',$havehospitalization,'$definitivediagnosis','$forecast',$idcompany)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast, $nextdate) {
		$sql = "UPDATE surgery SET name = '$name', havesurgery = $havesurgery, anestheticprotocol = '$anestheticprotocol', premedication = '$premedication',
			presumptivediagnosis = '$presumptivediagnosis', differentialdiagnosis = '$differentialdiagnosis', havehospitalization = $havehospitalization
			diagnosisrecomendations = '$diagnosisrecomendations', diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams',
			definitivediagnosis = '$definitivediagnosis', forecast = '$forecast', nextdate = '$nextdate' WHERE id = $id";
		return $this -> conn -> query($sql);
	}
	
	public function updateNonNextDate($id, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast) {
		$sql = "UPDATE surgery SET name = '$name', havesurgery = $havesurgery, anestheticprotocol = '$anestheticprotocol', premedication = '$premedication',
			presumptivediagnosis = '$presumptivediagnosis', differentialdiagnosis = '$differentialdiagnosis', havehospitalization = $havehospitalization
			diagnosisrecomendations = '$diagnosisrecomendations', diagnosissamples = '$diagnosissamples', diagnosisexams = '$diagnosisexams',
			definitivediagnosis = '$definitivediagnosis', forecast = '$forecast' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE surgery SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idcompany) {
		$sql = "SELECT * FROM surgery WHERE idcompany = $idcompany AND enabled = 1 ORDER BY name ASC";
		return mysqli_query($this -> conn, $sql);
	}
	
	public function selectById($id) {
		$sql = "SELECT * FROM surgery WHERE id = $id";
		return mysqli_query($this -> conn, $sql);
	}
	
	public function selectByIdClinicHistory($idclinichistory) {
		$sql = "SELECT md.id AS idsurgery, md.*, gd.* FROM surgery md JOIN generaldata gd ON md.idgeneraldata = gd.id WHERE md.idclinichistory = $idclinichistory AND md.enabled = 1 ORDER BY gd.generaldatadate DESC";
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