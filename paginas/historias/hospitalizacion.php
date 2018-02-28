<?php session_start();
include_once '../session.php';
include_once '../../php/hospitalization.php';
include_once '../../php/hospitalizationtreatment.php';
include_once '../../php/hospitalizationreport.php';
include_once '../../php/hospitalizationcontrol.php';
include_once '../../php/hospitalizationexam.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';

$idpet = (isset($_POST['idpet'])) ? $_POST['idpet'] : 0;
$hospitalizationTable = new HospitalizationTable();

if (isset($_POST['save'])) {
	$idclinichistory = $_POST['idclinichistory'];
	$idpet = $_POST['idpet'];
	$id = $_POST['id'];
	$initialdate = $_POST['initialdate'];
	$finaldate = $_POST['finaldate'];
	$comments = $_POST['comments'];
	$recomendations = $_POST['recomendations'];
	$formulanumber = $_POST['formulanumber'];
	$formula = $_POST['formula'];
	$receivedby = $_POST['receivedby'];
	$formulanumber = str_replace("_", "0", $formulanumber);

	$finaldateToSQL = null;

	$external = $initialdate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$initialdateToSQL = $dateobj -> format("Y-m-d");

	if ($finaldate != '') {
		$external = $finaldate . ' 00:00:00';
		$dateobj = DateTime::createFromFormat($format, $external);
		$finaldateToSQL = $dateobj -> format("Y-m-d");
	}

	if (intval($id) === 0) {
		if ($finaldate != '') {
			$saved = $hospitalizationTable -> insert($initialdateToSQL, $finaldateToSQL, $comments, $recomendations, $formulanumber, $formula, $receivedby, $idpet);
		} else {
			$saved = $hospitalizationTable -> insertNonFinalDate($initialdateToSQL, $comments, $recomendations, $formulanumber, $formula, $receivedby, $idpet);
		}
		if ($saved === TRUE) {
			$id = $hospitalizationTable -> selectLastInsertId();
		}
	} else {
		if ($finaldate != '') {
			$saved = $hospitalizationTable -> update($id, $initialdateToSQL, $finaldateToSQL, $comments, $recomendations, $formulanumber, $formula, $receivedby);
		} else {
			$saved = $hospitalizationTable -> updateNonFinalDate($id, $initialdateToSQL, $comments, $recomendations, $formulanumber, $formula, $receivedby);
		}
	}

	if (isset($saved) && $saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($hospitalizationTable -> getError());
	}
}

if (isset($_POST['view']) || isset($_POST['deletetreatment']) || isset($_POST['deletereport']) || isset($_POST['deletecontrol']) || isset($_POST['deleteexam'])) {
	$id = $_POST['idhospitalization'];
	$results = $hospitalizationTable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$comments = $rows['comments'];
		$recomendations = $rows['recomendations'];
		$formulanumber = $rows['formulanumber'];
		$formula = $rows['formula'];
		$receivedby = $rows['receivedby'];
		$idpet = $rows['idpet'];
		$external = $rows['finaldate'];
		$finaldate = '';
		if ($external != '') {
			$finaldate = format_string_date($external, "d/m/Y");
		}
		$external = $rows['initialdate'];
		$initialdate = format_string_date($external, "d/m/Y");
		if ($formulanumber < 10) {
			$formulanumber = '000' . $formulanumber . '';
		} else if ($formulanumber < 100) {
			$formulanumber = '00' . $formulanumber . '';
		} else if ($formulanumber < 1000) {
			$formulanumber = '0' . $formulanumber . '';
		}
	}
}
if (isset($id) && intval($id) > 0) {
	$hosptreatmenttable = new HospitalizationTreatmentTable();
	if (isset($_POST['deletetreatment'])) {
		$idhosptreatment = $_POST['idhosptreatment'];
		$treatmentdeleted = $hosptreatmenttable -> delete($idhosptreatment);
		if ($treatmentdeleted === FALSE) {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($hosptreatmenttable -> getError());
		}
	}
	$hospreporttable = new HospitalizationReportTable();
	if (isset($_POST['deletereport'])) {
		$idhospreport = $_POST['idhospreport'];
		$reportdeleted = $hospreporttable -> delete($idhospreport);
		if ($reportdeleted === FALSE) {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($hospreporttable -> getError());
		}
	}
	$hospcontroltable = new HospitalizationControlTable();
	if (isset($_POST['deletecontrol'])) {
		$idhospcontrol = $_POST['idhospcontrol'];
		$controldeleted = $hospcontroltable -> delete($idhospcontrol);
		if ($controldeleted === FALSE) {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($hospcontroltable -> getError());
		}
	}
	$hospexamtable = new HospitalizationExamTable();
	if (isset($_POST['deleteexam'])) {
		$idhospexam = $_POST['idhospexam'];
		$examdeleted = $hospexamtable -> delete($idhospexam);
		if ($examdeleted === FALSE) {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($hospexamtable -> getError());
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Hospitalizaci&oacute;n</title>
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
					<h1> Hospitalizaci&oacute;n </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Hospitalizaci&oacute;n
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
						<div class="col-xs-12">
							<div class="box">
								<?php
								if (isset($saved)) {
									if ($saved) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La hospitalizaci&oacute;n ha sido guardada exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								if (isset($treatmentdeleted)) {
									if ($treatmentdeleted) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> El medicamento ha sido eliminado exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								if (isset($reportdeleted)) {
									if ($reportdeleted) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> El reporte ha sido eliminado exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								if (isset($controldeleted)) {
									if ($controldeleted) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> El control ha sido eliminado exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								if (isset($examdeleted)) {
									if ($examdeleted) {
										echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> El ex&aacute;men ha sido eliminado exitosamente.
</div>';
									} else {
										echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
									}
								}
								?>
								<div class="box-body">
									<div class="row">
										<form action="hospitalizacion.php" method="post" role="form" onsubmit="return validate()">
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
											<div class="col-xs-4">
												<div class="box">
													<div class="box-header">
														<h3 class="box-title">Datos de hospitalizaci&oacute;n</h3>
													</div>
													<div class="box-body">
														<button type="submit" id="save" name="save" class="btn btn-primary">
															<i class="fa fa-save"></i> Guardar
														</button>
														<br />
														<br />
														<div id="divinitialdate" class="form-group">
															<label for="initialdate">Fecha inicial</label>
															<input type="text" class="form-control" id="initialdate" name="initialdate" placeholder="Inicio de la hospitalizaci&oacute;n" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
															if (isset($initialdate)) {
																echo $initialdate;
															}
															?>" required data-mask />
														</div>
														<div id="divfinaldate" class="form-group">
															<label for="finaldate">Fecha final</label>
															<input type="text" class="form-control" id="finaldate" name="finaldate" placeholder="Fin de hospitalizaci&oacute;n" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
															if (isset($finaldate)) {
																echo $finaldate;
															}
															?>" data-mask />
														</div>
														<div class="form-group">
															<label for="comments">Comentarios</label>
															<textarea class="form-control" id="comments" name="comments" rows="4" maxlength="400"><?php
															if (isset($comments)) { echo $comments;
															}
			?></textarea>
														</div>
														<div class="form-group">
															<label for="recomendations">Recomendaciones</label>
															<textarea class="form-control" id="recomendations" name="recomendations" rows="4" maxlength="400"><?php
															if (isset($recomendations)) { echo $recomendations;
															}
			?></textarea>
														</div>
														<div class="form-group">
															<label for="formulanumber">N&uacute;mero de f&oacute;rmula</label>
															<input type="text" class="form-control" id="formulanumber" name="formulanumber" placeholder="N&uacute;mero de f&oacute;rmula" data-inputmask='"mask": "9999"' value="<?php
															if (isset($formulanumber)) {
																echo $formulanumber;
															} else {
																echo '0000';
															}
															?>" data-mask />
														</div>
														<div class="form-group">
															<label for="formula">F&oacute;rmula</label>
															<textarea class="form-control" id="formula" name="formula" rows="4" maxlength="400"><?php
															if (isset($formula)) { echo $formula;
															}
			?></textarea>
														</div>
														<div class="form-group">
															<label for="receivedby">Recibido por:</label>
															<input type="text" class="form-control" id="receivedby" name="receivedby" placeholder="A qui&eacute;n se retorn&oacute; la mascota" maxlength="100" value="<?php
															if (isset($receivedby)) {
																echo $receivedby;
															}
															?>">
														</div>
													</div>
												</div>
											</div>
										</form>
										<?php if (isset($id) && intval($id) > 0) {
										?>
										<div class="col-xs-8">
											<div class="box">
												<div class="box-header">
													<h3 class="box-title">Medicaci&oacute;n intra-hospitalaria</h3>
												</div>
												<div class="box-body table-responsive">
													<div class="row">
														<div class="col-xs-4">
															<form action="medicacion.php" method="post" role="form">
																<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
																if (isset($_POST['idclinichistory'])) {
																	echo $_POST['idclinichistory'];
																}
																?>" />
																<input type="hidden" id="idhospitalization" name="idhospitalization" value="<?php
																if (isset($id)) {
																	echo $id;
																}
																?>" />
																<button type="submit" id="submit" name="submit" class="btn btn-primary">
																	<i class="fa fa-plus"></i> Nueva
																</button>
															</form>
														</div>
													</div>
													<table id="tableData" class="table table-bordered table-hover">
														<thead>
															<tr>
																<th style="text-align:center; width: 15%">Medicamento</th>
																<th style="text-align:center; width: 15%">Posol</th>
																<th style="text-align:center; width: 15%">Dosis</th>
																<th style="text-align:center; width: 15%">Frecuencia</th>
																<th style="text-align:center; width: 15%">Administraci&oacute;n</th>
																<th style="text-align:center; width: 15%">Horario</th>
																<th style="text-align:center; width: 5%">Ver</th>
																<th style="text-align:center; width: 5%">Eliminar</th>
															</tr>
														</thead>
														<tbody>
															<?php $results = $hosptreatmenttable -> select($id);
															while ($rows = mysqli_fetch_array($results)) {
																echo "<tr>";
																echo '<td>' . $rows["drugname"] . '</td>';
																echo '<td>' . $rows["posol"] . '</td>';
																echo '<td>' . $rows["dose"] . '</td>';
																echo '<td>' . $rows["frequency"] . '</td>';
																echo '<td>' . $rows["administration"] . '</td>';
																echo '<td>' . $rows["schedule"] . '</td>';
																echo '<td style="text-align:center"><form action="medicacion.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $_POST['idclinichistory'] . '" /><input type="hidden" id="idhospitalization" name="idhospitalization" value="' . $rows["idhospitalization"] . '" /><input type="hidden" id="idhosptreatment" name="idhosptreatment" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
																echo '<td style="text-align:center"><form action="hospitalizacion.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $_POST['idclinichistory'] . '" /><input type="hidden" id="idhospitalization" name="idhospitalization" value="' . $rows["idhospitalization"] . '" /><input type="hidden" id="idhosptreatment" name="idhosptreatment" value="' . $rows["id"] . '" /><button type="submit" id="deletetreatment" name="deletetreatment" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
																echo "</tr>";
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if (isset($id) && intval($id) > 0) {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_1" data-toggle="tab">Reportes</a>
									</li>
									<li>
										<a href="#tab_2" data-toggle="tab">Controles</a>
									</li>
									<li>
										<a href="#tab_3" data-toggle="tab">Ex&aacute;menes</a>
									</li>
									<li class="pull-right">
										<a href="#" class="text-muted"><i class="fa fa-table"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<?php
									include_once 'tabhospreportlist.php';
									include_once 'tabhospcontrollist.php';
									include_once 'tabhospexamlist.php';
									?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</section>
			</aside>
		</div>
		<div id="initialdate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de inicio no es valida.
			</p>
		</div>
		<div id="finaldate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha final no es valida.
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
				if (!validateDate($('#initialdate').val())) {
					$("#divinitialdate").addClass("has-error");
					showDivDialog($("#initialdate-dialog"));
					return false;
				} else {
					$("#divinitialdate").removeClass("has-error");
				}
				if ($.trim($('#finaldate').val()) !== '' && !validateDate($('#finaldate').val())) {
					$("#divfinaldate").addClass("has-error");
					showDivDialog($("#finaldate-dialog"));
					return false;
				} else {
					$("#divfinaldate").removeClass("has-error");
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