<?php session_start();
include_once '../session.php';
include_once '../../php/clinichistory.php';
include_once '../../php/owner.php';
include_once '../../php/pet.php';
include_once '../../php/errorlog.php';

$clinichistory = new ClinicHistoryTable();

if (isset($_POST['idclinichistory'])) {

	$idclinichistory = $_POST['idclinichistory'];
	$results = $clinichistory -> selectById($idclinichistory);
	if ($rows = mysqli_fetch_array($results)) {
		$idowner = $rows['idowner'];
		$document = $rows['document'];
		$ownername = $rows['ownername'];
		$lastName = $rows['lastname'];
		$owneremail = $rows['email'];
		$address = $rows['address'];
		$phone1 = $rows['phone'];
		$phone2 = $rows['phone2'];

		$idpet = $rows['idpet'];
		$petname = $rows['petname'];
		$idpettype = $rows['idpettype'];
		$pettypename = $rows['pettypename'];
		$idbreed = $rows['idbreed'];
		$petbreedname = $rows['breedname'];
		$idreproduction = $rows['idreproduction'];
		$color = $rows['color'];
		$sex = $rows['sex'];
		$bornplace = $rows['bornplace'];
		$external = $rows['borndate'];
		$format = "Y-m-d h:i:s";
		$dateobj = DateTime::createFromFormat($format, $external);
		$borndate = $dateobj -> format("m/Y");
	}
}

if (isset($_POST['basicdata'])) {
	$idowner = $_POST['idowner'];
	$document = $_POST['ownerdocument'];
	$ownername = $_POST['ownername'];
	$lastName = $_POST['ownerlastname'];
	$owneremail = $_POST['owneremail'];
	$address = $_POST['owneraddress'];
	$phone1 = $_POST['ownerphone'];
	$phone2 = $_POST['ownerphone2'];

	$idpet = $_POST['idpet'];
	$petname = $_POST['petname'];
	$idpettype = $_POST['pettype'];
	$pettypename = $_POST['pettypename'];
	$idbreed = $_POST['petbreed'];
	$petbreedname = $_POST['petbreedname'];
	$idreproduction = $_POST['petreproduction'];
	$color = $_POST['petcolor'];
	$sex = $_POST['petsex'];
	$borndate = $_POST['petborndate'];
	$bornplace = $_POST['petbornplace'];

	$document = str_replace("_", "", $document);
	$phone1 = str_replace("_", "", $phone1);
	$phone2 = str_replace("_", "", $phone2);
	$external = "01/" . $borndate . ' 00:00:00';
	$format = "d/m/Y H:i:s";
	$dateobj = DateTime::createFromFormat($format, $external);
	$fullborndate = $dateobj -> format("Y-m-d");

	$owner = new OwnerTable();
	$pet = new PetTable();

	if ($idowner == 0) {
		$ownersaved = $owner -> insert($document, $ownername, $lastName, $owneremail, $address, $phone1, $phone2, $companyId);
	} else {
		$ownersaved = $owner -> update($idowner, $document, $ownername, $lastName, $owneremail, $address, $phone1, $phone2);
	}

	if ($ownersaved === TRUE) {
		if ($idowner == 0) {
			$idowner = $owner -> selectLastInsertId();
		}
		if ($idpet == 0) {
			$petsaved = $pet -> insert($petname, $color, $sex, $fullborndate, $bornplace, $idreproduction, $idpettype, $idbreed, $idowner, $companyId);
			if ($petsaved === TRUE) {
				$idpet = $pet -> selectLastInsertId();
				$clinichistorysaved = $clinichistory -> insert($idpet, $companyId);
				if ($clinichistorysaved === TRUE) {
					$idclinichistory = $clinichistory -> selectLastInsertId();
				} else {
					saveError($clinichistorysaved -> getError());
				}
			} else {
				saveError($pet -> getError());
			}
		} else {
			$petsaved = $pet -> update($idpet, $petname, $color, $sex, $fullborndate, $bornplace, $idreproduction, $idpettype, $idbreed);
			if ($petsaved === FALSE) {
				saveError($pet -> getError());
			}
		}
	} else {
		saveError($owner -> getError());
	}
}

function saveError($log) {
	$errorLog = new ErrorLogTable();
	$errorLog -> insert($log);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Datos b&aacute;sicos</title>
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
					<h1> Datos b&aacute;sicos </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li>
							<a href="../../">Historias cl&iacute;nicas</a>
						</li>
						<li class="active">
							Datos b&aacute;sicos
						</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<?php if (isset($idclinichistory)) {
						?>
						<div class="col-md-12">
							<div class="box">
								<div class="box-body">
									<form action="historia.php" method="post" role="form">
										<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $idclinichistory; ?>" />
										<button type="submit" id="backward" name="backward" class="btn btn-success">
											<i class="fa fa-reply"></i>
										</button>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Datos b&aacute;sicos</h3>
										</div>
										<div class="box-body">
											<?php
											if (isset($ownersaved) && isset($petsaved) && isset($clinichistorysaved) && $ownersaved && $petsaved && $clinichistorysaved) {
												echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> Los datos de la persona y la mascota han sido guardados exitosamente.
</div>';
											}
											if (isset($ownersaved) && isset($petsaved) && !isset($clinichistorysaved) && $ownersaved && $petsaved) {
												echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos actualizados!</b> Los datos de la persona y la mascota han sido actualizados exitosamente.
</div>';
											}
											if (isset($ownersaved) && !$ownersaved) {
												echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos de la persona, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
											}
											if (isset($petsaved) && !$petsaved) {
												echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos de la mascota, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
											}
											if (isset($clinichistorysaved) && !$clinichistorysaved) {
												echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos de la historia cl&iacute;nica, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
											}
											?>
											<form action="datosbasicos.php" method="post" role="form" onsubmit="return validate()">
												<div class="row">
													<div class="col-xs-12">
														<button type="submit" id="basicdata" name="basicdata" class="btn btn-primary">
															<i class="fa fa-save"></i>
														</button>
													</div>
												</div>
												<br />
												<div class="row">
													<div class="col-xs-6">
														<div class="box">
															<div class="box-header">
																<h3 class="box-title">Propietario</h3>
															</div>
															<div class="box-body">
																<div class="form-group">
																	<label for="ownerdocument">N&uacute;mero de documento</label>
																	<input type="hidden" id="idowner" name="idowner" value="<?php
																	if (isset($idowner)) {
																		echo $idowner;
																	} else {
																		echo '0';
																	}
																	?>" />
																	<input type="text" class="form-control" id="ownerdocument" name="ownerdocument" placeholder="N&uacute;mero de documento" data-inputmask='"mask": "9999999999"' value="<?php
																	if (isset($document)) {
																		echo $document;
																	}
																	?>" required data-mask />
																</div>
																<div class="form-group">
																	<label for="ownername">Nombre(s)</label>
																	<input type="text" class="form-control" id="ownername" name="ownername" placeholder="Nombre(s)" maxlength="50" value="<?php
																	if (isset($ownername)) {
																		echo $ownername;
																	}
																	?>" required />
																</div>
																<div class="form-group">
																	<label for="ownerlastname">Apellido(s)</label>
																	<input type="text" class="form-control" id="ownerlastname" name="ownerlastname" placeholder="Apellido(s)" maxlength="50" value="<?php
																	if (isset($lastName)) {
																		echo $lastName;
																	}
																	?>" required />
																</div>
																<div class="form-group">
																	<label for="owneremail">Email</label>
																	<div class="input-group">
																		<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
																		<input type="email" class="form-control" id="owneremail" name="owneremail" placeholder="ejemplo@email.com" maxlength="150" value="<?php
																		if (isset($owneremail)) {
																			echo $owneremail;
																		}
																		?>" required />
																	</div>
																</div>
																<div class="form-group">
																	<label for="owneraddress">Direcci&oacute;n</label>
																	<div class="input-group">
																		<span class="input-group-addon"><i class="fa fa-home"></i></span>
																		<input type="text" class="form-control" id="owneraddress" name="owneraddress" placeholder="Direcci&oacute;n" maxlength="100" value="<?php
																		if (isset($address)) {
																			echo $address;
																		}
																		?>" required />
																	</div>
																</div>
																<div class="form-group">
																	<label for="ownerphone2">Celular</label>
																	<div class="input-group">
																		<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
																		<input type="text" class="form-control" id="ownerphone2" name="ownerphone2" placeholder="Celular" data-inputmask='"mask": "9999999999"' value="<?php
																		if (isset($phone2)) {
																			echo $phone2;
																		}
																		?>" required data-mask />
																	</div>
																</div>
																<div class="form-group">
																	<label for="ownerphone">Tel&eacute;fono</label>
																	<div class="input-group">
																		<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																		<input type="text" class="form-control" id="ownerphone" name="ownerphone" placeholder="Tel&eacute;fono" data-inputmask='"mask": "9999999"' value="<?php
																		if (isset($phone1)) {
																			echo $phone1;
																		}
																		?>" data-mask />
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xs-6">
														<div class="box">
															<div class="box-header">
																<h3 class="box-title">Mascota</h3>
															</div>
															<div class="box-body">
																<div class="form-group">
																	<label for="petname">Nombre</label>
																	<input type="hidden" id="idpet" name="idpet" value="<?php
																	if (isset($idpet)) {
																		echo $idpet;
																	} else {
																		echo '0';
																	}
																	?>" />
																	<input type="text" class="form-control" id="petname" name="petname" placeholder="Nombre" maxlength="60" value="<?php
																	if (isset($petname)) {
																		echo $petname;
																	}
																	?>" required />
																</div>
																<div id="divpettype" class="form-group">
																	<button type="button" id="pettypebtn" name="pettypebtn" class="btn btn-warning" onclick="showPetType();">
																		<i class="fa fa-search"></i>
																	</button>
																	<label for="pettypebtn"> Buscar tipo y raza de la mascota</label>
																</div>
																<div class="form-group">
																	<label for="pettype">Tipo</label>
																	<input type="hidden" id="pettype" name="pettype" value="<?php
																	if (isset($idpettype)) {
																		echo $idpettype;
																	}
																	?>" />
																	<input type="text" class="form-control" id="pettypename" name="pettypename" placeholder="Tipo de mascota" value="<?php
																	if (isset($pettypename)) {
																		echo $pettypename;
																	}
																	?>" readonly />
																</div>
																<div class="form-group">
																	<label for="petbreed">Raza</label>
																	<input type="hidden" id="petbreed" name="petbreed" value="<?php
																	if (isset($idbreed)) {
																		echo $idbreed;
																	}
																	?>" />
																	<input type="text" class="form-control" id="petbreedname" name="petbreedname" placeholder="Raza de la mascota" value="<?php
																	if (isset($petbreedname)) {
																		echo $petbreedname;
																	}
																	?>" readonly />
																</div>
																<div class="form-group">
																	<label for="petreproduction">Estado reproductivo</label>
																	<select id="petreproduction" name="petreproduction" class="form-control" required>
																		<?php
																		include '../phpfragments/reproduction_select.php';
																		?>
																	</select>
																</div>
																<div class="form-group">
																	<label for="petcolor">Color</label>
																	<input type="text" class="form-control" id="petcolor" name="petcolor" placeholder="Color" maxlength="45" value="<?php
																	if (isset($color)) {
																		echo $color;
																	}
																	?>" required />
																</div>
																<div class="form-group">
																	<div class="radio">
																		<label>
																			<input type="radio" id="petsex1" name="petsex" value="M" <?php
																			if (isset($sex)) {
																				if ($sex == "M") { echo "checked";
																				}
																			} else { echo "checked";
																			}
																			?> />
																			Macho</label>
																	</div>
																	<div class="radio">
																		<label>
																			<input type="radio" id="petsex2" name="petsex" value="F" <?php
																			if (isset($sex)) {
																				if ($sex == "F") { echo "checked";
																				}
																			}
																			?> />
																			Hembra</label>
																	</div>
																</div>
																<div id="divborndate" class="form-group">
																	<label for="petborndate">Fecha de nacimiento</label>
																	<input type="text" class="form-control" id="petborndate" name="petborndate" placeholder="Fecha de nacimiento" data-inputmask="'alias': 'mm/yyyy'" value="<?php
																	if (isset($borndate)) {
																		echo $borndate;
																	}
																	?>" required data-mask />
																</div>
																<div class="form-group">
																	<label for="petbornplace">Procedencia</label>
																	<input type="text" class="form-control" id="petbornplace" name="petbornplace" placeholder="Lugar en el cual se adquiri&oacute; la mascota"  maxlength="60" value="<?php
																	if (isset($bornplace)) {
																		echo $bornplace;
																	}
																	?>" required />
																</div>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</aside>
		</div>
		<div id="breed-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione el tipo y raza de la mascota.
			</p>
		</div>
		<div id="borndate-dialog" title="Error" style="display: none">
			<p>
				<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de nacimiento no es valida.
			</p>
		</div>
		<?php
		include '../phpfragments/pettype_dialog.php';
		?>
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
				if (!validateTypeAndBreed()) {
					$("#divpettype").addClass("has-error");
					showDivDialog($("#breed-dialog"));
					return false;
				} else {
					$("#divpettype").removeClass("has-error");
				}
				if (!validateBornDate()) {
					$("#divborndate").addClass("has-error");
					showDivDialog($("#borndate-dialog"));
					return false;
				} else {
					$("#divborndate").removeClass("has-error");
				}
			}

			function validateTypeAndBreed() {
				return $.trim($('#pettype').val()) !== '' && $.trim($('#petbreed').val()) !== '';
			}

			function validateBornDate() {
				var borndate = $.trim($('#petborndate').val());
				var array = borndate.split("/");
				var arrayMonth = array[0].split("");
				var arrayYear = array[1].split("");
				return arrayMonth[0] !== 'm' && arrayMonth[1] !== 'm' && arrayYear[0] !== 'y' && arrayYear[1] !== 'y' && arrayYear[2] !== 'y' && arrayYear[3] !== 'y';
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