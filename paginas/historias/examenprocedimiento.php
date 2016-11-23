<?php session_start();
include_once '../session.php';
include_once '../../php/surgeryexam.php';
include_once '../../php/errorlog.php';

$surgeryexamtable = new SurgeryExamTable();

if (isset($_POST['save'])) {
	$idclinichistory = $_POST['idclinichistory'];
	$idsurgery = $_POST['idsurgery'];
	$id = $_POST['id'];
	$examdate = $_POST['examdate'];
	$name = $_POST['name'];
	$results = $_POST['results'];
	$formulanumber = $_POST['formulanumber'];
	$formulanumber = str_replace("_", "0", $formulanumber);
	$formula = $_POST['formula'];

	$external = $examdate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$examdateToSQL = $dateobj -> format("Y-m-d");

	if (intval($id) === 0) {
		$targetdir = '../../exams/' . $companyId . "/" . $idsurgery . "/";
		$filepath = $targetdir . rand() . basename($_FILES["fileToUpload"]["name"]);
		if (!file_exists($targetdir)) {
			mkdir($targetdir, 0777, true);
		}
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
			$saved = $surgeryexamtable -> insert($idsurgery, $examdateToSQL, $name, $results, $filepath, $formulanumber, $formula);
			if ($saved === TRUE) {
				$id = $surgeryexamtable -> selectLastInsertId();
			}
		} else {
			$errormovingfile = TRUE;
		}
	} else {
		$saved = $surgeryexamtable -> update($id, $examdateToSQL, $name, $results, $formulanumber, $formula);
	}
	if ($saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($surgeryexamtable -> getError());
	}
}
if (isset($_POST['view'])) {
	$id = $_POST['idsurgeryexam'];
	$idclinichistory = $_POST['idclinichistory'];
	$idsurgery = $_POST['idsurgery'];
	$results = $surgeryexamtable -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$external = $rows['examdate'];
		$format = "Y-m-d h:i:s";
		$dateobj = DateTime::createFromFormat($format, $external);
		$examdate = $dateobj -> format("d/m/Y");
		$name = $rows['name'];
		$results = $rows['results'];
		$formulanumber = $rows['formulanumber'];
		$formula = $rows['formula'];
		$filepath = $rows['filepath'];

		if ($formulanumber < 10) {
			$formulanumber = '000' . $formulanumber . '';
		} else if ($formulanumber < 100) {
			$formulanumber = '00' . $formulanumber . '';
		} else if ($formulanumber < 1000) {
			$formulanumber = '0' . $formulanumber . '';
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Resultados de ex&aacute;menes</title>
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
					<h1> Resultados de ex&aacute;menes </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Resultados de ex&aacute;menes
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
									<form action="procedimientos.php" method="post" role="form">
										<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $_POST['idclinichistory']; ?>" />
										<input type="hidden" id="idsurgery" name="idsurgery" value="<?php echo $_POST['idsurgery']; ?>" />
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
						<form action="examenprocedimiento.php" method="post" role="form" onsubmit="return validate()" enctype="multipart/form-data">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> El resultado del ex&aacute;men ha sido guardado exitosamente.
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
										<h3 class="box-title">Resultados de ex&aacute;menes</h3>
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
										<?php if (isset($_POST['idsurgery'])) {
										?>
										<input type="hidden" id="idsurgery" name="idsurgery" value="<?php echo $_POST['idsurgery']; ?>" />
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
												<div id="divexamdate" class="form-group">
													<label for="examdate">Fecha</label>
													<input type="text" class="form-control" id="examdate" name="examdate" placeholder="Fecha del ex&aacute;men" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
													if (isset($examdate)) {
														echo $examdate;
													}
													?>" required data-mask />
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<label for="name">Nombre</label>
													<input type="text" class="form-control" id="name" name="name" placeholder="Nombre del ex&aacute;men" maxlength="100" value="<?php
													if (isset($name)) {
														echo $name;
													}
													?>" required>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
													<?php if (isset($id) && intval($id) > 0) {
													?>
													<label>Archivo adjunto</label><br />
													<a href="<?php echo $filepath; ?>" class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>
													<?php } else { ?>
													<label for="fileToUpload">Adjuntar archivo</label>
													<input type="file" id="fileToUpload" name="fileToUpload" onchange="validateFile()" required>
													<p class="help-block">
														Solo se permite adjuntar archivos con extensi&oacute;n pdf, png, jpg, jpeg.
													</p>
													<?php } ?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label for="results">Resultados</label>
													<textarea class="form-control" id="results" name="results" rows="8" maxlength="500" required><?php
													if (isset($results)) { echo $results;
													}
 ?></textarea>
												</div>
											</div>
											<div class="col-xs-6">
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
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha del ex&aacute;men no es valida.
			</p>
		</div>
		<div id="extension-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Solo se permite adjuntar archivos con extensi&oacute;n pdf, png, jpg, jpeg.
			</p>
		</div>
		<div id="browser-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Su navegador no soporta est&aacute; funcionalidad.
			</p>
		</div>
		<div id="one-file-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione solo un archivo
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
				if (!validateDate($('#examdate').val())) {
					$("#divexamdate").addClass("has-error");
					showDivDialog($("#date-dialog"));
					return false;
				} else {
					$("#divexamdate").removeClass("has-error");
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

			function validateFile() {
				var countFiles = document.getElementById("fileToUpload").files.length;
				if (countFiles === 1) {
					if ( typeof (FileReader) !== "undefined") {
						var imgPath = document.getElementById("fileToUpload").value;
						var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
						if (extn !== "pdf" && extn !== "png" && extn !== "jpg" && extn !== "jpeg") {
							showDivDialog($("#extension-dialog"));
							document.getElementById("fileToUpload").value = null;
							return false;
						}
					} else {
						showDivDialog($("#browser-dialog"));
					}
				} else {
					showDivDialog($("#one-file-dialog"));
				}
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