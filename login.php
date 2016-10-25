<?php session_start();
include_once 'php/user.php';

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$user = new UserTable();
	$inDB = $user -> selectForLogin($email, $password);
}

if (isset($_SESSION['petcity_login'])) {
	echo '<script>window.location="index.php"</script>';
}
?>
<!DOCTYPE html>
<html class="bg-black">
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Log in</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="bg-black">
		<br />
		<?php
		if (isset($_POST['login']) && $inDB === FALSE) {
			echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos erroneos!</b> Email o contrase&ntilde;a incorrectos, si piensa que esto es un error contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
		}
		?>
		<div class="form-box" id="login-box">
			<div class="header">
				Inicio de sesi&oacute;n
			</div>
			<form action="login.php" method="post">
				<div class="body bg-gray">
					<div class="form-group">
						<label for="email">Usuario</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@email.com"/>
					</div>
					<div class="form-group">
						<label for="password">Contrase&ntilde;a</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Contrase&ntilde;a"/>
					</div>
				</div>
				<div class="footer">
					<button id="login" name="login" type="submit" class="btn bg-olive btn-block">
						Ingresar
					</button>
					<p>
						<a href="olvidecontrasena.php" class="text-center">Olvide mi contrase&ntilde;a</a>
					</p>
					<p>
						<a href="registrarse.php" class="text-center">Nuevo usuario</a>
					</p>
				</div>
			</form>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
	</body>
</html>