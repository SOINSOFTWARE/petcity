<?php

include_once 'connection.php';

class PetTable {

    private $conn = null;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function insert($name, $color, $sex, $borndate, $bornplace, $history, $idreproduction, $idpettype, $idbreed, $idowner, $idcompany) {
        $sql = "INSERT pet(name,color,sex,borndate,bornplace,history,idreproduction,idpettype,idbreed,idowner,idcompany) VALUES('$name', '$color', '$sex', '$borndate', '$bornplace', '$history', $idreproduction, $idpettype, $idbreed, $idowner, $idcompany)";
        return $this->conn->query($sql);
    }

    public function update($id, $name, $color, $sex, $borndate, $bornplace, $history, $idreproduction, $idpettype, $idbreed) {
        $sql = "UPDATE pet SET name = '$name', color = '$color', sex = '$sex', borndate = '$borndate', bornplace = '$bornplace', history = '$history', idreproduction = $idreproduction, idpettype = $idpettype, idbreed = $idbreed WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "UPDATE pet SET enabled = 0 WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function select($idcompany) {
        $sql = "SELECT pet.id, pet.name as petname, color, sex, borndate, bornplace, photo, history, idreproduction, idpettype, idbreed, idowner, document, owner.name ownername, lastname, email, address, phone, phone2 
            FROM pet 
            JOIN owner ON pet.idowner = owner.id 
            WHERE pet.idcompany = $idcompany AND pet.enabled = 1 ORDER BY petname ASC";
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

?>