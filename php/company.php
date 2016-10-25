<?php
	include_once 'connection.php';

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
		
		public function select() {
			$sql = "SELECT * FROM company";
			return $this->conn->query($sql);
		}
		
		public function selectId($nit) {
			$id = 0;
			$sql = "SELECT * FROM company WHERE document = '$nit'";
			$results = mysqli_query($this->conn, $sql);
			if ($rows = mysqli_fetch_array($results)) {
				$id = $rows["id"];
			}
			return $id;
		}
		
		public function getError() {
			return $this->conn->error;
		}
	}
?>