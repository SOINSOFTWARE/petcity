<?php
	if(!isset($_SESSION['petcity_login'])){ 
		header("location: login.php"); 
	}
	$userName = $_SESSION['petcity_username'];
?>