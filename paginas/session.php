<?php
	if(!isset($_SESSION['petcity_login'])){ 
		header("location: ../../login.php"); 
	}
	$companyId = $_SESSION['petcity_companyid'];
	$company = $_SESSION['petcity_company'];
	$userName = $_SESSION['petcity_username'];
	$email = $_SESSION['petcity_login'];
        $company_photo = $_SESSION['petcity_company_photo'];
        $current_clinic_history_id = $_SESSION['petcity_actualcustomid'];
?>