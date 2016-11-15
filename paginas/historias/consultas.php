<?php session_start();
include_once '../session.php';
include_once '../../php/clinichistory.php';
include_once '../../php/medicalconsultation.php';
include_once '../../php/notification.php';
include_once '../../php/medicalconsultationxdrenching.php';
include_once '../../php/errorlog.php';

if (isset($_POST['idclinichistory'])) {
	$clinichistory = new ClinicHistoryTable();
	$idclinichistory = $_POST['idclinichistory'];
	$results = $clinichistory -> selectById($idclinichistory);
	if ($rows = mysqli_fetch_array($results)) {
		$idowner = $rows['idowner'];
		$document = $rows['document'];
		$ownername = $rows['ownername'];
		$lastName = $rows['lastname'];
		$phone2 = $rows['phone2'];
		$useremail = $rows['email'];
		$ownerfullname = $ownername . ' ' . $lastName;

		$idpet = $rows['idpet'];
		$petname = $rows['petname'];
		$idpettype = $rows['idpettype'];
		$pettypename = $rows['pettypename'];
		$idbreed = $rows['idbreed'];
		$petbreedname = $rows['breedname'];
	}
}
$notification = new NotificationTable();
if (isset($_POST['deletenote'])) {
	$idnotification = $_POST['idnotification'];
	$notedeleted = $notification -> delete($idnotification);
	if ($notedeleted === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($notification -> getError());
	}
}
$medxdrenchingtable = new MedicalConsultationXDrenchingTable();
if (isset($_POST['deletemeddrenching'])) {
	$idmeddrenching = $_POST['idmeddrenching'];
	$meddrenchingdeleted = $medxdrenchingtable -> delete($idmeddrenching);
	if ($meddrenchingdeleted === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($medxdrenchingtable -> getError());
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Historia por mascota</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
					<h1> Historia cl&iacute;nica por mascota </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Historia cl&iacute;nica por mascota
						</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<?php
								if (isset($notedeleted)) {
									if ($notedeleted) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> La nota ha sido eliminada exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								if (isset($meddrenchingdeleted)) {
									if ($meddrenchingdeleted) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> La desparasitaci&oacute;n ha sido eliminada exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								if (isset($_POST['send'])) {
									$results = $notification -> selectById($_POST['idnotification']);
									if ($rows = mysqli_fetch_array($results)) {
										$external = $rows['notificationdate'];
										$format = "Y-m-d h:i:s";
										$dateobj = DateTime::createFromFormat($format, $external);
										$notificationdate = $dateobj -> format("d/m/Y");
										$title = $rows['title'];
										$message = $rows['message'];
										$notification -> sendMail($useremail, $company, $ownerfullname, $petname, $title, $message, $notificationdate);
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Nota enviada!</b> La notificaci&oacute;n fue enviada al correo electr&oacute;nico del propietario.
</div>';
									}
								}
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Datos b&aacute;sicos</h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-xs-4">
											<label for="petname">Mascota</label>
											<input type="text" class="form-control" id="petname" name="petname" value="<?php
											if (isset($petname)) {
												echo $petname;
											}
											?>" disabled>
										</div>
										<div class="col-xs-4">
											<label for="pettype">Tipo</label>
											<input type="text" class="form-control" id="pettype" name="pettype" value="<?php
											if (isset($pettypename)) {
												echo $pettypename;
											}
											?>" disabled>
										</div>
										<div class="col-xs-4">
											<label for="petbreed">Raza</label>
											<input type="text" class="form-control" id="petbreed" name="petbreed" value="<?php
											if (isset($petbreedname)) {
												echo $petbreedname;
											}
											?>" disabled>
										</div>
									</div>
									<br />
									<div class="row">
										<div class="col-xs-4">
											<label for="ownerdocument">Documento propietario</label>
											<input type="text" class="form-control" id="ownerdocument" name="ownerdocument" value="<?php
											if (isset($document)) {
												echo $document;
											}
											?>" disabled>
										</div>
										<div class="col-xs-4">
											<label for="ownerfullname">Nombre propietario</label>
											<input type="text" class="form-control" id="ownerfullname" name="ownerfullname" value="<?php
											if (isset($ownername) && isset($lastName)) {
												echo $ownername . ' ' . $lastName;
											}
											?>" disabled>
										</div>
										<div class="col-xs-4">
											<label for="phone2">Celular</label>
											<input type="text" class="form-control" id="phone2" name="phone2" value="<?php
											if (isset($phone2)) {
												echo $phone2;
											}
											?>" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_1" data-toggle="tab">Consultas</a>
									</li>
									<li>
										<a href="#tab_2" data-toggle="tab">Desparasitaciones</a>
									</li>
									<li>
										<a href="#tab_3" data-toggle="tab">Notas</a>
									</li>
									<li class="pull-right">
										<a href="#" class="text-muted"><i class="fa fa-table"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<?php
									include_once 'tabmedconsultationlist.php';
									?>
									<?php
										include_once 'tabdrenchinglist.php';
									?>
									<?php
										include_once 'tabnotelist.php';
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</aside>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="../../js/petcity.js" type="text/javascript"></script>
		<script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	</body>
</html>