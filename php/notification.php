<?php

include_once 'connection.php';

class NotificationTable {

    private $conn = NULL;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            mysqli_select_db($this->conn, DB_NAME);
        }
    }

    public function insert($title, $message, $notificationdate, $idpet) {
        if ($this->conn != NULL) {
            $sql = "INSERT notification(title,message,notificationdate, idpet) VALUES('$title', '$message', '$notificationdate', $idpet)";
            return $this->conn->query($sql);
        } else {
            return NULL;
        }
    }

    public function update($id, $title, $message, $notificationdate) {
        if ($this->conn != NULL) {
            $sql = "UPDATE notification SET title = '$title', message = '$message', notificationdate = '$notificationdate' WHERE id = $id";
            return $this->conn->query($sql);
        } else {
            return NULL;
        }
    }

    public function delete($id) {
        if ($this->conn != NULL) {
            $sql = "UPDATE notification SET enabled = 0 WHERE id = $id";
            return $this->conn->query($sql);
        } else {
            return NULL;
        }
    }

    public function select($idpet) {
        if ($this->conn != NULL) {
            $sql = "SELECT * FROM notification WHERE idpet = $idpet AND enabled = 1 ORDER BY notificationdate";
            return mysqli_query($this->conn, $sql);
        } else {
            return NULL;
        }
    }

    public function selectById($id) {
        if ($this->conn != NULL) {
            $sql = "SELECT notification.id, title, message, notificationdate, pet.id as idpet, pet.name as petname, owner.name as ownername, owner.lastname, owner.phone2, owner.email
                FROM notification
                JOIN pet ON notification.idpet = pet.id
                JOIN owner ON pet.idowner = owner.id
                WHERE notification.id = $id";
            return mysqli_query($this->conn, $sql);
        } else {
            return NULL;
        }
    }
    
    public function selectByIdCompany($id_company, $notification_date) {
        if ($this->conn != NULL) {
            $sql = "SELECT notification.id, title, message, notificationdate, pet.id as idpet, pet.name as petname, owner.name as ownername, owner.lastname, owner.phone2, owner.email
                FROM notification
                JOIN pet ON notification.idpet = pet.id
                JOIN owner ON pet.idowner = owner.id
                WHERE notification.enabled = 1 AND pet.enabled = 1 AND pet.idcompany = $id_company AND notificationdate = '$notification_date' ORDER BY notificationdate";
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

    public function sendMail($email, $companyName, $userfullname, $petname, $title, $message, $notificationdate) {
        $to = $email . ', ' . 'carlos.rodriguez@soinsoftware.com';
        $subject = $title;
        $message = '
            <html>
                <head></head>
                <body>
                    <h1>Hola ' . $userfullname . ', est&aacute; es un recordatorio enviado por ' . $companyName . ' usando PetCity!</h1>
                    <p>' . $message . '</p>
                    <table>
                    <tr>
                        <td>Fecha:</td><td>' . $notificationdate . '</td>
                    </tr>
                    <tr>
                        <td>Mascota:</td><td>' . $petname . '</td>
                    </tr>
                    </table>
                    <h4>Pet City Soft env&iacute;a este recordatorio por petici&oacute;n de ' . $companyName . ', no responda a este correo.</h4>
                </body>
            </html>
			';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: petcity@soinsoftware.com' . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

}

?>