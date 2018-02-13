<?php session_start();
include_once '../session.php';
include_once '../../php/generaldata.php';
include_once '../../php/surgery.php';
include_once '../../php/surgerycontrol.php';
include_once '../../php/surgeryexam.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';

$idclinichistory = $_POST['idclinichistory'];
$generalDataTable = new GeneralDataTable();
$surgerytable = new SurgeryTable();

if (isset($_POST['savepreevaluation'])) {
	$idpreevaluation = $_POST['idpreevaluation'];
	$idgeneraldatapreevaluation = $_POST['idgeneraldata'];
	$generaldatadatepreevaluation = $_POST['generaldatadatepreevaluation'];
	$weightpreevaluation = $_POST['weight'];
	$corporalconditionpreevaluation = $_POST['corporalcondition'];
	$heartratepreevaluation = $_POST['heartrate'];
	$breathingfrequencypreevaluation = $_POST['breathingfrequency'];
	$temperaturepreevaluation = $_POST['temperature'];
	$heartbeatpreevaluation = $_POST['heartbeat'];
	$linfonodulospreevaluation = $_POST['linfonodulos'];
	$mucouspreevaluation = $_POST['mucous'];
	$trcpreevaluation = $_POST['trc'];
	$dhpreevaluation = $_POST['dh'];
	$moodpreevaluation = $_POST['mood'];
	$tusigopreevaluation = $_POST['tusigo'];
	$anamnesispreevaluation = $_POST['anamnesis'];
	$findingspreevaluation = $_POST['findings'];
	$clinicaltreatmentpreevaluation = $_POST['clinicaltreatment'];
	$formulanumberpreevaluation = $_POST['formulanumber'];
	$formulapreevaluation = $_POST['formula'];
	$recomendationspreevaluation = $_POST['recomendations'];
	$observationspreevaluation = $_POST['observations'];

	$formulanumberpreevaluation = ($formulanumberpreevaluation != '') ? $formulanumberpreevaluation : 0;

	$namepreevaluation = $_POST['name'];
	$surgeryapplicationpreevaluation = (isset($_POST['surgeryapplication'])) ? $_POST['surgeryapplication'] : FALSE;
	$havesurgerypreevaluation = ($surgeryapplicationpreevaluation || $surgeryapplicationpreevaluation === TRUE) ? 1 : 0;
	$anestheticprotocolpreevaluation = '';
	$premedicationpreevaluation = '';
	$presumptivediagnosispreevaluation = $_POST['presumptivediagnosis'];
	$differentialdiagnosispreevaluation = $_POST['differentialdiagnosis'];
	$diagnosisrecomendationspreevaluation = $_POST['diagnosisrecomendations'];
	$diagnosissamplespreevaluation = $_POST['diagnosissamples'];
	$diagnosisexamspreevaluation = $_POST['diagnosisexams'];
	$havehospitalizationpreevaluation = 0;
	$definitivediagnosispreevaluation = $_POST['definitivediagnosis'];
	$forecastpreevaluation = $_POST['forecast'];

	$external = $generaldatadatepreevaluation . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$generaldatadateToSQLpreevaluation = $dateobj -> format("Y-m-d");

	if (intval($idpreevaluation) === 0) {
		$preevaluationgeneraldatasaved = $generalDataTable -> insert($generaldatadateToSQLpreevaluation, $heartratepreevaluation, $breathingfrequencypreevaluation, $temperaturepreevaluation, $heartbeatpreevaluation, $corporalconditionpreevaluation, $linfonodulospreevaluation, $mucouspreevaluation, $trcpreevaluation, $dhpreevaluation, $weightpreevaluation, $moodpreevaluation, $tusigopreevaluation, $anamnesispreevaluation, $findingspreevaluation, $clinicaltreatmentpreevaluation, $formulanumberpreevaluation, $formulapreevaluation, $recomendationspreevaluation, $observationspreevaluation, $companyId);
		if ($preevaluationgeneraldatasaved === TRUE) {
			$idgeneraldatapreevaluation = $generalDataTable -> selectLastInsertId();
			$preevaluationsaved = $surgerytable -> insertPreEvaluation($idclinichistory, $idgeneraldatapreevaluation, $namepreevaluation, $havesurgerypreevaluation, $anestheticprotocolpreevaluation, $premedicationpreevaluation, $presumptivediagnosispreevaluation, $differentialdiagnosispreevaluation, $diagnosisrecomendationspreevaluation, $diagnosissamplespreevaluation, $diagnosisexamspreevaluation, $havehospitalizationpreevaluation, $definitivediagnosispreevaluation, $forecastpreevaluation, $companyId);
			if ($preevaluationsaved === TRUE) {
				$idpreevaluation = $surgerytable -> selectLastInsertId();
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	} else {
		$preevaluationgeneraldatasaved = $generalDataTable -> update($idgeneraldatapreevaluation, $generaldatadateToSQLpreevaluation, $heartratepreevaluation, $breathingfrequencypreevaluation, $temperaturepreevaluation, $heartbeatpreevaluation, $corporalconditionpreevaluation, $linfonodulospreevaluation, $mucouspreevaluation, $trcpreevaluation, $dhpreevaluation, $weightpreevaluation, $moodpreevaluation, $tusigopreevaluation, $anamnesispreevaluation, $findingspreevaluation, $clinicaltreatmentpreevaluation, $formulanumberpreevaluation, $formulapreevaluation, $recomendationspreevaluation, $observationspreevaluation);
		if ($preevaluationgeneraldatasaved === TRUE) {
			$preevaluationsaved = $surgerytable -> updateNonNextDate($idpreevaluation, $namepreevaluation, $havesurgerypreevaluation, $anestheticprotocolpreevaluation, $premedicationpreevaluation, $presumptivediagnosispreevaluation, $differentialdiagnosispreevaluation, $diagnosisrecomendationspreevaluation, $diagnosissamplespreevaluation, $diagnosisexamspreevaluation, $havehospitalizationpreevaluation, $definitivediagnosispreevaluation, $forecastpreevaluation);
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	}

	if (isset($preevaluationsaved) && $preevaluationsaved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($surgerytable -> getError());
	}
}

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$idpreevaluation = $_POST['idpreevaluation'];
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
	$anamnesis = $_POST['anamnesis'];
	$findings = $_POST['findings'];
	$clinicaltreatment = $_POST['clinicaltreatment'];
	$formulanumber = $_POST['formulanumber'];
	$formula = $_POST['formula'];
	$recomendations = $_POST['recomendations'];
	$observations = $_POST['observations'];

	$formulanumber = ($formulanumber != '') ? $formulanumber : 0;

	$name = $_POST['name'];
	$surgeryapplication = (isset($_POST['surgeryapplication'])) ? $_POST['surgeryapplication'] : FALSE;
	$havesurgery = ($surgeryapplication || $surgeryapplication === TRUE) ? 1 : 0;
	$anestheticprotocol = $_POST['anestheticprotocol'];
	$premedication = $_POST['premedication'];
	$presumptivediagnosis = $_POST['presumptivediagnosis'];
	$differentialdiagnosis = $_POST['differentialdiagnosis'];
	$diagnosisrecomendations = $_POST['diagnosisrecomendations'];
	$diagnosissamples = $_POST['diagnosissamples'];
	$diagnosisexams = $_POST['diagnosisexams'];
	$hospitalizationapplication = (isset($_POST['hospitalizationapplication'])) ? $_POST['hospitalizationapplication'] : FALSE;
	$havehospitalization = ($hospitalizationapplication || $hospitalizationapplication === TRUE) ? 1 : 0;
	$definitivediagnosis = $_POST['definitivediagnosis'];
	$forecast = $_POST['forecast'];
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
				$saved = $surgerytable -> insert($idclinichistory, $idgeneraldata, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast, $nextdateToSQL, $companyId, $idpreevaluation);
			} else {
				$saved = $surgerytable -> insertNonNextDate($idclinichistory, $idgeneraldata, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast, $companyId, $idpreevaluation);
			}
			if ($saved === TRUE) {
				$id = $surgerytable -> selectLastInsertId();
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	} else {
		$generaldatasaved = $generalDataTable -> update($idgeneraldata, $generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations);
		if ($generaldatasaved === TRUE) {
			if ($nextdate != '') {
				$saved = $surgerytable -> update($id, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast, $nextdateToSQL);
			} else {
				$saved = $surgerytable -> updateNonNextDate($id, $name, $havesurgery, $anestheticprotocol, $premedication, $presumptivediagnosis, $differentialdiagnosis, $diagnosisrecomendations, $diagnosissamples, $diagnosisexams, $havehospitalization, $definitivediagnosis, $forecast);
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	}

	if (isset($saved) && $saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($surgerytable -> getError());
	}
}

if (isset($_POST['view']) || isset($_POST['deletecontrol']) || isset($_POST['deleteexam']) || isset($_POST['save'])) {
	$idpreevaluation = $_POST['idpreevaluation'];
	$results = $surgerytable -> selectById($idpreevaluation);
	if ($rows = mysqli_fetch_array($results)) {
		$namepreevaluation = $rows['name'];
		$havesurgerypreevaluation = $rows['havesurgery'];
		$surgeryapplicationpreevaluation = ($havesurgerypreevaluation || $havesurgerypreevaluation == 1) ? TRUE : FALSE;
		$anestheticprotocolpreevaluation = $rows['anestheticprotocol'];
		$premedicationpreevaluation = $rows['premedication'];
		$presumptivediagnosispreevaluation = $rows['presumptivediagnosis'];
		$differentialdiagnosispreevaluation = $rows['differentialdiagnosis'];
		$diagnosisrecomendationspreevaluation = $rows['diagnosisrecomendations'];
		$diagnosissamplespreevaluation = $rows['diagnosissamples'];
		$diagnosisexamspreevaluation = $rows['diagnosisexams'];
		$havehospitalizationpreevaluation = $rows['havehospitalization'];
		$hospitalizationapplicationpreevaluation = ($havehospitalizationpreevaluation || $havehospitalizationpreevaluation == 1) ? TRUE : FALSE;
		$definitivediagnosispreevaluation = $rows['definitivediagnosis'];
		$forecastpreevaluation = $rows['forecast'];

		$idgeneraldatapreevaluation = $rows['idgeneraldata'];

		$resultsGeneralData = $generalDataTable -> selectById($idgeneraldatapreevaluation);
		if ($rowsGeneralData = mysqli_fetch_array($resultsGeneralData)) {
			$external = $rowsGeneralData['generaldatadate'];
			$generaldatadatepreevaluation = format_string_date($external, "d/m/Y");
			$weightpreevaluation = $rowsGeneralData['weight'];
			$corporalconditionpreevaluation = $rowsGeneralData['corporalcondition'];
			$heartratepreevaluation = $rowsGeneralData['heartrate'];
			$breathingfrequencypreevaluation = $rowsGeneralData['breathingfrequency'];
			$temperaturepreevaluation = $rowsGeneralData['temperature'];
			$heartbeatpreevaluation = $rowsGeneralData['heartbeat'];
			$linfonodulospreevaluation = $rowsGeneralData['linfonodulos'];
			$mucouspreevaluation = $rowsGeneralData['mucous'];
			$trcpreevaluation = $rowsGeneralData['trc'];
			$dhpreevaluation = $rowsGeneralData['dh'];
			$moodpreevaluation = $rowsGeneralData['mood'];
			$tusigopreevaluation = $rowsGeneralData['tusigo'];
			$anamnesispreevaluation = $rowsGeneralData['anamnesis'];
			$findingspreevaluation = $rowsGeneralData['findings'];
			$clinicaltreatmentpreevaluation = $rowsGeneralData['clinicaltreatment'];
			$formulanumberpreevaluation = $rowsGeneralData['formulanumber'];
			$formulapreevaluation = $rowsGeneralData['formula'];
			$recomendationspreevaluation = $rowsGeneralData['recomendations'];
			$observationspreevaluation = $rowsGeneralData['observations'];
		}
	}
}

if (isset($idpreevaluation) && intval($idpreevaluation) > 0) {
	$results = $surgerytable -> selectByIdSurgery($idpreevaluation);
	if ($rows = mysqli_fetch_array($results)) {
		$id = $rows['id'];
		$name = $rows['name'];
		$havesurgery = $rows['havesurgery'];
		$surgeryapplication = ($havesurgery || $havesurgery == 1) ? TRUE : FALSE;
		$anestheticprotocol = $rows['anestheticprotocol'];
		$premedication = $rows['premedication'];
		$presumptivediagnosis = $rows['presumptivediagnosis'];
		$differentialdiagnosis = $rows['differentialdiagnosis'];
		$diagnosisrecomendations = $rows['diagnosisrecomendations'];
		$diagnosissamples = $rows['diagnosissamples'];
		$diagnosisexams = $rows['diagnosisexams'];
		$havehospitalization = $rows['havehospitalization'];
		$hospitalizationapplication = ($havehospitalization || $havehospitalization == 1) ? TRUE : FALSE;
		$definitivediagnosis = $rows['definitivediagnosis'];
		$forecast = $rows['forecast'];
		$external = $rows['nextdate'];
		$nextdate = '';
		if ($external != '') {
			$nextdate = format_string_date($external, "d/m/Y");
		}

		$idgeneraldata = $rows['idgeneraldata'];

		$resultsGeneralData = $generalDataTable -> selectById($idgeneraldata);
		if ($rowsGeneralData = mysqli_fetch_array($resultsGeneralData)) {
			$external = $rowsGeneralData['generaldatadate'];
			$generaldatadate = format_string_date($external, "d/m/Y");
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

if (isset($id) && intval($id) > 0) {
	$surgerycontroltable = new SurgeryControlTable();
	if (isset($_POST['deletecontrol'])) {
		$idsurgerycontrol = $_POST['idsurgerycontrol'];
		$controldeleted = $surgerycontroltable -> delete($idsurgerycontrol);
		if ($controldeleted === FALSE) {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($surgerycontroltable -> getError());
		}
	}
	$surgeryexamtable = new SurgeryExamTable();
	if (isset($_POST['deleteexam'])) {
		$idsurgeryexam = $_POST['idsurgeryexam'];
		$examdeleted = $surgeryexamtable -> delete($idsurgeryexam);
		if ($examdeleted === FALSE) {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($surgeryexamtable -> getError());
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Procedimientos quir&uacute;rgicos</title>
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
					<h1> Procedimientos quir&uacute;rgicos o que conllevan anestesia </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Procedimientos quir&uacute;rgicos
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
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_1" data-toggle="tab">Valoraci&oacute;n</a>
									</li>
									<?php if (isset($idpreevaluation) && intval($idpreevaluation) > 0) {
									?>
									<li>
										<a href="#tab_2" data-toggle="tab">Procedimiento</a>
									</li>
									<?php } ?>
									<li class="pull-right">
										<a href="#" class="text-muted"><i class="fa fa-table"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<?php
									include_once 'tabpreevaluation.php';
									if (isset($idpreevaluation) && intval($idpreevaluation) > 0) {
										include_once 'tabsurgery.php';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</aside>
		</div>
		<div id="date-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha del procedimiento no es valida.
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
		<script src="../../js/petcity.js" type="text/javascript"></script>
		<script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("#datemask").inputmask("mm/yyyy", {
					"placeholder" : "mm/yyyy"
				});
				$("[data-mask]").inputmask();
			});

			function validatePreEvaluation() {
				if (!validateDate($('#generaldatadatepreevaluation').val())) {
					$("#divgeneraldatadatepreevaluation").addClass("has-error");
					showDivDialog($("#date-dialog"));
					return false;
				} else {
					$("#divgeneraldatadatepreevaluation").removeClass("has-error");
				}
			}

			function changeVisibility(input, displayVal) {
				input.css("display", displayVal);
			}

			function validate() {
				if (!validateDate($('#generaldatadate').val())) {
					$("#divgeneraldatadate").addClass("has-error");
					showDivDialog($("#date-dialog"));
					return false;
				} else {
					$("#divgeneraldatadate").removeClass("has-error");
				}
				if ($.trim($('#weight').val()) === '0' || $.trim($('#weight').val()) === '') {
					$("#divweight").addClass("has-error");
					showDivDialog($("#weight-dialog"));
					return false;
				} else {
					$("#divweight").removeClass("has-error");
				}
				if ($.trim($('#heartrate').val()) === '0' || $.trim($('#heartrate').val()) === '') {
					$("#divheartrate").addClass("has-error");
					showDivDialog($("#heartrate-dialog"));
					return false;
				} else {
					$("#divheartrate").removeClass("has-error");
				}
				if ($.trim($('#breathingfrequency').val()) === '0' || $.trim($('#breathingfrequency').val()) === '') {
					$("#divbreathingfrequency").addClass("has-error");
					showDivDialog($("#breathingfrequency-dialog"));
					return false;
				} else {
					$("#divbreathingfrequency").removeClass("has-error");
				}
				if ($.trim($('#temperature').val()) === '0' || $.trim($('#temperature').val()) === '') {
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
		</script>
	</body>
</html>
