<?php session_start();
include_once 'php/user.php';

if (isset($_POST['remember'])) {
	$nit = $_POST['nit'];
	$document = $_POST['document'];
	$document = str_replace("_", "", $document);

	$user = new UserTable();
	$password = $user -> selectPassword($nit, $document);
}
?>
<!DOCTYPE html>
<html class="bg-black">
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Olvide contrase&ntilde;a</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="css/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="bg-black">
		<br />
		<?php
		if (isset($_POST['remember'])) {
			if (!is_null($password)) {
				echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos correctos!</b> Su contrase&ntilde;a es <b>' . $password . '</b>, <a href="login.php">Inicie sesi&oacute;n</a> usando su email y contrase&ntilde;a.
</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos erroneos!</b> El NIT y n&uacute;mero de documento ingresados no son correctos, si piensa que esto es un error contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
			}
		}
		?>
		<div class="form-box" id="new-user-box">
			<div class="header">
				Olvide la contrase&ntilde;a
			</div>
			<form action="olvidecontrasena.php" method="post" onsubmit="return validate()">
				<div class="body bg-gray">
					<div class="form-group">
						<label for="nit">NIT</label>
						<input type="text" class="form-control" id="nit" name="nit" placeholder="NIT" data-inputmask='"mask": "999999999-9"' value="<?php
						if (isset($nit)) {
							echo $nit;
						}
						?>" required data-mask>
					</div>
					<div class="form-group">
						<label for="document">N&uacute;mero de cedula</label>
						<input type="text" class="form-control" id="document" name="document" placeholder="N&uacute;mero de documento" data-inputmask='"mask": "9999999999"' value="<?php
						if (isset($document)) {
							echo $document;
						}
						?>" required data-mask>
					</div>
				</div>
				<div class="footer">
					<button id="remember" name="remember" type="submit" class="btn bg-olive btn-block">
						Recordar
					</button>
				</div>
			</form>
		</div>
		<div id="nit-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El NIT de la empresa no es valido.
			</p>
		</div>
		<div id="document-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El n&uacute;mero de cedula no es valido.
			</p>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("[data-mask]").inputmask();
			});

			function validate() {
				if (!validateNIT()) {
					showDivDialog($("#nit-dialog"));
					return false;
				}
				if (!validateDocumentNumber()) {
					showDivDialog($("#document-dialog"));
					return false;
				}
			}

			function validateNIT() {
				var nitStr = $.trim($('#nit').val());
				var arrayNit = nitStr.split("-");
				var nit = parseInt(arrayNit[0].split('_').join(''));
				return nit > 100000000;
			}

			function validateDocumentNumber() {
				var cc = $.trim($('#document').val());
				cc = cc.split('_').join('');
				var arrayCC = cc.split("");
				return arrayCC.length > 1 && parseInt(cc) > 10000000;
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