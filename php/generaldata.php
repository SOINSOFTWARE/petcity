<?php

include_once 'connection.php';
include_once 'entity/generaldata.php';

class GeneralDataTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($generaldatadate, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $idcompany) {
        $sql = "INSERT generaldata(generaldatadate,heartrate,breathingfrequency,temperature,heartbeat,corporalcondition,linfonodulos,mucous,trc,dh,weight,mood,tusigo,anamnesis,findings,clinicaltreatment,formulanumber,formula,recomendations,observations,idcompany) VALUES('$generaldatadate', $heartrate, $breathingfrequency, $temperature, '$heartbeat', '$corporalcondition', '$linfonodulos', '$mucous', '$trc', $dh, $weight, '$mood', '$tusigo', '$anamnesis', '$findings', '$clinicaltreatment', $formulanumber, '$formula', '$recomendations', '$observations', $idcompany)";
        return $this->conn->query($sql);
    }

    public function update($id, $generaldatadate, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations) {
        $sql = "UPDATE generaldata SET generaldatadate = '$generaldatadate', heartrate = $heartrate, breathingfrequency = $breathingfrequency, temperature = $temperature, heartbeat = '$heartbeat', corporalcondition = '$corporalcondition', linfonodulos = '$linfonodulos', mucous = '$mucous', trc = '$trc', dh = $dh, weight = $weight, mood = '$mood', tusigo = '$tusigo', anamnesis = '$anamnesis', findings = '$findings', clinicaltreatment = '$clinicaltreatment', formulanumber = $formulanumber, formula = '$formula', recomendations = '$recomendations', observations = '$observations' WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE generaldata SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function insertObject($general_data) {
        $date = $general_data->getDate();
        $heart_rate = $general_data->getHeartRate();
        $breathing_frequency = $general_data->getBreathingFrequency();
        $temperature = $general_data->getTemperature();
        $heart_beat = $general_data->getHeartBeat();
        $corporal_condition = $general_data->getCorporalCondition();
        $linfonodulos = $general_data->getLinfonodulos();
        $mucous = $general_data->getMucous();
        $trc = $general_data->getTrc();
        $dh = $general_data->getDh();
        $weight = $general_data->getWeight();
        $mood = $general_data->getMood();
        $tusigo = $general_data->getTusigo();
        $anamnesis = $general_data->getAnamnesis();
        $findings = $general_data->getFindings();
        $clinical_treatment = $general_data->getClinicalTreatment();
        $formula_number = $general_data->getFormulaNumber();
        $formula = $general_data->getFormula();
        $recomendations = $general_data->getRecomendations();
        $observations = $general_data->getObservations();
        $id_company = $general_data->getIdCompany();
        $sql = "INSERT generaldata(generaldatadate,heartrate,breathingfrequency,temperature,heartbeat,corporalcondition,linfonodulos,mucous,trc,dh,weight,mood,tusigo,anamnesis,findings,clinicaltreatment,formulanumber,formula,recomendations,observations,idcompany) "
                . "VALUES($date,$heart_rate,$breathing_frequency,$temperature,$heart_beat,$corporal_condition,$linfonodulos,$mucous,$trc,$dh,$weight,$mood,$tusigo,$anamnesis,$findings,$clinical_treatment,$formula_number,$formula,$recomendations,$observations,$id_company)";
        return $this->conn->query($sql);
    }

    public function updateObject($general_data) {
        $date = $general_data->getDate();
        $heart_rate = $general_data->getHeartRate();
        $breathing_frequency = $general_data->getBreathingFrequency();
        $temperature = $general_data->getTemperature();
        $heart_beat = $general_data->getHeartBeat();
        $corporal_condition = $general_data->getCorporalCondition();
        $linfonodulos = $general_data->getLinfonodulos();
        $mucous = $general_data->getMucous();
        $trc = $general_data->getTrc();
        $dh = $general_data->getDh();
        $weight = $general_data->getWeight();
        $mood = $general_data->getMood();
        $tusigo = $general_data->getTusigo();
        $anamnesis = $general_data->getAnamnesis();
        $findings = $general_data->getFindings();
        $clinical_treatment = $general_data->getClinicalTreatment();
        $formula_number = $general_data->getFormulaNumber();
        $formula = $general_data->getFormula();
        $recomendations = $general_data->getRecomendations();
        $observations = $general_data->getObservations();
        $id = $general_data->id;
        $sql = "UPDATE generaldata "
                . "SET generaldatadate = $date,"
                . "heartrate = $heart_rate,"
                . "breathingfrequency = $breathing_frequency,"
                . "temperature = $temperature,"
                . "heartbeat = $heart_beat,"
                . "corporalcondition = $corporal_condition,"
                . "linfonodulos = $linfonodulos,"
                . "mucous = $mucous,"
                . "trc = $trc,"
                . "dh = $dh,"
                . "weight = $weight,"
                . "mood = $mood,"
                . "tusigo = $tusigo,"
                . "anamnesis = $anamnesis,"
                . "findings = $findings,"
                . "clinicaltreatment = $clinical_treatment,"
                . "formulanumber = $formula_number,"
                . "formula = $formula,"
                . "recomendations = $recomendations,"
                . "observations = $observations "
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function deleteObject($general_data) {
        $id = $general_data->id;
        $sql = "UPDATE generaldata SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function selectById($id) {
        $sql = "SELECT * FROM generaldata WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function selectByIdObject($id) {
        $sql = "SELECT * FROM generaldata WHERE id = $id";
        $results = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_array($results);
        if ($row !== NULL) {
            return new GeneralData($row["id"], $row["generaldatadate"], $row["heartrate"], $row["breathingfrequency"]
                    , $row["temperature"], $row["heartbeat"], $row["corporalcondition"], $row["linfonodulos"]
                    , $row["mucous"], $row["trc"], $row["dh"], $row["weight"], $row["mood"], $row["tusigo"]
                    , $row["anamnesis"], $row["findings"], $row["clinicaltreatment"], $row["formulanumber"]
                    , $row["formula"], $row["recomendations"], $row["observations"], $row["idcompany"]);
        }
        return NULL;
    }

    public function selectLastInsertId() {
        return mysqli_insert_id($this->conn);
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getError() {
        return $this->conn->error;
    }

}

?>