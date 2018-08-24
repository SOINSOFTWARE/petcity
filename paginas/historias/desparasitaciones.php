<?php session_start();
include_once '../session.php';
include_once '../../php/drenching.php';
include_once '../../php/medicalconsultationxdrenching.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/drenching_select.php';
include_once '../phpfragments/custom_date.php';

$idpet = (isset($_POST['idpet'])) ? $_POST['idpet'] : 0;
$drenching = 0;
$medxdrenchingtable = new MedicalConsultationXDrenchingTable();

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$idpet = $_POST['idpet'];
	$drenchingdate = $_POST['drenchingdate'];
	$weight = $_POST['weight'];
	$drenching = $_POST['drenching'];
	$doses = $_POST['doses'];
	$administration = $_POST['administration'];

	$external = $drenchingdate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$drenchingdateToSQL = $dateobj -> format("Y-m-d");

	if (intval($id) === 0) {
		$saved = $medxdrenchingtable -> insert($drenching, $drenchingdateToSQL, $weight, $doses, $administration, $idpet);
	} else {
		$saved = $medxdrenchingtable -> update($id, $drenching, $drenchingdateToSQL, $weight, $doses, $administration);
	}
	if ($saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($medxdrenchingtable -> getError());
	} else {
		$id = $medxdrenchingtable -> selectLastInsertId();
	}
}
if (isset($_POST['view'])) {
	$id = $_POST['idmeddrenching'];
	$results = $medxdrenchingtable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$external = $rows['drenchingdate'];
		$drenchingdate = format_string_date($external, "d/m/Y");
		$idpet = $rows['idpet'];
		$weight = $rows['weight'];
		$drenching = $rows['iddrenching'];
		$doses = $rows['dose'];
		$administration = $rows['administration'];
	}
}

$drenchingtable = new DrenchingTable();
$results = $drenchingtable -> select($companyId);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Desparasitaci&oacute;n por mascota</title>
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
					<h1> Desparasitaci&oacute;n por mascota </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Desparasitaci&oacute;n por mascota
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
											<i class="fa fa-reply"></i> Historia
										</button>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="row">
						<form action="desparasitaciones.php" method="post" role="form" onsubmit="return validate()">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La desparasitaci&oacute;n ha sido guardada exitosamente.
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
										<h3 class="box-title">Desparasitaci&oacute;n</h3>
									</div>
									<div class="box-body">
										<button type="submit" id="save" name="save" class="btn btn-primary">
											<i class="fa fa-save"></i> Guardar
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
												<div id="divdrenchingdate" class="form-group">
													<label for="drenchingdate">Fecha</label>
													<input type="text" class="form-control" id="drenchingdate" name="drenchingdate" placeholder="Fecha de la aplicaci&oacute;n" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
													if (isset($drenchingdate)) {
														echo $drenchingdate;
													}
													?>" required data-mask />
												</div>
											</div>
											<div class="col-xs-4">
												<div id="divweight" class="form-group">
													<label for="weight">Peso de la mascota (Kg)</label>
													<input type="text" class="form-control" id="weight" name="weight" placeholder="KG" autocomplete="off" value="<?php
													if (isset($weight)) {
														echo $weight;
													}
													?>" required data-mask />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-4">
												<div id="divdrenching" class="form-group">
													<label for="drenching">Antiparasitario</label>
													<select id="drenching" name="drenching" class="form-control">
														<option value="0">Seleccione uno...</option>
														<?php createDrenchingOptions($results, $drenching) ?>
													</select>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="doses">Dosis</label>
													<input type="text" class="form-control" id="doses" name="doses" placeholder="Dosis administrada" maxlength="60" value="<?php
													if (isset($doses)) {
														echo $doses;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-4">
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
									</div>
								</div>
							</div>
						</form>
					</div>
				</section>
			</aside>
		</div>
		<div id="drenchingdate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de la desparasitaci&oacute;n no es valida.
			</p>
		</div>
		<div id="drenching-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione un producto antiparasitario.
			</p>
		</div>
		<div id="weight-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique el peso de la mascota.
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
					$("#divdrenchingdate").addClass("has-error");
					showDivDialog($("#drenchingdate-dialog"));
					return false;
				} else {
					$("#divdrenchingdate").removeClass("has-error");
				}
				if ($.trim($('#weight').val()) === '0') {
					$("#divweight").addClass("has-error");
					showDivDialog($("#weight-dialog"));
					return false;
				} else {
					$("#divweight").removeClass("has-error");
				}
				if ($.trim($('#drenching').val()) === '0') {
					$("#divdrenching").addClass("has-error");
					showDivDialog($("#drenching-dialog"));
					return false;
				} else {
					$("#divdrenching").removeClass("has-error");
				}
			}

			function validateDate() {
				var drenchingdate = $.trim($('#drenchingdate').val());
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

			$(document).ready(function () {
                            $("#weight").keydown(function (e) {
                                validateDecimalInput(e);
                            });
                        });
		</script>
	</body>
</html>
