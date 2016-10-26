<div class="tab-pane <?php
if (!isset($idclinichistory)) {
	echo 'active';
}
?>" id="tab_1">
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
	<form action="historia.php" method="post" role="form" onsubmit="return validate()">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<button type="submit" id="basicdata" name="basicdata" class="btn btn-primary">
							<i class="fa fa-save"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
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
<script type="text/javascript">
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
</script>