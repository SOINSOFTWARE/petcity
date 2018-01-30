<?php session_start();
include_once '../session.php';
include_once '../../php/generaldata.php';
include_once '../../php/hospitalizationcontrol.php';
include_once '../../php/errorlog.php';

$generalDataTable = new GeneralDataTable();
$hospcontroltable = new HospitalizationControlTable();

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
	$findings = $_POST['findings'];
	$clinicaltreatment = $_POST['clinicaltreatment'];
	$formulanumber = $_POST['formulanumber'];
	$formula = $_POST['formula'];
	$recomendations = $_POST['recomendations'];
	$observations = $_POST['observations'];

	$formulanumber = ($formulanumber != '') ? $formulanumber : 0;

	$evolution = $_POST['evolution'];
	$diagnosisrecomendations = $_POST['diagnosisrecomendations'];
	$diagnosissamples = $_POST['diagnosissamples'];
	$diagnosisexams = $_POST['diagnosisexams'];
	$nextdate = $_POST['nextdate'];
	$nextdateToSQL = null;

	$external = $generaldatadate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$generaldatadateToSQL = $dateobj -> format("Y-m-d");

	if ($nextdate != '') {
		$external = $nextdate . ' 00:00:00';
		$dateobj = DateTime::createFromFormat($format, $external);
		$nextdateToSQL = $dateobj -> format("Y-m-d");
	}

	if (intval($id) === 0) {
		$generaldatasaved = $generalDataTable -> insert($generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $companyId);
		if ($generaldatasaved === TRUE) {
			$idgeneraldata = $generalDataTable -> selectLastInsertId();
			if ($nextdate != '') {
				$saved = $hospcontroltable -> insert($idhospitalization, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdateToSQL);
			} else {
				$saved = $hospcontroltable -> insertNonNextDate($idhospitalization, $idgeneraldata, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams);
			}
			if ($saved === TRUE) {
				$id = $hospcontroltable -> selectLastInsertId();
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	} else {
		$generaldatasaved = $generalDataTable -> update($idgeneraldata, $generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations);
		if ($generaldatasaved === TRUE) {
			if ($nextdate != '') {
				$saved = $hospcontroltable -> update($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $nextdateToSQL);
			} else {
				$saved = $hospcontroltable -> updateNonNextDate($id, $evolution, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams);
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	}

	if (isset($saved) && $saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($hospcontroltable -> getError());
	}
}

if (isset($_POST['view'])) {
	$id = $_POST['idhospcontrol'];
	$results = $hospcontroltable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$evolution = $rows['evolution'];
		$diagnosisrecomendations = $rows['diagnosisrecomendations'];
		$diagnosissamples = $rows['diagnosissamples'];
		$diagnosisexams = $rows['diagnosisexams'];
		$external = $rows['nextdate'];
		$nextdate = '';
		if ($external != '') {
			$format = "Y-m-d h:i:s";
			$dateobj = DateTime::createFromFormat($format, $external);
			$nextdate = $dateobj -> format("d/m/Y");
		}

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
		<title>Pet City | Control post-hospitalizaci&oacute;n</title>
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
					<h1> Control post-hospitalizaci&oacute;n </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Control post-hospitalizaci&oacute;n
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
						<form action="controlhospitalario.php" method="post" role="form" onsubmit="return validate()">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($generaldatasaved) && isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> El control post-hospitalizaci&oacute;n ha sido guardado exitosamente.
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
										<h3 class="box-title">Control post-hospitalizaci&oacute;n</h3>
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
										<?php
										include_once '../phpfragments/generaldata.php';
										?>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label for="findings">Hallazgos</label>
													<textarea class="form-control" id="findings" name="findings" rows="5" maxlength="400" required><?php
													if (isset($findings)) { echo $findings;
													}
												?></textarea>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
													<label for="evolution">Evoluci&oacute;n</label>
													<textarea class="form-control" id="evolution" name="evolution" rows="5" maxlength="600" required><?php
													if (isset($evolution)) { echo $evolution;
													}
												?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-4">
												<div class="form-group">
													<label for="diagnosisrecomendations">Recomendaciones (Ayuda diagn&oacute;stico)</label>
													<textarea class="form-control" id="diagnosisrecomendations" name="diagnosisrecomendations" rows="4" maxlength="100"><?php
													if (isset($diagnosisrecomendations)) { echo $diagnosisrecomendations;
													}
												?></textarea>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="diagnosissamples">Muestras tomadas (Ayuda diagn&oacute;stico)</label>
													<textarea class="form-control" id="diagnosissamples" name="diagnosissamples" rows="4" maxlength="100"><?php
													if (isset($diagnosissamples)) { echo $diagnosissamples;
													}
												?></textarea>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="diagnosisexams">Examenes a practicar (Ayuda diagn&oacute;stico)</label>
													<textarea class="form-control" id="diagnosisexams" name="diagnosisexams" rows="4" maxlength="100"><?php
													if (isset($diagnosisexams)) { echo $diagnosisexams;
													}
												?></textarea>
												</div>
											</div>
										</div>
										<?php
										include_once '../phpfragments/generaldatatreatment.php';
										?>
										<div class="row">
											<div id="divnextdate" class="col-xs-4">
												<div class="form-group">
													<label for="nextdate">Pr&oacute;ximo control</label>
													<input type="text" class="form-control" id="nextdate" name="nextdate" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
													if (isset($nextdate)) {
														echo $nextdate;
													}
													?>" data-mask />
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
		<div id="date-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de la consulta no es valida.
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
		<div id="nextdate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha del pr&oacute;ximo control es incorrecta.
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
		<script type="text/javascript">
			$(function() {
				$("#datemask").inputmask("mm/yyyy", {
					"placeholder" : "mm/yyyy"
				});
				$("[data-mask]").inputmask();
			});

			function validate() {
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
				if ($.trim($('#nextdate').val()) !== '' && !validateDate($('#nextdate').val())) {
					$("#divnextdate").addClass("has-error");
					showDivDialog($("#nextdate-dialog"));
					return false;
				} else {
					$("#divnextdate").removeClass("has-error");
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
