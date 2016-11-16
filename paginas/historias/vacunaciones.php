<?php session_start();
include_once '../session.php';
include_once '../../php/vaccine.php';
include_once '../../php/generaldata.php';
include_once '../../php/vaccineconsultation.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/vaccine_select.php';

$idpet = (isset($_POST['idpet'])) ? $_POST['idpet'] : 0;
$vaccine = 0;
$generalDataTable = new GeneralDataTable();
$vacConsultationtable = new VaccineConsultationTable();

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$idgeneraldata = $_POST['idgeneraldata'];
	$idpet = $_POST['idpet'];
	$generaldatadate = $_POST['generaldatadate'];
	$weight = $_POST['weight'];
	$corporalcondition = $_POST['corporalcondition'];
	$heartrate = $_POST['heartrate'];
	$breathingfrequency = $_POST['breathingfrequency'];
	$temperature = $_POST['temperature'];
	$heartbeat = $_POST['heartbeat'];
	$linfonodulos = $_POST['linfonodulos'];
	$mucous = $_POST['mucous'];
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

	$weight = str_replace("_", "0", $weight);
	$heartrate = str_replace("_", "0", $heartrate);
	$breathingfrequency = str_replace("_", "0", $breathingfrequency);
	$temperature = str_replace("_", "0", $temperature);
	$dh = str_replace("_", "0", $dh);
	$formulanumber = str_replace("_", "0", $formulanumber);

	$vaccineapplication = (isset($_POST['vaccineapplication'])) ? $_POST['vaccineapplication'] : FALSE;
	$applyvaccine = ($vaccineapplication || $vaccineapplication === TRUE) ? 1 : 0;
	$vaccine = $_POST['vaccine'];
	$idvaccine = ($vaccine > 0) ? $vaccine : null;
	$batch = $_POST['batch'];
	$expiration = $_POST['expiration'];

	$external = $generaldatadate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$generaldatadateToSQL = $dateobj -> format("Y-m-d");

	if (intval($id) === 0) {
		$generaldatasaved = $generalDataTable -> insert($generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $companyId);
		if ($generaldatasaved === TRUE) {
			$idgeneraldata = $generalDataTable -> selectLastInsertId();
			if ($vaccine > 0) {
				$saved = $vacConsultationtable -> insert($idgeneraldata, $applyvaccine, $idvaccine, $batch, $expiration, $idpet);
			} else {
				$saved = $vacConsultationtable -> insertNonVaccine($idgeneraldata, $applyvaccine, $idpet);
			}
			if ($saved === TRUE) {
				$id = $vacConsultationtable -> selectLastInsertId();
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	} else {
		$generaldatasaved = $generalDataTable -> update($idgeneraldata, $generaldatadateToSQL, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations);
		if ($generaldatasaved === TRUE) {
			if ($vaccine > 0) {
				$saved = $vacConsultationtable -> update($id, $applyvaccine, $idvaccine, $batch, $expiration);
			} else {
				$saved = $vacConsultationtable -> updateNonVaccine($id);
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($generalDataTable -> getError());
		}
	}

	if ($saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($vacConsultationtable -> getError());
	}
}
if (isset($_POST['view'])) {
	$id = $_POST['idvaccineconsultation'];
	$results = $vacConsultationtable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$idpet = $rows['idpet'];
		$applyvaccine = $rows['applyvaccine'];
		$vaccineapplication = ($applyvaccine || $applyvaccine == 1) ? TRUE : FALSE;
		$vaccine = $rows['idvaccine'];
		$batch = $rows['batch'];
		$expiration = $rows['expiration'];
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

			if ($weight < 10) {
				$weight = '00' . $weight . '';
			} else if ($weight < 100) {
				$weight = '0' . $weight . '';
			}
			if ($heartrate < 10) {
				$heartrate = '00' . $heartrate . '';
			} else if ($heartrate < 100) {
				$heartrate = '0' . $heartrate . '';
			}
			if ($breathingfrequency < 10) {
				$breathingfrequency = '00' . $breathingfrequency . '';
			} else if ($breathingfrequency < 100) {
				$breathingfrequency = '0' . $breathingfrequency . '';
			}
			if ($temperature < 10) {
				$temperature = '0' . $temperature . '';
			}
			if ($dh < 10) {
				$dh = '00' . $dh . '';
			} else if ($dh < 100) {
				$dh = '0' . $dh . '';
			}
			if ($formulanumber < 10) {
				$formulanumber = '000' . $formulanumber . '';
			} else if ($formulanumber < 100) {
				$formulanumber = '00' . $formulanumber . '';
			} else if ($formulanumber < 1000) {
				$formulanumber = '0' . $formulanumber . '';
			}
		}
	}
}

$vaccinetable = new VaccineTable();
$results = $vaccinetable -> select($companyId);
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Vacunaci&oacute;n por mascota</title>
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
					<h1> Vacunaci&oacute;n por mascota </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Vacunaci&oacute;n por mascota
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
									<form action="consultas.php" method="post" role="form">
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
						<form action="vacunaciones.php" method="post" role="form" onsubmit="return validate()">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($generaldatasaved) && isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La vacunaci&oacute;n ha sido guardada exitosamente.
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
										<h3 class="box-title">Vacunaci&oacute;n</h3>
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
										?>"/>
										<input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php
										if (isset($idgeneraldata)) {
											echo $idgeneraldata;
										} else {
											0;
										}
										?>">
										<input type="hidden" id="idpet" name="idpet" value="<?php
										if (isset($idpet)) {
											echo $idpet;
										}
										?>"/>
										<?php
										include_once '../phpfragments/generaldata.php';
										?>
										<div class="row">
											<div class="col-xs-4">
												<div class="checkbox">
													<label> &iquest;Apta para vacunaci&oacute;n?
														<input type="checkbox" id="vaccineapplication" name="vaccineapplication"
														<?php
														if (isset($vaccineapplication) && ($vaccineapplication || $vaccineapplication === TRUE)) {
															echo "checked";
														}
														?>
														/>
													</label>
												</div>
											</div>
										</div>
										<div id="divvaccinedata" class="row" style="display: <?php
										if (isset($vaccineapplication) && ($vaccineapplication || $vaccineapplication === TRUE)) {
											echo 'block;';
										} else {
											echo 'none;';
										}
										?>">
											<div class="col-xs-4">
												<div id="divvaccine" class="form-group">
													<label for="vaccine">Vacuna aplicada</label>
													<select id="vaccine" name="vaccine" class="form-control">
														<option value="0">Seleccione uno...</option>
														<?php createVaccineOptions($results, $vaccine); ?>
													</select>
												</div>
											</div>
											<div class="col-xs-4">
												<div id="divbatch" class="form-group">
													<label for="batch">Lote</label>
													<input type="text" class="form-control" id="batch" name="batch" placeholder="Lote" maxlength="40" value="<?php
													if (isset($batch)) {
														echo $batch;
													}
													?>">
												</div>
											</div>
											<div class="col-xs-4">
												<div id="divexpiration" class="form-group">
													<label for="expiration">Fecha de expiraci&oacute;n</label>
													<input type="text" class="form-control" id="expiration" name="expiration" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
													if (isset($expiration)) {
														echo $expiration;
													}
													?>" data-mask />
												</div>
											</div>
										</div>
										<?php
										include_once '../phpfragments/generaldatatreatment.php';
										?>
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
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de la vacunaci&oacute;n no es valida.
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
		<div id="vaccine-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione un producto de vacunaci&oacute;n.
			</p>
		</div>
		<div id="batch-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique el lote del producto de vacunaci&oacute;n.
			</p>
		</div>
		<div id="expiration-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la fecha de expiraci&oacute;n del producto de vacunaci&oacute;n.
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

			$('#vaccineapplication').on("ifChecked", function(event) {
				changeVisibility($('#divvaccinedata'), "block");
			});

			$("#vaccineapplication").on("ifUnchecked", function(event) {
				changeVisibility($('#divvaccinedata'), "none");
				$('#vaccine').val('0');
				$('#batch').val('');
				$('#expiration').val('');
			});

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
				if ($('#vaccineapplication').is(":checked")) {
					if ($.trim($('#vaccine').val()) === '0') {
						$("#divvaccine").addClass("has-error");
						showDivDialog($("#vaccine-dialog"));
						return false;
					} else {
						$("#divvaccine").removeClass("has-error");
					}
					if ($.trim($('#batch').val()) === '') {
						$("#divbatch").addClass("has-error");
						showDivDialog($("#batch-dialog"));
						return false;
					} else {
						$("#divbatch").removeClass("has-error");
					}
					if ($.trim($('#expiration').val()) === '' || !validateDate($('#expiration').val())) {
						$("#divexpiration").addClass("has-error");
						showDivDialog($("#expiration-dialog"));
						return false;
					} else {
						$("#divexpiration").removeClass("has-error");
					}
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
		</script>
	</body>
</html>