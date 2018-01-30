<?php session_start();
include_once '../session.php';
include_once '../../php/generaldata.php';
include_once '../../php/hospitalizationreport.php';
include_once '../../php/errorlog.php';

$generalDataTable = new GeneralDataTable();
$hospreporttable = new HospitalizationReportTable();

if (isset($_POST['save'])) {
	$idclinichistory = $_POST['idclinichistory'];
	$idhospitalization = $_POST['idhospitalization'];
	$id = $_POST['id'];
	$idgeneraldata = $_POST['idgeneraldata'];
	$generaldatadate = $_POST['generaldatadate'];
	$weight = $_POST['weight'];
	$corporalcondition = $_POST['corporalcondition'];
	$heartrate = $_POST['heartrate'];
	$breathingfrequency = $_POST['breathingfrequency'];
	$temperature = $_POST['temperature'];
	$heartbeat = $_POST['heartbeat'];
	$linfonodulos = $_POST['linfonodulos'];
	$mucous = $_POST['mucous'];
	$trc = $_POST['trc'];
	$dh = $_POST['dh'];
	$mood = $_POST['mood'];
	$tusigo = $_POST['tusigo'];
	$anamnesis = '';
	$findings = '';
	$clinicaltreatment = '';
	$formulanumber = '0';
	$formula = '';
	$recomendations = '';
	$observations = '';

	$reporttime = $_POST['reporttime'];
	$evolution = $_POST['evolution'];

	$external = $generaldatadate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$generaldatadateToSQL = $dateobj -> format("Y-m-d");

	if (intval($id) === 0) {
		$generaldatasaved = $generalDataTable -> insert($generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $companyId);
		if ($generaldatasaved === TRUE) {
			$idgeneraldata = $generalDataTable -> selectLastInsertId();
			$saved = $hospreporttable -> insert($idhospitalization, $idgeneraldata, $reporttime, $evolution);
			if ($saved === TRUE) {
				$id = $hospreporttable -> selectLastInsertId();
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	} else {
		$generaldatasaved = $generalDataTable -> update($idgeneraldata, $generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations);
		if ($generaldatasaved === TRUE) {
			$saved = $hospreporttable -> update($id, $reporttime, $evolution);
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	}

	if (isset($saved) && $saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($hospreporttable -> getError());
	}
}

if (isset($_POST['view'])) {
	$id = $_POST['idhospreport'];
	$results = $hospreporttable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$reporttime = $rows['reporttime'];
		$evolution = $rows['evolution'];

		$idgeneraldata = $rows['idgeneraldata'];

		$resultsGeneralData = $generalDataTable -> selectById($idgeneraldata);
		if ($rowsGeneralData = mysqli_fetch_array($resultsGeneralData)) {
			$external = $rowsGeneralData['generaldatadate'];
			$format = "Y-m-d h:i:s";
			$dateobj = DateTime::createFromFormat($format, $external);
			$generaldatadate = $dateobj -> format("d/m/Y");
			$weight = $rowsGeneralData['weight'];
			$corporalcondition = $rowsGeneralData['corporalcondition'];
			$heartrate = $rowsGeneralData['heartrate'];
			$breathingfrequency = $rowsGeneralData['breathingfrequency'];
			$temperature = $rowsGeneralData['temperature'];
			$heartbeat = $rowsGeneralData['heartbeat'];
			$linfonodulos = $rowsGeneralData['linfonodulos'];
			$mucous = $rowsGeneralData['mucous'];
			$trc = $rowsGeneralData['trc'];
			$dh = $rowsGeneralData['dh'];
			$mood = $rowsGeneralData['mood'];
			$tusigo = $rowsGeneralData['tusigo'];
			$anamnesis = $rowsGeneralData['anamnesis'];
			$findings = $rowsGeneralData['findings'];
			$clinicaltreatment = $rowsGeneralData['clinicaltreatment'];
			$formulanumber = $rowsGeneralData['formulanumber'];
			$formula = $rowsGeneralData['formula'];
			$recomendations = $rowsGeneralData['recomendations'];
			$observations = $rowsGeneralData['observations'];
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Reporte de hospitalizaci&oacute;n</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../../css/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
					<h1> Reporte de hospitalizaci&oacute;n </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Reporte de hospitalizaci&oacute;n
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
						<form action="reportehospitalario.php" method="post" role="form" onsubmit="return validate()">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($generaldatasaved) && isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> El reporte de hospitalizaci&oacute;n ha sido guardado exitosamente.
</div>';
										} else {
											echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
										}
									} else if (isset($generaldatasaved) || isset($saved)) {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
									?>
									<div class="box-header">
										<h3 class="box-title">Reporte de hospitalizaci&oacute;n</h3>
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
										<input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php
										if (isset($idgeneraldata)) {
											echo $idgeneraldata;
										} else {
											0;
										}
										?>">
										<div class="row">
											<div class="col-xs-4">
												<div class="bootstrap-timepicker">
													<div id="divreporttime" class="form-group">
														<label>Hora del reporte:</label>
														<div class="input-group">
															<input type="text" id="reporttime" name="reporttime" class="form-control timepicker" required/>
															<div class="input-group-addon">
																<i class="fa fa-clock-o"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
										include_once '../phpfragments/generaldata.php';
										?>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label for="evolution">Evoluci&oacute;n</label>
													<textarea class="form-control" id="evolution" name="evolution" rows="4" maxlength="600" required><?php
													if (isset($evolution)) { echo $evolution;
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
		<div id="reporttime-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La hora del reporte no debe estar vacia.
			</p>
		</div>
		<div id="date-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha del reporte no es valida.
			</p>
		</div>
		<div id="weight-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique el peso de la mascota.
			</p>
		</div>
		<div id="heartrate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la frecuencia cardiaca de la mascota.
			</p>
		</div>
		<div id="breathingfrequency-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la frecuencia respiratoria de la mascota.
			</p>
		</div>
		<div id="temperature-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la temperatura de la mascota.
			</p>
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
		<script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("#datemask").inputmask("mm/yyyy", {
					"placeholder" : "mm/yyyy"
				});
				$("[data-mask]").inputmask();
				$(".timepicker").timepicker({
					showInputs : false
				});
			});

			function validate() {
				if ($.trim($('#reporttime').val()) === '') {
					$("#divreporttime").addClass("has-error");
					showDivDialog($("#reporttime-dialog"));
					return false;
				} else {
					$("#divreporttime").removeClass("has-error");
				}
				if (!validateDate($('#generaldatadate').val())) {
					$("#divgeneraldatadate").addClass("has-error");
					showDivDialog($("#date-dialog"));
					return false;
				} else {
					$("#divgeneraldatadate").removeClass("has-error");
				}
				if ($.trim($('#weight').val()) === '000.00' || $.trim($('#weight').val()) === '___.__') {
					$("#divweight").addClass("has-error");
					showDivDialog($("#weight-dialog"));
					return false;
				} else {
					$("#divweight").removeClass("has-error");
				}
				if ($.trim($('#heartrate').val()) === '000' || $.trim($('#heartrate').val()) === '___') {
					$("#divheartrate").addClass("has-error");
					showDivDialog($("#heartrate-dialog"));
					return false;
				} else {
					$("#divheartrate").removeClass("has-error");
				}
				if ($.trim($('#breathingfrequency').val()) === '000' || $.trim($('#breathingfrequency').val()) === '___') {
					$("#divbreathingfrequency").addClass("has-error");
					showDivDialog($("#breathingfrequency-dialog"));
					return false;
				} else {
					$("#divbreathingfrequency").removeClass("has-error");
				}
				if ($.trim($('#temperature').val()) === '00.00' || $.trim($('#temperature').val()) === '__.__') {
					$("#divtemperature").addClass("has-error");
					showDivDialog($("#temperature-dialog"));
					return false;
				} else {
					$("#divtemperature").removeClass("has-error");
				}
			}

			function validateDate(date) {
				var dateWithoutSpace = $.trim(date);
				var array = dateWithoutSpace.split("/");
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

			$(document).ready(function() {
				$("#weight").keydown(function(e) {
					validateDecimalInput(e);
				});
			});

			$(document).ready(function() {
				$("#heartrate").keydown(function(e) {
					validateIntegerInput(e);
				});
			});

			$(document).ready(function() {
				$("#breathingfrequency").keydown(function(e) {
					validateIntegerInput(e);
				});
			});

			$(document).ready(function() {
				$("#temperature").keydown(function(e) {
					validateDecimalInput(e);
				});
			});

			$(document).ready(function() {
				$("#trc").keydown(function(e) {
					validateIntegerInput(e);
				});
			});

			$(document).ready(function() {
				$("#dh").keydown(function(e) {
					validateIntegerInput(e);
				});
			});

			$(document).ready(function() {
				$("#formulanumber").keydown(function(e) {
					validateIntegerInput(e);
				});
			});

			function validateIntegerInput(e) {
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
					return;
				}
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			}

			function validateDecimalInput(e) {
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 188]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
					return;
				}
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			}
		</script>
	</body>
</html>
