<?php

include_once 'connection.php';
include_once 'entity/externalfiles.php';

class ExternalFilesTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($external_files) {
        $id_clinic_history = $external_files->getIdClinicHistory();
        $name = $external_files->getName();
        $file_path = $external_files->getFilePath();
        $sql = "INSERT externalfiles(idclinichistory,name,filepath) "
                . "VALUES($id_clinic_history, $name, $file_path)";
        return $this->conn->query($sql);
    }

    public function update($id, $name) {            
        $sql = "UPDATE externalfiles "
                . "SET name = '$name '"               
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE externalfiles SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function selectById($id) {
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM externalfiles WHERE id = $id";
            return mysqli_query($this->conn, $sql);
        } else {
            return NULL;
        }
    }

    public function selectByClinicHistory($id_clinic_history) {
        $sql = "SELECT * FROM externalfiles WHERE idclinichistory = $id_clinic_history";
        $results = mysqli_query($this->conn, $sql);
        $externalfiles_array = NULL;
        while ($row = mysqli_fetch_array($results)) {
            if ($externalfiles_array === NULL) {
                $externalfiles_array = [];
            }
            $externalfiles_array[] = ExternalFiles($row["id"], $row["idclinichistory"], $row["name"], $row["filepath"]);
        }
        return $externalfiles_array;
    }

    public function select($id_clinic_history) {
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM externalfiles WHERE idclinichistory = $id_clinic_history AND enabled = 1";
            return mysqli_query($this->conn, $sql);
        } else {
            return NULL;
        }
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