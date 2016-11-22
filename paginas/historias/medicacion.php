<?php session_start();
include_once '../session.php';
include_once '../../php/hospitalizationtreatment.php';
include_once '../../php/errorlog.php';

$hosptreatmenttable = new HospitalizationTreatmentTable();

if (isset($_POST['save'])) {
	$idclinichistory = $_POST['idclinichistory'];
	$idhospitalization = $_POST['idhospitalization'];
	$id = $_POST['id'];
	$drugname = $_POST['drugname'];
	$posol = $_POST['posol'];
	$dose = $_POST['dose'];
	$frequency = $_POST['frequency'];
	$administration = $_POST['administration'];
	$schedule = $_POST['schedule'];

	if (intval($id) === 0) {
		$saved = $hosptreatmenttable -> insert($idhospitalization, $drugname, $posol, $dose, $frequency, $administration, $schedule);
		if ($saved === TRUE) {
			$id = $hosptreatmenttable -> selectLastInsertId();
		}
	} else {
		$saved = $hosptreatmenttable -> update($id, $drugname, $posol, $dose, $frequency, $administration, $schedule);
	}

	if (isset($saved) && $saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($hosptreatmenttable -> getError());
	}
}

if (isset($_POST['view'])) {
	$id = $_POST['idhosptreatment'];
	$results = $hosptreatmenttable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$idhospitalization = $rows['idhospitalization'];
		$drugname = $rows['drugname'];
		$posol = $rows['posol'];
		$dose = $rows['dose'];
		$frequency = $rows['frequency'];
		$administration = $rows['administration'];
		$schedule = $rows['schedule'];
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Medicaci&oacute;n intra-hospitalaria</title>
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
					<h1> Medicaci&oacute;n intra-hospitalaria </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Medicaci&oacute;n intra-hospitalaria
						</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<?php if (isset($_POST['idclinichistory'])) {
						?>
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<form action="hospitalizacion.php" method="post" role="form">
										<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $_POST['idclinichistory']; ?>" />
										<input type="hidden" id="idhospitalization" name="idhospitalization" value="<?php echo $_POST['idhospitalization']; ?>" />
										<button type="submit" id="view" name="view" class="btn btn-success">
											<i class="fa fa-reply"></i>
										</button>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="row">
						<form action="medicacion.php" method="post" role="form">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> El medicamento ha sido guardado exitosamente.
</div>';
										} else {
											echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
										}
									}
									?>
									<div class="box-header">
										<h3 class="box-title">Medicaci&oacute;n intra-hospitalaria</h3>
									</div>
									<div class="box-body">
										<button type="submit" id="save" name="save" class="btn btn-primary">
											<i class="fa fa-save"></i>
										</button>
										<br />
										<br />
										<?php if (isset($_POST['idclinichistory'])) {
										?>
										<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $_POST['idclinichistory']; ?>" />
										<?php } ?>
										<?php if (isset($_POST['idhospitalization'])) {
										?>
										<input type="hidden" id="idhospitalization" name="idhospitalization" value="<?php echo $_POST['idhospitalization']; ?>" />
										<?php } ?>
										<input type="hidden" id="id" name="id" value="<?php
										if (isset($id)) {
											echo $id;
										} else {
											0;
										}
										?>"/>
										<div class="row">
											<div class="col-xs-4">
												<div class="form-group">
													<label for="drugname">Medicamento:</label>
													<input type="text" class="form-control" id="drugname" name="drugname" maxlength="200" value="<?php
													if (isset($drugname)) {
														echo $drugname;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="posol">Posol:</label>
													<input type="text" class="form-control" id="posol" name="posol" maxlength="60" value="<?php
													if (isset($posol)) {
														echo $posol;
													}
													?>">
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="dose">Dosis:</label>
													<input type="text" class="form-control" id="dose" name="dose" maxlength="60" value="<?php
													if (isset($dose)) {
														echo $dose;
													}
													?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-4">
												<div class="form-group">
													<label for="frequency">Frecuencia:</label>
													<input type="text" class="form-control" id="frequency" name="frequency" maxlength="60" value="<?php
													if (isset($frequency)) {
														echo $frequency;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="administration">V&iacute;a de administraci&oacute;n:</label>
													<input type="text" class="form-control" id="administration" name="administration" maxlength="100" value="<?php
													if (isset($administration)) {
														echo $administration;
													}
													?>">
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="schedule">Horario:</label>
													<input type="text" class="form-control" id="schedule" name="schedule" maxlength="200" value="<?php
													if (isset($schedule)) {
														echo $schedule;
													}
													?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</section>
			</aside>
		</div>
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
	</body>
</html>