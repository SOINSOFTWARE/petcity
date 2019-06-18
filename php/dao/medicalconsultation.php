<?php

include_once 'BasicDAO.php';
include_once '../entity/medicalconsultation.php';

class MedicalConsultationTable extends BasicDAO {

    function __construct() {
        $this->connectIfNeeded();
    }

    public function insert($medical_consultation) {
        $id_clinic_history = $medical_consultation->getIdClinicHistory();
        $id_general_data = $medical_consultation->getIdGeneralData();
        $motive = $medical_consultation->getMotive();
        $presumptive_diagnosis = $medical_consultation->getPresumptiveDiagnosis();
        $differential_diagnosis = $medical_consultation->getDifferentialDiagnosis();
        $diagnosis_recomendations = $medical_consultation->getDiagnosisRecomendations();
        $diagnosis_samples = $medical_consultation->getDiagnosisSamples();
        $diagnosis_exams = $medical_consultation->getDiagnosisExams();
        $definitive_diagnosis = $medical_consultation->getDefinitiveDiagnosis();
        $forecast = $medical_consultation->getForecast();
        $next_date = $medical_consultation->getNextDate();
        $id_company = $medical_consultation->getIdCompany();
        $sql = "INSERT medicalconsultation(idclinichistory,idgeneraldata,motive,presumptivediagnosis,differentialdiagnosis,diagnosisrecomendations,diagnosissamples,diagnosisexams,definitivediagnosis,forecast,nextdate,idcompany) 
		VALUES($id_clinic_history,$id_general_data,$motive,$presumptive_diagnosis,$differential_diagnosis,$diagnosis_recomendations,$diagnosis_samples,$diagnosis_exams,$definitive_diagnosis,$forecast,$next_date,$id_company)";
        return $this->executeSentence($sql);
    }

    public function update($medical_consultation) {
        $motive = $medical_consultation->getMotive();
        $presumptive_diagnosis = $medical_consultation->getPresumptiveDiagnosis();
        $differential_diagnosis = $medical_consultation->getDifferentialDiagnosis();
        $diagnosis_recomendations = $medical_consultation->getDiagnosisRecomendations();
        $diagnosis_samples = $medical_consultation->getDiagnosisSamples();
        $diagnosis_exams = $medical_consultation->getDiagnosisExams();
        $definitive_diagnosis = $medical_consultation->getDefinitiveDiagnosis();
        $forecast = $medical_consultation->getForecast();
        $next_date = $medical_consultation->getNextDate();
        $id = $medical_consultation->id;
        $sql = "UPDATE medicalconsultation "
                . "SET motive = $motive,"
                . "presumptivediagnosis = $presumptive_diagnosis,"
                . "differentialdiagnosis = $differential_diagnosis,"
                . "diagnosisrecomendations = $diagnosis_recomendations,"
                . "diagnosissamples = $diagnosis_samples,"
                . "diagnosisexams = $diagnosis_exams,"
                . "definitivediagnosis = $definitive_diagnosis,"
                . "forecast = $forecast,"
                . "nextdate = $next_date "
                . "WHERE id = $id";
        return $this->executeSentence($sql);
    }

    public function delete($id) {
        $sql = "UPDATE medicalconsultation SET enabled = 0 WHERE id = $id";
        return $this->executeSentence($sql);
    }

    public function select($idcompany) {
        $sql = "SELECT * FROM medicalconsultation WHERE idcompany = $idcompany AND enabled = 1 ORDER BY name ASC";
        return $this->executeSentence($sql);
    }

    public function selectById($id) {
        $sql = "SELECT * FROM medicalconsultation WHERE id = $id";
        $results = $this->executeSentence($sql);
        $row = mysqli_fetch_array($results);
        if ($row !== NULL) {
            return new MedicalConsultation($row["id"], $row["idclinichistory"], $row["idgeneraldata"], $row["motive"], $row["presumptivediagnosis"], $row["differentialdiagnosis"], $row["diagnosisrecomendations"], $row["diagnosissamples"], $row["diagnosisexams"], $row["definitivediagnosis"], $row["forecast"], $row["nextdate"], $row["idcompany"]);
        }
        return NULL;
    }

    public function selectByIdClinicHistory($idclinichistory) {
        $sql = "SELECT md.id AS idconsultation, md.*, gd.* FROM medicalconsultation md JOIN generaldata gd ON md.idgeneraldata = gd.id WHERE md.idclinichistory = $idclinichistory AND md.enabled = 1 ORDER BY gd.generaldatadate DESC";
        return $this->executeSentence($sql);
    }
}
