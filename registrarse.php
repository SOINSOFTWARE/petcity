<?php session_start();
include_once 'php/user.php';
include_once 'php/company.php';
include_once 'php/errorlog.php';

if (isset($_POST['register'])) {
	$nit = $_POST['nit'];
	$companyName = $_POST['companyname'];
	$document = $_POST['document'];
	$name = $_POST['name'];
	$lastName = $_POST['lastname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$document = str_replace("_", "", $document);

	$company = new CompanyTable();
	$user = new UserTable();

	$isValidNit = ($company -> selectId($nit) == 0);
	$isValidCC = ($user -> selectIdByDocument($document) == 0);
	$isValidEmail = ($user -> selectIdByEmail($email) == 0);

	if ($isValidNit && $isValidCC && $isValidEmail) {
		$companySaved = $company -> insert($nit, $companyName);
		if ($companySaved === TRUE) {
			$idCompany = $company -> selectId($nit);
			if ($idCompany > 0) {
				$userSaved = $user -> insert($document, $name, $lastName, $phone, $email, $password, $idCompany);
				if ($userSaved === TRUE) {
					$delivered = @$user -> sendMail($email, $nit, $companyName, $document, $name . " " . $lastName);
				} else {
					$errorLog = new ErrorLogTable();
					$errorLog -> insert($user -> getError());
				}
			} else {
				$companySaved = false;
			}
		} else {
			$errorLog = new ErrorLogTable();
			$errorLog -> insert($company -> getError());
		}
	}
}
?>
<!DOCTYPE html>
<html class="bg-black">
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Registrarse</title>
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
		if (isset($companySaved) && isset($userSaved) && $companySaved && $userSaved) {
			echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Registro completado!</b> Su registro fue completado con &eacute;xito!, a partir de ahora puede usar Pet City gratis durante 30 <a href="login.php">Inicie sesi&oacute;n</a>.
</div>';
		}
		if (isset($companySaved) && !$companySaved) {
			echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos de la veterinaria, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
		}
		if (isset($userSaved) && !$userSaved) {
			echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos del usuario, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
		}
		if (isset($isValidNit) && !$isValidNit) {
			echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> El NIT ' . $nit . ' ya ha sido registrado.
</div>';
		}
		if (isset($isValidCC) && !$isValidCC) {
			echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> El n&uacute;mero de documento ' . $document . ' ya ha sido registrado.
</div>';
		}
		if (isset($isValidEmail) && !$isValidEmail) {
			echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> El email ' . $email . ' ya ha sido registrado.
</div>';
		}
		if (isset($delivered) && !$delivered) {
			echo '<div class="alert alert-warning alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Advertencia!</b> No fue posible enviar el correo de confirmaci&oacute;n, un asesor de Soin Software se comunicar&aacute; con usted en breve.
</div>';
		}
		?>
		<div class="form-box" id="new-user-box">
			<div class="header">
				Nuevo usuario
			</div>
			<form action="registrarse.php" method="post" onsubmit="return validate()">
				<div class="body bg-gray">
					<div class="form-group">
						<label for="nit">NIT(Incluya el d&iacute;gito de verificaci&oacute;n)</label>
						<input type="text" class="form-control" id="nit" name="nit" placeholder="99999999-9" value="<?php
						if (isset($nit)) {
							echo $nit;
						}
						?>" required>
					</div>
					<div class="form-group">
						<label for="companyname">Nombre de la veterinaria</label>
						<input type="text" class="form-control" id="companyname" name="companyname" placeholder="Nombre inscrito en la C&aacute;mara de Comercio" maxlength="100" value="<?php
						if (isset($companyName)) {
							echo $companyName;
						}
						?>" required>
					</div>
					<div class="form-group">
						<label for="document">N&uacute;mero de cedula</label>
						<input type="text" class="form-control" id="document" name="document" placeholder="N&uacute;mero de documento" data-inputmask='"mask": "9999999999"' value="<?php
						if (isset($document)) {
							echo $document;
						}
						?>" required data-mask>
					</div>
					<div class="form-group">
						<label for="name">Nombre(s)</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nombre(s)" maxlength="50" value="<?php
						if (isset($name)) {
							echo $name;
						}
						?>" required>
					</div>
					<div class="form-group">
						<label for="lastname">Apellido(s)</label>
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido(s)" maxlength="50" value="<?php
						if (isset($lastName)) {
							echo $lastName;
						}
						?>" required>
					</div>
					<div class="form-group">
						<label for="phone">N&uacute;mero celular</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Celular" data-inputmask='"mask": "9999999999"' value="<?php
						if (isset($phone)) {
							echo $phone;
						}
						?>" required data-mask>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@email.com" maxlength="150" value="<?php
						if (isset($email)) {
							echo $email;
						}
						?>" required>
					</div>
					<div class="form-group">
						<label for="password">Contrase&ntilde;a</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Contrase&ntilde;a" maxlength="30" value="<?php
						if (isset($password)) {
							echo $password;
						}
						?>" required/>
					</div>
					<div class="form-group">
						<label for="repassword">Repetir contrase&ntilde;a</label>
						<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Repetir contrase&ntilde;a" maxlength="30" value="<?php
						if (isset($password)) {
							echo $password;
						}
						?>" required/>
					</div>
				</div>
				<div class="footer">
					<button id="register" name="register" type="submit" class="btn bg-olive btn-block">
						Registrarse
					</button>
				</div>
			</form>
		</div>
		<div id="nit-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El NIT de la empresa no es valido.
			</p>
		</div>
		<div id="company-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El nombre de la veterinaria no es valido.
			</p>
		</div>
		<div id="document-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El n&uacute;mero de cedula no es valido.
			</p>
		</div>
		<div id="name-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El nombre del usuario no es valido.
			</p>
		</div>
		<div id="lastname-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El apellido del usuario no es valido.
			</p>
		</div>
		<div id="phone-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El n&uacute;mero de celular no es valido.
			</p>
		</div>
		<div id="email-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El email no es valido.
			</p>
		</div>
		<div id="min-password-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>El tama&ntilde;o minimo de la contrase&ntilde;a es de 4 caracteres.
			</p>
		</div>
		<div id="password-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La contrase&ntilde;as no coinciden.
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
				if (!validateCompanyName()) {
					showDivDialog($("#company-dialog"));
					return false;
				}
				if (!validateDocumentNumber()) {
					showDivDialog($("#document-dialog"));
					return false;
				}
				if (!validateName()) {
					showDivDialog($("#name-dialog"));
					return false;
				}
				if (!validateLastName()) {
					showDivDialog($("#lastname-dialog"));
					return false;
				}
				if (!validatePhone()) {
					showDivDialog($("#phone-dialog"));
					return false;
				}
				if (!validateEmail()) {
					showDivDialog($("#email-dialog"));
					return false;
				}
				if (!validateMinPassword()) {
					showDivDialog($("#min-password-dialog"));
					return false;
				}
				if (!validatePassword()) {
					showDivDialog($("#password-dialog"));
					return false;
				}
			}

			function validateNIT() {
				var nitStr = $.trim($('#nit').val());
				var arrayNit = nitStr.split("-");
				var nit = parseInt(arrayNit[0].split('_').join(''));
				return nit > 10000000;
			}

			function validateCompanyName(val) {
				return validateStringLength($("#companyname").val());
			}

			function validateDocumentNumber() {
				var cc = $.trim($('#document').val());
				cc = cc.split('_').join('');
				var arrayCC = cc.split("");
				return arrayCC.length > 1 && parseInt(cc) > 10000000;
			}

			function validateName() {
				return validateStringLength($("#name").val());
			}

			function validateLastName() {
				return validateStringLength($("#lastname").val());
			}

			function validateStringLength(val) {
				var name = $.trim(val);
				var arrayName = name.split("");
				return arrayName.length > 2;
			}

			function validatePhone() {
				var phone = $.trim($('#phone').val());
				phone = phone.split('_').join('');
				var arrayPhone = phone.split("");
				return arrayPhone.length > 1 && parseInt(phone) > 3000000000;
			}

			function validateEmail() {
				var email = $.trim($("#email").val());
				var arrayEmail = email.split("@");
				if (arrayEmail.length > 1) {
					var arrayName = arrayEmail[0].split("");
					if (arrayName.length > 2) {
						var arrayHost = arrayEmail[1].split(".");
						if (arrayHost.length > 1) {
							var arrayCompanyHost = arrayHost[0].split("");
							if (arrayCompanyHost.length > 2) {
								var arrayFinal = arrayHost[1].split("");
								if (arrayFinal.length > 1) {
									return true;
								} else {
									return false;
								}
							} else {
								return false;
							}
						} else {
							return false;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			}

			function validateMinPassword() {
				var pass = $.trim($('#password').val());
				var arrayPass = pass.split("");
				return arrayPass.length > 3;
			}

			function validatePassword() {
				return ($('#password').val() == $('#repassword').val());
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