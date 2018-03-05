<?php

include_once 'connection.php';
include_once 'entity/company.php';

class CompanyTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($nit, $companyName) {
        $sql = "INSERT company(document,name,paid) VALUES('$nit','$companyName',1)";
        return $this->conn->query($sql);
    }
    
    public function update($company) {
        $id = $company->getId();
        $photo = $company->getPhoto();
        if ($company->getInitialCustomId() !== NULL && $company->getInitialCustomId() != '') {
            $initial = $company->getInitialCustomId();
        } else {
            $initial = 'null';
        }
        if ($company->getActualCustomId() !== NULL && $company->getActualCustomId() != '') {
            $actual = $company->getActualCustomId();
        } else {
            $actual = 'null';
        }
        $sql = "UPDATE company SET "
                . "photo='$photo', "
                . "initialcustomid=$initial, "
                . "actualcustomid=$actual "
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }
    
    public function updateActualCustomId($id, $actual) {
        $sql = "UPDATE company SET "
                . "actualcustomid=$actual "
                . "WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function select() {
        $sql = "SELECT * FROM company";
        return $this->conn->query($sql);
    }
    
    public function selectById($id) {
        $sql = "SELECT * FROM company WHERE id = $id";
        $results = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_array($results);
        if ($row !== NULL) {
            return new Company($row["id"], $row["document"], $row["name"],
                    $row["paid"], $row["creation"], $row["enabled"],
                    $row["photo"], $row["initialcustomid"],
                    $row["actualcustomid"]);
        }
        return NULL;
    }

    public function selectId($nit) {
        $id = 0;
        $sql = "SELECT * FROM company WHERE document = '$nit'";
        $results = mysqli_query($this->conn, $sql);
        $rows = mysqli_fetch_array($results);
        if ($rows !== NULL) {
            $id = $rows["id"];
        }
        return $id;
    }

    public function getError() {
        return $this->conn->error;
    }

}
?>