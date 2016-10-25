<?php
	include_once 'connection.php';

	class ErrorLogTable {
		
		private $conn = null;
		
		function __construct() {
			$this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			mysqli_select_db($this->conn, DB_NAME);
		}
		
		public function insert($log) {
			$sql = "INSERT errorlog(log) VALUES('$log')";
			return $this->conn->query($sql);
		}
	}
?>