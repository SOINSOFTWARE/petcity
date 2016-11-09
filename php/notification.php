<?php
include_once 'connection.php';

class NotificationTable {

	private $conn = null;

	function __construct() {
		$this -> conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($this -> conn, DB_NAME);
	}

	public function insert($title, $message, $notificationdate, $idpet) {
		$sql = "INSERT notification(title,message,notificationdate, idpet) VALUES('$title', '$message', '$notificationdate', $idpet)";
		return $this -> conn -> query($sql);
	}

	public function update($id, $title, $message, $notificationdate) {
		$sql = "UPDATE notification SET title = '$title', message = '$message', notificationdate = '$notificationdate' WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function delete($id) {
		$sql = "UPDATE notification SET enabled = 0 WHERE id = $id";
		return $this -> conn -> query($sql);
	}

	public function select($idpet) {
		$sql = "SELECT * FROM notification WHERE idpet = $idpet AND enabled = 1 ORDER BY notificationdate";
		return mysqli_query($this -> conn, $sql);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM notification WHERE id = $id";
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

	public function sendMail($email, $companyName, $userfullname, $petname, $title, $message, $notificationdate) {
		$to = $email . ', ' . 'crodriguez@soinsoftware.com';
		$subject = 'Recordatorio de ' . $companyName;
		$message = '
			<html>
			<head>
			  <title>Hola ' . $userfullname . ', est&aacute; es una notificaci&oacute;n usando PetCity!</title>
			</head>
			<body>
			  <p>PetCity quiere recordarle de su siguiente cita para su mascota ' . $petname . '</p>
			  <table>
			    <tr>
			      <th></th><th></th>
			    </tr>
			    <tr>
			      <td>Fecha:</td><td>' . $notificationdate . '</td>
			    </tr>
			    <tr>
			      <td>T&iacute;tulo:</td><td>' . $title . '</td>
			    </tr>
			    <tr>
			      <td>Mensaje:</td><td>' . $message . '</td>
			    </tr>
			  </table>
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