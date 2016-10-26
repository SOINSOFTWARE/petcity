<?php session_start();
include_once '../session.php';
include_once '../../php/clinichistory.php';

$clinichistory = new ClinicHistoryTable();

if (isset($_POST['newvisit'])) {

	$idclinichistory = $_POST['idclinichistory'];
	$results = $clinichistory -> selectById($idclinichistory);
	if ($rows = mysqli_fetch_array($results)) {
		$idowner = $rows['idowner'];
		$document = $rows['document'];
		$ownername = $rows['ownername'];
		$lastName = $rows['lastname'];
		$owneremail = $rows['email'];
		$address = $rows['address'];
		$phone1 = $rows['phone'];
		$phone2 = $rows['phone2'];

		$idpet = $rows['idpet'];
		$petname = $rows['petname'];
		$idpettype = $rows['idpettype'];
		$pettypename = $rows['pettypename'];
		$idbreed = $rows['idbreed'];
		$petbreedname = $rows['breedname'];
		$idreproduction = $rows['idreproduction'];
		$color = $rows['color'];
		$sex = $rows['sex'];
		$bornplace = $rows['bornplace'];
		$external = $rows['borndate'];
		$format = "Y-m-d h:i:s";
		$dateobj = DateTime::createFromFormat($format, $external);
		$borndate = $dateobj -> format("m/Y");
	}
}

if (isset($_POST['basicdata'])) {
	include_once '../../php/owner.php';
	include_once '../../php/pet.php';
	include_once '../../php/errorlog.php';

	$idowner = $_POST['idowner'];
	$document = $_POST['ownerdocument'];
	$ownername = $_POST['ownername'];
	$lastName = $_POST['ownerlastname'];
	$owneremail = $_POST['owneremail'];
	$address = $_POST['owneraddress'];
	$phone1 = $_POST['ownerphone'];
	$phone2 = $_POST['ownerphone2'];

	$idpet = $_POST['idpet'];
	$petname = $_POST['petname'];
	$idpettype = $_POST['pettype'];
	$pettypename = $_POST['pettypename'];
	$idbreed = $_POST['petbreed'];
	$petbreedname = $_POST['petbreedname'];
	$idreproduction = $_POST['petreproduction'];
	$color = $_POST['petcolor'];
	$sex = $_POST['petsex'];
	$borndate = $_POST['petborndate'];
	$bornplace = $_POST['petbornplace'];

	$document = str_replace("_", "", $document);
	$phone1 = str_replace("_", "", $phone1);
	$phone2 = str_replace("_", "", $phone2);
	$external = "01/" . $borndate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$fullborndate = $dateobj -> format("Y-m-d");

	$owner = new OwnerTable();
	$pet = new PetTable();

	if ($idowner == 0) {
		$ownersaved = $owner -> insert($document, $ownername, $lastName, $owneremail, $address, $phone1, $phone2, $companyId);
	} else {
		$ownersaved = $owner -> update($idowner, $document, $ownername, $lastName, $owneremail, $address, $phone1, $phone2);
	}

	if ($ownersaved === TRUE) {
		$idowner = $owner -> selectIdByDocument($document, $companyId);
		if ($idpet == 0) {
			$petsaved = $pet -> insert($petname, $color, $sex, $fullborndate, $bornplace, $idreproduction, $idpettype, $idbreed, $idowner, $companyId);
			if ($petsaved === TRUE) {
				$idpet = $pet -> selectIdByOwner($petname, $idowner, $companyId);
				$clinichistorysaved = $clinichistory -> insert($idpet, $companyId);
				if ($clinichistorysaved === TRUE) {
					$idclinichistory = $clinichistory -> selectIdByPet($idpet, $companyId);
				} else {
					saveError($clinichistorysaved -> getError());
				}
			} else {
				saveError($pet -> getError());
			}
		} else {
			$petsaved = $pet -> update($idpet, $petname, $color, $sex, $fullborndate, $bornplace, $idreproduction, $idpettype, $idbreed);
			if ($petsaved === FALSE) {
				saveError($pet -> getError());
			}
		}
	} else {
		saveError($owner -> getError());
	}
}

function saveError($log) {
	$errorLog = new ErrorLogTable();
	$errorLog -> insert($log);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Historia cl&iacute;nica</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../../css/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="skin-blue">
		<?php
		include '../header.php';
		?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<aside class="left-side sidebar-offcanvas">
				<section class="sidebar">
					<?php
					include '../user-panel.php';
					?>
					<?php
					include 'menu.php';
					?>
				</section>
			</aside>
			<aside class="right-side">
				<section class="content-header">
					<h1> Historia cl&iacute;nica </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-dashboard"></i> Pet City</a>
						</li>
						<li>
							<a href="../../index.php">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Historia cl&iacute;nica
						</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li <?php
									if (!isset($idclinichistory)) {
										echo 'class="active"';
									}
									?>>
										<a href="#tab_1" data-toggle="tab">Datos b&aacute;sicos</a>
									</li>
									<?php
									if (isset($idclinichistory)) {
										echo '<li class="active"><a href="#tab_2" data-toggle="tab">Consulta m&eacute;dica</a></li>';
									}
									?>
									<li class="pull-right">
										<a href="#" class="text-muted"><i class="fa fa-table"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<?php
									include 'tabbasicdata.php';
									?>
									<?php
									include 'tabmedicalconsultation.php';
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</aside>
		</div>
		<?php
		include '../phpfragments/pettype_dialog.php';
		?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<script src="../../js/petcity.js" type="text/javascript"></script>
		<script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("#datemask").inputmask("mm/yyyy", {
					"placeholder" : "mm/yyyy"
				});
				$("[data-mask]").inputmask();
			});

			function showDivDialog(divDialog) {
				divDialog.dialog({
					autoOpen : false,
					width : 400,
					modal : true,
					resizable : false,
					buttons : [{
						text : "Volver",
						click : function() {
							$(this).dialog("close");
						}
					}]
				});
				divDialog.dialog("open");
			}
		</script>
	</body>
</html>