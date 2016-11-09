<?php session_start();
include_once '../session.php';
include_once '../../php/clinichistory.php';
include_once '../../php/medicalconsultation.php';
include_once '../../php/notification.php';
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
	$deleted = $notification -> delete($idnotification);
	if ($deleted === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($notification -> getError());
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Consultas</title>
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
					<h1> Consultas cl&iacute;nicas por mascota </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Consultas cl&iacute;nicas por mascota
						</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<?php
								if (isset($deleted)) {
									if ($deleted) {
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
								<div class="box-body">
									<form action="historia.php" method="post" role="form">
										<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
										if (isset($idclinichistory)) {
											echo $idclinichistory;
										}
										?>" />
										<input type="hidden" id="idconsultation" name="idconsultation" value="0" />
										<button type="submit" id="submit" name="submit" class="btn btn-info">
											<i class="fa fa-stethoscope"></i>
										</button>
									</form>
								</div>
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
										<a href="#tab_2" data-toggle="tab">Notas</a>
									</li>
									<li class="pull-right">
										<a href="#" class="text-muted"><i class="fa fa-table"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="row">
											<div class="col-md-12">
												<div class="box box-primary">
													<div class="box-header">
														<h3 class="box-title">Consultas</h3>
													</div>
													<div class="box-body table-responsive">
														<table id="tableData" class="table table-bordered table-hover">
															<thead>
																<tr>
																	<th style="text-align:center; width: 10%">Fecha</th>
																	<th style="text-align:center; width: 25%">Motivo</th>
																	<th style="text-align:center; width: 30%">Diagn&oacute;stico</th>
																	<th style="text-align:center; width: 30%">Enfermedad</th>
																	<th style="text-align:center; width: 5%">Ver</th>
																</tr>
															</thead>
															<tbody>
																<?php $mdconsultable = new MedicalConsultationTable();
																$results = $mdconsultable -> selectByIdClinicHistory($idclinichistory);
																while ($rows = mysqli_fetch_array($results)) {
																	$external = $rows['consultationdate'];
																	$format = "Y-m-d h:i:s";
																	$dateobj = DateTime::createFromFormat($format, $external);
																	$consultationdate = $dateobj -> format("d/m/Y");
																	echo "<tr>";
																	echo '<td>' . $consultationdate . '</td>';
																	echo '<td>' . $rows["motive"] . '</td>';
																	echo '<td>' . $rows["diagnosis"] . '</td>';
																	echo '<td>' . $rows["illness"] . '</td>';
																	echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["idclinichistory"] . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $rows["id"] . '" /><button type="submit" id="history" name="history" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
																	echo "</tr>";
																}
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab_2">
										<div class="row">
											<div class="col-md-12">
												<div class="box box-primary">
													<div class="box-header">
														<h3 class="box-title">Notas</h3>
													</div>
													<div class="box-body table-responsive">
														<div class="row">
															<div class="col-xs-4">
																<form action="notas.php" method="post" role="form">
																	<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
																	if (isset($idclinichistory)) {
																		echo $idclinichistory;
																	}
																	?>" />
																	<input type="hidden" id="idpet" name="idpet" value="<?php
																	if (isset($idpet)) {
																		echo $idpet;
																	}
																	?>" />
																	<button type="submit" id="submit" name="submit" class="btn btn-primary">
																		<i class="fa fa-plus"></i>
																	</button>
																</form>
															</div>
														</div>
														<table id="tableData1" class="table table-bordered table-hover">
															<thead>
																<tr>
																	<th style="text-align:center; width: 10%">Fecha</th>
																	<th style="text-align:center; width: 30%">T&iacute;tulo</th>
																	<th style="text-align:center; width: 45%">Mensaje</th>
																	<th style="text-align:center; width: 5%">Ver</th>
																	<th style="text-align:center; width: 5%">Enviar</th>
																	<th style="text-align:center; width: 5%">Eliminar</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$results = $notification -> select($idpet);
																while ($rows = mysqli_fetch_array($results)) {
																	$external = $rows['notificationdate'];
																	$format = "Y-m-d h:i:s";
																	$dateobj = DateTime::createFromFormat($format, $external);
																	$notificationdate = $dateobj -> format("d/m/Y");
																	echo "<tr>";
																	echo '<td>' . $notificationdate . '</td>';
																	echo '<td>' . $rows["title"] . '</td>';
																	echo '<td>' . $rows["message"] . '</td>';
																	echo '<td style="text-align:center"><form action="notas.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idnotification" name="idnotification" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
																	echo '<td style="text-align:center"><form action="consultas.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idnotification" name="idnotification" value="' . $rows["id"] . '" /><button type="submit" id="send" name="send" class="btn btn-success"><i class="fa fa-envelope"></i></button></form></td>';
																	echo '<td style="text-align:center"><form action="consultas.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idnotification" name="idnotification" value="' . $rows["id"] . '" /><button type="submit" id="deletenote" name="deletenote" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
																	echo "</tr>";
																}
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
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