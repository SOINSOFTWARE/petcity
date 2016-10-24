<?php
	$conexion = mysqli_connect("localhost", "root", "MySql020486");
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_select_db($conexion, "cccompus_1");
?>