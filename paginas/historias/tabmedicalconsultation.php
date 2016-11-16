<?php
if (isset($idclinichistory)) {
	
	include_once '../../php/medicalconsultation.php';		
	$mdconsultable = new MedicalConsultationTable();
				
	if (isset($_POST['consultation'])) {		
		$idconsultation = $_POST['idconsultation'];			 
		$consultationdate = $_POST['consultationdate'];
		$weight = $_POST['weight'];
		$idfoodbrand = $_POST['foodbrand'];
		$corporalcondition = $_POST['corporalcondition'];
		$motive = $_POST['motive'];
		$diagnosis = $_POST['diagnosis'];
		$illness = $_POST['illness'];
		$treatment = $_POST['treatment'];
		$anamnesis = $_POST['anamnesis'];
		$findings = $_POST['findings'];
		$control = $_POST['control'];
		
		$external = $consultationdate . ' 00:00:00';
		$format = "d/m/Y H:i:s";
		$dateobj = DateTime::createFromFormat($format, $external);
		$consultationdateToSQL = $dateobj -> format("Y-m-d");
		
		if ($idconsultation == 0) {
			$mdsaved = $mdconsultable -> insert($idclinichistory, $idfoodbrand, $weight, $corporalcondition, $consultationdateToSQL, $motive, $anamnesis, $illness, $findings, $diagnosis, $treatment, $control, $companyId);
		} else {
			$mdsaved = $mdconsultable -> update($idconsultation, $idfoodbrand, $weight, $corporalcondition, $consultationdateToSQL, $motive, $anamnesis, $illness, $findings, $diagnosis, $treatment, $control);
		}
		
		if ($mdsaved === FALSE) {
			saveError($mdconsultable -> getError());
		}
	}

	if (isset($_POST['idconsultation'])) {
		$idconsultation = $_POST['idconsultation'];
	} 

	if (isset($idconsultation) && $idconsultation > 0) {
		$results = $mdconsultable -> selectById($idconsultation);
		if ($rows = mysqli_fetch_array($results)) {
			$external = $rows['consultationdate'];
			$format = "Y-m-d h:i:s";
			$dateobj = DateTime::createFromFormat($format, $external);
			$consultationdate = $dateobj -> format("d/m/Y");
			$weight = $rows['weight'];
			$idfoodbrand = $rows['idfoodbrand'];
			$corporalcondition = $rows['corporalcondition'];
			$motive = $rows['motive'];
			$diagnosis = $rows['diagnosis'];
			$illness = $rows['illness'];
			$treatment = $rows['treatment'];
			$anamnesis = $rows['anamnesis'];
			$findings = $rows['findings'];
			$control = $rows['control'];
			
			if ($weight < 10) {
				$weight = '00' . $weight . '';
			} else if ($weight < 100) {
				$weight = '0' . $weight . '';
			}
		}
	}
?>
<div class="tab-pane active" id="tab_2">
	<?php
	if (isset($mdsaved) && $mdsaved) {
		echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> Los datos de la consulta m&eacute;dica han sido guardados exitosamente.
</div>';
	}
	if (isset($mdsaved) && !$mdsaved) {
		echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos de la consulta m&eacute;dica, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
	}
	?>
	<form action="historia.php" method="post" role="form" onsubmit="return validateConsultation()">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<button type="submit" id="consultation" name="consultation" class="btn btn-primary">
							<i class="fa fa-save"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Consulta</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-4">
								<label for="consultationdate">Fecha</label>
								<input type="text" class="form-control" id="consultationdate" name="consultationdate" placeholder="Fecha de la consulta" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
								if (isset($consultationdate)) {
									echo $consultationdate;
								}
								?>"
								<?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' readonly ';
								}
								?>
								required data-mask>
								<input type="hidden" id="idconsultation" name="idconsultation" value="<?php
								if (isset($idconsultation)) {
									echo $idconsultation;
								} else {
									echo '0';
								}
								?>" />
								<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
								if (isset($idclinichistory)) {
									echo $idclinichistory;
								}
								?>" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="box">
					<div class="box-body">
						<div class="form-group">
							<label for="weight">Peso (Kg)</label>
							<input type="text" class="form-control" id="weight" name="weight" placeholder="Peso de la mascota" data-inputmask='"mask": "999.99"' value="<?php
							if (isset($weight)) {
								echo $weight;
							} else {
								echo '000.00';
							}
							?>" required data-mask>
						</div>
						<div id="divfoodbrand" class="form-group">
							<label for="foodbrand">Marca de alimento</label>
							<select class="form-control" id="foodbrand" name="foodbrand" required>
								<option value="0">Seleccione uno...</option>
								<?php
								include '../phpfragments/foodbrand_select.php';
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="corporalcondition">Condici&oacute;n corporal</label>
							<input type="text" class="form-control" id="corporalcondition" name="corporalcondition" placeholder="Condici&oacute;n corporal" maxlength="30" value="<?php
							if (isset($corporalcondition)) {
								echo $corporalcondition;
							}
							?>" required>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="box">
					<div class="box-body">
						<div class="form-group">
							<label for="motive">Motivo</label>
							<textarea class="form-control" id="motive" name="motive" rows="3" maxlength="200" placeholder="&iquest;Cu&aacute;l es el motivo de la visita?" required><?php
							if (isset($motive)) { echo $motive;
							}
 ?></textarea>
						</div>
						<div class="form-group">
							<label for="diagnosis">Diagn&oacute;stico</label>
							<textarea class="form-control" id="diagnosis" name="diagnosis" rows="2" maxlength="100"><?php
							if (isset($diagnosis)) { echo $diagnosis;
							}
 ?> </textarea>
						</div>
						<div class="form-group">
							<label for="illness">Enfermedad</label>
							<input type="text" class="form-control" id="illness" name="illness" placeholder="Posible enfermedad" maxlength="60" value="<?php
							if (isset($illness)) {
								echo $illness;
							}
							?>">
						</div>
						<div class="form-group">
							<label for="treatment">Tratamiento</label>
							<textarea class="form-control" id="treatment" name="treatment" rows="4" maxlength="400"><?php
							if (isset($treatment)) { echo $treatment;
							}
 ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="box">
					<div class="box-body">
						<div class="form-group">
							<label for="anamnesis">Anamnesis</label>
							<textarea class="form-control" id="anamnesis" name="anamnesis" rows="4" maxlength="400"><?php
							if (isset($anamnesis)) { echo $anamnesis;
							}
 ?></textarea>
						</div>
						<div class="form-group">
							<label for="findings">Hallazgos</label>
							<textarea class="form-control" id="findings" name="findings" rows="3" maxlength="200"><?php
							if (isset($findings)) { echo $findings;
							}
 ?></textarea>
						</div>
						<div class="form-group">
							<label for="control">Control</label>
							<textarea class="form-control" id="control" name="control" rows="3" maxlength="200"><?php
							if (isset($control)) { echo $control;
							}
 ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div id="foodbrand-dialog" title="Error" style="display: none">
	<p>
		<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione una marca de alimento.
	</p>
</div>
<?php } ?>