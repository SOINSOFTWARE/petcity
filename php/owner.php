<?php

include_once 'connection.php';

class OwnerTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insertObject($owner_data) {
        $document = $owner_data->getDocument();
        $name = $owner_data->getName();
        $last_name = $owner_data->getLastName();
        $email = $owner_data->getEmail();
        $address = $owner_data->getAddress();
        $phone1 = $owner_data->getPhone();
        $phone2 = $owner_data->getPhone2();
        $id_company = $owner_data->getIdCompany();
        $sql = "INSERT owner(document,name,lastname,email,address,phone,phone2,idcompany) "
                . "VALUES($document,$name,$last_name,$email,$address,$phone1,$phone2,$id_company)";
        return $this->conn->query($sql);
    }

    public function updateObject($owner_data) {
        $document = $owner_data->getDocument();
        $name = $owner_data->getName();
        $last_name = $owner_data->getLastName();
        $email = $owner_data->getEmail();
        $address = $owner_data->getAddress();
        $phone1 = $owner_data->getPhone();
        $phone2 = $owner_data->getPhone2();
        $id = $owner_data->id;
        $sql = "UPDATE owner "
                . "SET document = $document,"
                . "name = $name,"
                . "lastname = $last_name,"
                . "email = $email,"
                . "address = $address,"
                . "phone = $phone1,"
                . "phone2 = $phone2"
                . " WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE owner SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function select($idcompany) {
        $sql = "SELECT * FROM owner WHERE (idcompany IS NULL OR idcompany = $idcompany) AND enabled = 1 ORDER BY name ASC";
        return mysqli_query($this->conn, $sql);
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
