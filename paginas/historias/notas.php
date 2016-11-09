<?php session_start();
include_once '../session.php';
include_once '../../php/notification.php';
include_once '../../php/errorlog.php';

$notification = new NotificationTable();

$idpet = (isset($_POST['idpet'])) ? $_POST['idpet'] : 0;

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$idpet = $_POST['idpet'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	$notificationdate = $_POST['notificationdate'];

	$external = $notificationdate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$notificationdateToSQL = $dateobj -> format("Y-m-d");

	if (intval($id) === 0) {
		$saved = $notification -> insert($title, $message, $notificationdateToSQL, $idpet);
	} else {
		$saved = $notification -> update($id, $title, $message, $notificationdateToSQL);
	}
	if ($saved === FALSE) {
		$errorLog = new ErrorLogTable();
		$errorLog -> insert($notification -> getError());
	} else {
		$id = $notification -> selectLastInsertId();
	}
}
if (isset($_POST['view'])) {
	$id = $_POST['idnotification'];
	$results = $notification -> selectById($id);
	if ($rows = mysqli_fetch_array($results)) {
		$external = $rows['notificationdate'];
		$format = "Y-m-d h:i:s";
		$dateobj = DateTime::createFromFormat($format, $external);
		$notificationdate = $dateobj -> format("d/m/Y");
		$idpet = $rows['idpet'];
		$title = $rows['title'];
		$message = $rows['message'];
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Notas por mascota</title>
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
					<h1> Notas por mascota </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Notas por mascota
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
						<form action="notas.php" method="post" role="form" onsubmit="return validate()">
							<div class="col-xs-12">
								<div class="box">
									<?php
									if (isset($saved)) {
										if ($saved) {
											echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La nota ha sido guardada exitosamente.
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
										<h3 class="box-title">Nota</h3>
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
												<div class="form-group">
													<label for="title">T&iacute;tulo</label>
													<input type="text" class="form-control" id="title" name="title" placeholder="T&iacute;tulo" maxlength="60" value="<?php
													if (isset($title)) {
														echo $title;
													}
													?>" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-4">
												<div class="form-group">
													<label for="name">Mensaje</label>
													<br/>
													<textarea class="form-control" id="message" name="message" rows="3" maxlength="400" placeholder="Mensaje" required><?php
													if (isset($message)) {
														echo $message;
													}
													?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-2">
												<div id="divnotificationdate" class="form-group">
													<label for="consultationdate">Fecha</label>
													<input type="text" class="form-control" id="notificationdate" name="notificationdate" placeholder="Fecha de la notificaci&oacute;n" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
													if (isset($notificationdate)) {
														echo $notificationdate;
													}
													?>" required data-mask>
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
		<div id="notificationdate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de la notificaci&oacute;n no es valida.
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
				if (!validateNotificationDate()) {
					$("#divnotificationdate").addClass("has-error");
					showDivDialog($("#notificationdate-dialog"));
					return false;
				} else {
					$("#divnotificationdate").removeClass("has-error");
				}
			}

			function validateNotificationDate() {
				var notificationdate = $.trim($('#notificationdate').val());
				var array = notificationdate.split("/");
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