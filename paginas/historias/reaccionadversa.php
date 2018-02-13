<?php session_start();
include_once '../session.php';
include_once '../../php/adversereactions.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';

$idpet = (isset($_POST['idpet'])) ? $_POST['idpet'] : 0;
$adversereactionstable = new AdverseReactionsTable();

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$idpet = $_POST['idpet'];
	$adversereactiondate = $_POST['adversereactiondate'];
	$type = $_POST['type'];
	$allergen = $_POST['allergen'];
	$presentation = $_POST['presentation'];
	$comercialname = $_POST['comercialname'];
	$dose = $_POST['dose'];
	$administration = $_POST['administration'];
	$clinicalsign = $_POST['clinicalsign'];

	$external = $adversereactiondate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$adversereactiondateToSQL = $dateobj -> format("Y-m-d");

	if (intval($id) === 0) {
		$saved = $adversereactionstable -> insert($adversereactiondateToSQL, $type, $allergen, $presentation, $comercialname, $dose, $administration, $clinicalsign, $idpet);
		if ($saved === TRUE) {
			$id = $adversereactionstable -> selectLastInsertId();
		}
	} else {
		$saved = $adversereactionstable -> update($id, $adversereactiondateToSQL, $type, $allergen, $presentation, $comercialname, $dose, $administration, $clinicalsign);
	}
	if ($saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($adversereactionstable -> getError());
	}
}
if (isset($_POST['view'])) {
	$id = $_POST['idadversereaction'];
	$results = $adversereactionstable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$adversereactiondate = format_string_date($rows['adversereactiondate'], "d/m/Y");
		$idpet = $rows['idpet'];
		$type = $rows['type'];
		$allergen = $rows['allergen'];
		$presentation = $rows['presentation'];
		$comercialname = $rows['comercialname'];
		$dose = $rows['dose'];
		$administration = $rows['administration'];
		$clinicalsign = $rows['clinicalsign'];
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Reacci&oacute;n adversa - alergia</title>
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
					<h1> Reacci&oacute;n adversa - alergia </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Reacci&oacute;n adversa - alergia
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
									<form action="historia.php" method="post" role="form">
										<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $_POST['idclinichistory']; ?>" />
										<button type="submit" id="backward" name="backward" class="btn btn-success">
											<i class="fa fa-reply"></i>
										</button>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="row">
						<form action="reaccionadversa.php" method="post" role="form" onsubmit="return validate()">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La reacci&oacute;n adversa ha sido guardada exitosamente.
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
										<h3 class="box-title">Reacci&oacute;n adversa - alergia</h3>
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
										<input type="hidden" id="id" name="id" value="<?php
										if (isset($id)) {
											echo $id;
										} else {
											0;
										}
										?>">
										<input type="hidden" id="idpet" name="idpet" value="<?php
										if (isset($idpet)) {
											echo $idpet;
										}
										?>">
										<div class="row">
											<div class="col-xs-4">
												<div id="divadversereactiondate" class="form-group">
													<label for="adversereactiondate">Fecha</label>
													<input type="text" class="form-control" id="adversereactiondate" name="adversereactiondate" placeholder="Fecha de la aplicaci&oacute;n" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
													if (isset($adversereactiondate)) {
														echo $adversereactiondate;
													}
													?>" required data-mask />
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="type">Tipo de reacci&oacute;n</label>
													<input type="text" class="form-control" id="type" name="type" placeholder="Tipo de reacci&oacute;n" maxlength="100" value="<?php
													if (isset($type)) {
														echo $type;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="allergen">Al&eacute;rgeno</label>
													<input type="text" class="form-control" id="allergen" name="allergen" placeholder="Al&eacute;rgeno" maxlength="100" value="<?php
													if (isset($allergen)) {
														echo $allergen;
													}
													?>" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-3">
												<div class="form-group">
													<label for="presentation">Presentaci&oacute;n</label>
													<input type="text" class="form-control" id="presentation" name="presentation" placeholder="Presentaci&oacute;n" maxlength="100" value="<?php
													if (isset($presentation)) {
														echo $presentation;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<label for="comercialname">Nombre comercial</label>
													<input type="text" class="form-control" id="comercialname" name="comercialname" placeholder="Nombre comercial" maxlength="100" value="<?php
													if (isset($comercialname)) {
														echo $comercialname;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<label for="dose">Dosis</label>
													<input type="text" class="form-control" id="dose" name="dose" placeholder="Dosis administrada" maxlength="60" value="<?php
													if (isset($dose)) {
														echo $dose;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<label for="administration">V&iacute;a de administraci&oacute;n</label>
													<input type="text" class="form-control" id="administration" name="administration" placeholder="V&iacute;a de administraci&oacute;n" maxlength="100" value="<?php
													if (isset($administration)) {
														echo $administration;
													}
													?>" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label for="clinicalsign">Signos cl&Iacute;nicos</label>
													<textarea class="form-control" id="clinicalsign" name="clinicalsign" rows="4" maxlength="300" required><?php
													if (isset($clinicalsign)) { echo $clinicalsign;
													}
 ?></textarea>
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
		<div id="adversereactiondate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha no es valida.
			</p>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="../../js/petcity.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
		<script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("#datemask").inputmask("mm/yyyy", {
					"placeholder" : "mm/yyyy"
				});
				$("[data-mask]").inputmask();
			});

			function validate() {
				if (!validateDate()) {
					$("#divadversereactiondate").addClass("has-error");
					showDivDialog($("#adversereactiondate-dialog"));
					return false;
				} else {
					$("#divadversereactiondate").removeClass("has-error");
				}
			}

			function validateDate() {
				var drenchingdate = $.trim($('#adversereactiondate').val());
				var array = drenchingdate.split("/");
				var arrayDay = array[0].split("");
				var arrayMonth = array[1].split("");
				var arrayYear = array[2].split("");
				return arrayDay[0] !== 'd' && arrayDay[1] !== 'd' && arrayMonth[0] !== 'm' && arrayMonth[1] !== 'm' && arrayYear[0] !== 'y' && arrayYear[1] !== 'y' && arrayYear[2] !== 'y' && arrayYear[3] !== 'y';
			}

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
