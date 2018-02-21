<?php

include_once 'connection.php';

class UserTable {

    private $conn = NULL;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            mysqli_select_db($this->conn, DB_NAME);
        }
    }

    public function insert($document, $name, $lastName, $phone, $email, $password, $idCompany) {
        if ($this->conn != NULL) {
            $sql = "INSERT user(document,name,lastname,phone,email,password,idcompany) " . "VALUES('$document','$name','$lastName','$phone','$email','$password',$idCompany)";
            return $this->conn->query($sql);
        } else {
            return NULL;
        }
    }

    public function select() {
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM user";
            return $this->conn->query($sql);
        } else {
            return NULL;
        }
    }

    public function selectIdByDocument($document) {
        $id = 0;
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM user WHERE document = '$document'";
            $results = mysqli_query($this->conn, $sql);
            if ($rows = mysqli_fetch_array($results)) {
                $id = $rows["id"];
            }
        }
        return $id;
    }

    public function selectIdByEmail($email) {
        $id = 0;
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $results = mysqli_query($this->conn, $sql);
            if ($rows = mysqli_fetch_array($results)) {
                $id = $rows["id"];
            }
        }
        return $id;
    }

    public function selectPassword($nit, $document) {
        $password = null;
        if ($this->conn != NULL) {
            $sql = "SELECT password FROM user us JOIN company co ON us.idcompany = co.id WHERE us.document = '$document' AND co.document = '$nit'";
            $results = mysqli_query($this->conn, $sql);
            if ($rows = mysqli_fetch_array($results)) {
                $password = $rows["password"];
            }
        }
        return $password;
    }

    public function selectForLogin($email, $password) {
        $inDb = FALSE;
        if ($this->conn != NULL) {
            $sql = "SELECT co.id AS comId, co.name AS comName, us.name, us.lastname, us.email FROM user us JOIN company co ON us.idcompany = co.id WHERE us.email = '$email' AND us.password = '$password' AND co.paid = 1";
            $results = mysqli_query($this->conn, $sql);
            if ($rows = mysqli_fetch_array($results)) {
                $inDb = TRUE;
                $_SESSION['petcity_username'] = $rows['name'] . " " . $rows['lastname'];
                $_SESSION['petcity_login'] = $rows['email'];
                $_SESSION['petcity_companyid'] = $rows['comId'];
                $_SESSION['petcity_company'] = $rows['comName'];
            }
        }
        return $inDb;
    }

    public function getError() {
        return $this->conn->error;
    }

    public function sendMail($email, $nit, $companyName, $document, $fullUserName) {
        $to = $email . ', ' . 'carlos.rodriguez@soinsoftware.com';
        $subject = 'Registro en PetCity';
        $message = '
			<html>
			<head>
			  <title>Gracias por registrarte en PetCity!</title>
			</head>
			<body>
			  <p>Un asesor de Soin Software SAS se comunicar&aacute; contigo en breve</p>
			  <table>
			    <tr>
			      <th>NIT</th><th>Veterinaria</th><th>C.C</th><th>Nombre</th>
			    </tr>
			    <tr>
			      <td>' . $nit . '</td><td>' . $companyName . '</td><td>' . $document . '</td><td>' . $fullUserName . '</td>
			    </tr>
			  </table>
			</body>
			</html>
			';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: crodriguez@soinsoftware.com' . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

}

?>