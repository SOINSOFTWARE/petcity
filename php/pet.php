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

    private function insert($name, $color, $sex, $born_date, $born_place, $photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $id_company) {
        $sql = "INSERT pet(name,color,sex,borndate,bornplace,photo,history,idreproduction,idpettype,idbreed,idowner,idcompany) "
                . "VALUES($name,$color,$sex,$born_date,$born_place,$photo,$history,$id_reproduction,$id_pet_type,$id_breed,$id_owner,$id_company)";
        return $this->conn->query($sql);
    }

    private function update($id, $name, $color, $sex, $born_date, $born_place, $photo, $history, $id_reproduction, $id_pet_type, $id_breed) {
        $sql = "UPDATE pet "
                . "SET name = $name,"
                . "color = $color,"
                . "sex = $sex,"
                . "borndate = $born_date,"
                . "bornplace = $born_place,"
                . "photo = $photo,"
                . "history = $history,"
                . "idreproduction = $id_reproduction,"
                . "idpettype = $id_pet_type,"
                . "idbreed = $id_breed"
                . " WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function insertObject($pet_data) {
        $name = $pet_data->getName();
        $color = $pet_data->getColor();
        $sex = $pet_data->getSex();
        $born_date = $pet_data->getBornDate();
        $born_place = $pet_data->getBornPlace();
        $photo = $pet_data->getPhoto();
        $history = $pet_data->getHistory();
        $id_reproduction = $pet_data->getIdReproduction();
        $id_pet_type = $pet_data->getIdPetType();
        $id_breed = $pet_data->getIdBreed();
        $id_owner = $pet_data->getIdOwner();
        $id_company = $pet_data->getIdCompany();
        return $this->insert($name, $color, $sex, $born_date, $born_place, $photo, $history, $id_reproduction, $id_pet_type, $id_breed, $id_owner, $id_company);
    }

    public function updateObject($pet_data) {
        $name = $pet_data->getName();
        $color = $pet_data->getColor();
        $sex = $pet_data->getSex();
        $born_date = $pet_data->getBornDate();
        $born_place = $pet_data->getBornPlace();
        $photo = $pet_data->getPhoto();
        $history = $pet_data->getHistory();
        $id_reproduction = $pet_data->getIdReproduction();
        $id_pet_type = $pet_data->getIdPetType();
        $id_breed = $pet_data->getIdBreed();
        $id = $pet_data->id;
        return $this->update($id, $name, $color, $sex, $born_date, $born_place, $photo, $history, $id_reproduction, $id_pet_type, $id_breed);
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
