<?php
if (isset($idclinichistory)) {
	$vaccineapplication = FALSE;
	$vaccine1 = 0;
	$vaccine2 = 0;
	$vaccine3 = 0;
	$vaccine4 = 0;
	$vaccine5 = 0;
	$vaccine6 = 0;
	$vaccine7 = 0;
	$vaccine8 = 0;
	
	$drenchingapplication = FALSE;
	$drenching1 = 0;
	$drenching2 = 0;
	$drenching3 = 0;
	$drenching4 = 0;
	$drenching5 = 0;
	$drenching6 = 0;
	$drenching7 = 0;
	$drenching8 = 0;
	
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
		$vaccineapplication = (isset($_POST['vaccineapplication'])) ? $_POST['vaccineapplication'] : FALSE;
		$drenchingapplication = (isset($_POST['drenchingapplication'])) ? $_POST['drenchingapplication'] : FALSE;
		
		$external = $consultationdate . ' 00:00:00';
		$format = "d/m/Y H:i:s";
		$dateobj = DateTime::createFromFormat($format, $external);
		$consultationdateToSQL = $dateobj -> format("Y-m-d");
		
		if ($vaccineapplication || $vaccineapplication === TRUE) {
			$vaccinenumber = $_POST['vaccinenumber'];
			$vaccine1 = $_POST['vaccine1'];
			$vaccine2 = $_POST['vaccine2'];
			$vaccine3 = $_POST['vaccine3'];
			$vaccine4 = $_POST['vaccine4'];
			$vaccine5 = $_POST['vaccine5'];
			$vaccine6 = $_POST['vaccine6'];
			$vaccine7 = $_POST['vaccine7'];
			$vaccine8 = $_POST['vaccine8'];
		}

		if ($drenchingapplication || $drenchingapplication === TRUE) {
			$drenchingnumber = $_POST['drenchingnumber'];
			$drenching1 = $_POST['drenching1'];
			$drenching2 = $_POST['drenching2'];
			$drenching3 = $_POST['drenching3'];
			$drenching4 = $_POST['drenching4'];
			$drenching5 = $_POST['drenching5'];
			$drenching6 = $_POST['drenching6'];
			$drenching7 = $_POST['drenching7'];
			$drenching8 = $_POST['drenching8'];
		}
		
		if ($idconsultation == 0) {
			$mdsaved = $mdconsultable -> insert($idclinichistory, $idfoodbrand, $weight, $corporalcondition, $consultationdateToSQL, $motive, $anamnesis, $illness, $findings, $diagnosis, $treatment, $control, $companyId);
		} else {
			$mdsaved = $mdconsultable -> update($idconsultation, $idfoodbrand, $weight, $corporalcondition, $consultationdateToSQL, $motive, $anamnesis, $illness, $findings, $diagnosis, $treatment, $control);
		}
		
		if ($mdsaved === TRUE) {
			if ($idconsultation == 0) {
				$idconsultation = $mdconsultable -> selectLastInsertId();
				if ($vaccineapplication || $vaccineapplication === TRUE) {
					$index = $vaccinenumber;
					while ($index > 0) {
						$idvaccine = 0;
						if ($index == 1) {
							$idvaccine = $vaccine1;
						} else if ($index == 2) {
							$idvaccine = $vaccine2;
						} else if ($index == 3) {
							$idvaccine = $vaccine3;
						} else if ($index == 4) {
							$idvaccine = $vaccine4;
						} else if ($index == 5) {
							$idvaccine = $vaccine5;
						} else if ($index == 6) {
							$idvaccine = $vaccine6;
						} else if ($index == 7) {
							$idvaccine = $vaccine7;
						} else if ($index == 8) {
							$idvaccine = $vaccine8;
						}
						if ($idvaccine > 0) {
							saveMedicalConsultationXVaccine($idconsultation, $idvaccine);
						}
						$index -= 1;
					}
				}
				if ($drenchingapplication || $drenchingapplication === TRUE) {
					$index = $drenchingnumber;
					while ($index > 0) {
						$iddrenching = 0;
						if ($index == 1) {
							$iddrenching = $drenching1;
						} else if ($index == 2) {
							$iddrenching = $drenching2;
						} else if ($index == 3) {
							$iddrenching = $drenching3;
						} else if ($index == 4) {
							$iddrenching = $drenching4;
						} else if ($index == 5) {
							$iddrenching = $drenching5;
						} else if ($index == 6) {
							$iddrenching = $drenching6;
						} else if ($index == 7) {
							$iddrenching = $drenching7;
						} else if ($index == 8) {
							$iddrenching = $drenching8;
						}
						if ($iddrenching > 0) {
							saveMedicalConsultationXDrenching($idconsultation, $iddrenching);
						}
						$index -= 1;
					}
				}
			}
		} else {
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
			$weight = ($rows['weight'] < 100) ? '0' . $rows['weight'] : $rows['weight'];
			$idfoodbrand = $rows['idfoodbrand'];
			$corporalcondition = $rows['corporalcondition'];
			$motive = $rows['motive'];
			$diagnosis = $rows['diagnosis'];
			$illness = $rows['illness'];
			$treatment = $rows['treatment'];
			$anamnesis = $rows['anamnesis'];
			$findings = $rows['findings'];
			$control = $rows['control'];
		}
		$mcvaccinetable = new MedicalConsultationXVaccineTable();
		$results = $mcvaccinetable -> select($idconsultation);
		$vaccinenumber = mysqli_num_rows($results);
		if ($vaccinenumber > 0) {
			$vaccineapplication = TRUE;
			$index = 1;
			while ($rows = mysqli_fetch_array($results)) {
				if ($index == 1) {
					$vaccine1 = $rows['idvaccine'];
				} else if ($index == 2) {
					$vaccine2 = $rows['idvaccine'];
				} else if ($index == 3) {
					$vaccine3 = $rows['idvaccine'];
				} else if ($index == 4) {
					$vaccine4 = $rows['idvaccine'];
				} else if ($index == 5) {
					$vaccine5 = $rows['idvaccine'];
				} else if ($index == 6) {
					$vaccine6 = $rows['idvaccine'];
				} else if ($index == 7) {
					$vaccine7 = $rows['idvaccine'];
				} else if ($index == 8) {
					$vaccine8 = $rows['idvaccine'];
				}
				$index += 1;
			}
		}
		$mcdrenchingtable = new MedicalConsultationXDrenchingTable();
		$results = $mcdrenchingtable -> select($idconsultation);
		$drenchingnumber = mysqli_num_rows($results);
		if ($drenchingnumber > 0) {
			$drenchingapplication = TRUE;
			$index = 1;
			while ($rows = mysqli_fetch_array($results)) {
				if ($index == 1) {
					$drenching1 = $rows['iddrenching'];
				} else if ($index == 2) {
					$drenching2 = $rows['iddrenching'];
				} else if ($index == 3) {
					$drenching3 = $rows['iddrenching'];
				} else if ($index == 4) {
					$drenching4 = $rows['iddrenching'];
				} else if ($index == 5) {
					$drenching5 = $rows['iddrenching'];
				} else if ($index == 6) {
					$drenching6 = $rows['iddrenching'];
				} else if ($index == 7) {
					$drenching7 = $rows['iddrenching'];
				} else if ($index == 8) {
					$drenching8 = $rows['iddrenching'];
				}
				$index += 1;
			}
		}
	}

	include_once '../../php/vaccine.php';
	include_once '../../php/drenching.php';
	include_once '../phpfragments/vaccine_select.php';
	include_once '../phpfragments/drenching_select.php';
	
	$vaccinetable = new VaccineTable();
	$results = $vaccinetable -> select($companyId);
	$vaccineresults = array();
	while ($rows = mysqli_fetch_array($results)) {
		$vaccineresults[] = $rows;
	}
	
	$drenchingtable = new DrenchingTable();
	$results = $drenchingtable -> select($companyId);
	$drenchingresults = array();
	while ($rows = mysqli_fetch_array($results)) {
		$drenchingresults[] = $rows;
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
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h4 class="box-title">Vacunaci&oacute;n</h4>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2">
								<div class="checkbox">
									<label> &iquest;Se aplicaron vacunas?
										<input type="checkbox" id="vaccineapplication" name="vaccineapplication"
										<?php
										if ($vaccineapplication || $vaccineapplication === TRUE) {
											echo "checked";
										}
										if (isset($idconsultation) && $idconsultation > 0) {
											echo ' disabled ';
										}
										?>
										/></label>
								</div>
							</div>
							<div id="divvaccinequantity" class="col-xs-2" style="display: <?php
							if ($vaccineapplication || $vaccineapplication === TRUE) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccinenumber">&iquest;Cu&aacute;ntas?</label>
								<select class="form-control" id="vaccinenumber" name="vaccinenumber" onchange="afterChangeVaccineNumber()" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="1" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 1) {
										echo "selected";
									}
									?>>1</option>
									<option value="2" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 2) {
										echo "selected";
									}
									?>>2</option>
									<option value="3" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 3) {
										echo "selected";
									}
									?>>3</option>
									<option value="4" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 4) {
										echo "selected";
									}
									?>>4</option>
									<option value="5" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 5) {
										echo "selected";
									}
									?>>5</option>
									<option value="6" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 6) {
										echo "selected";
									}
									?>>6</option>
									<option value="7" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 7) {
										echo "selected";
									}
									?>>7</option>
									<option value="8" <?php
									if (($vaccineapplication || $vaccineapplication === TRUE) && (int)$vaccinenumber == 8) {
										echo "selected";
									}
									?>>8</option>
								</select>
							</div>
						</div>
						<br />
						<div class="row">
							<div id="divvaccine1" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 1) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine1">Vacuna #1</label>
								<select id="vaccine1" name="vaccine1" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine1) ?>
								</select>
							</div>
							<div id="divvaccine2" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 2) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine2">Vacuna #2</label>
								<select id="vaccine2" name="vaccine2" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine2) ?>
								</select>
							</div>
							<div id="divvaccine3" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 3) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine3">Vacuna #3</label>
								<select id="vaccine3" name="vaccine3" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine3) ?>
								</select>
							</div>
							<div id="divvaccine4" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 4) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine4">Vacuna #4</label>
								<select id="vaccine4" name="vaccine4" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine4) ?>
								</select>
							</div>
						</div>
						<br />
						<div class="row">
							<div id="divvaccine5" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 5) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine5">Vacuna #5</label>
								<select id="vaccine5" name="vaccine5" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine5) ?>
								</select>
							</div>
							<div id="divvaccine6" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 6) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine6">Vacuna #6</label>
								<select id="vaccine6" name="vaccine6" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine6) ?>
								</select>
							</div>
							<div id="divvaccine7" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 7) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine7">Vacuna #7</label>
								<select id="vaccine7" name="vaccine7" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine7) ?>
								</select>
							</div>
							<div id="divvaccine8" class="col-xs-3" style="display: <?php
							if (($vaccineapplication || $vaccineapplication === TRUE) && ((int)$vaccinenumber - 8) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="vaccine8">Vacuna #8</label>
								<select id="vaccine8" name="vaccine8" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($vaccineresults, $vaccine8) ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h4 class="box-title">Antiparasitarios</h4>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2">
								<div class="checkbox">
									<label> &iquest;Se aplicaron antiparasitarios?
										<input type="checkbox" id="drenchingapplication" name="drenchingapplication"
										<?php
										if ($drenchingapplication || $drenchingapplication === TRUE) {
											echo "checked";
										}

										if (isset($idconsultation) && $idconsultation > 0) {
											echo " disabled ";
										}
										?>
										/></label>
								</div>
							</div>
							<div id="divdrenchingquantity" class="col-xs-2" style="display: <?php
							if ($drenchingapplication || $drenchingapplication === TRUE) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenchingnumber">&iquest;Cu&aacute;ntos?</label>
								<select class="form-control" id="drenchingnumber" name="drenchingnumber" onchange="afterChangeDrenchingNumber()" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="1" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 1) {
										echo "selected";
									}
									?>>1</option>
									<option value="2" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 2) {
										echo "selected";
									}
									?>>2</option>
									<option value="3" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 3) {
										echo "selected";
									}
									?>>3</option>
									<option value="4" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 4) {
										echo "selected";
									}
									?>>4</option>
									<option value="5" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 5) {
										echo "selected";
									}
									?>>5</option>
									<option value="6" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 6) {
										echo "selected";
									}
									?>>6</option>
									<option value="7" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 7) {
										echo "selected";
									}
									?>>7</option>
									<option value="8" <?php
									if (($drenchingapplication || $drenchingapplication === TRUE) && (int)$drenchingnumber == 8) {
										echo "selected";
									}
									?>>8</option>
								</select>
							</div>
						</div>
						<br />
						<div class="row">
							<div id="divdrenching1" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 1) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching1">Antiparasitario #1</label>
								<select id="drenching1" name="drenching1" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching1) ?>
								</select>
							</div>
							<div id="divdrenching2" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 2) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching2">Antiparasitario #2</label>
								<select id="drenching2" name="drenching2" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching2) ?>
								</select>
							</div>
							<div id="divdrenching3" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 3) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching3">Antiparasitario #3</label>
								<select id="drenching3" name="drenching3" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching3) ?>
								</select>
							</div>
							<div id="divdrenching4" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 4) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching4">Antiparasitario #4</label>
								<select id="drenching4" name="drenching4" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching4) ?>
								</select>
							</div>
						</div>
						<br />
						<div class="row">
							<div id="divdrenching5" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 5) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching5">Antiparasitario #5</label>
								<select id="drenching5" name="drenching5" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching5) ?>
								</select>
							</div>
							<div id="divdrenching6" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 6) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching6">Antiparasitario #6</label>
								<select id="drenching6" name="drenching6" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching6) ?>
								</select>
							</div>
							<div id="divdrenching7" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 7) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching7">Antiparasitario #7</label>
								<select id="drenching7" name="drenching7" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching7) ?>
								</select>
							</div>
							<div id="divdrenching8" class="col-xs-3" style="display: <?php
							if (($drenchingapplication || $drenchingapplication === TRUE) && ((int)$drenchingnumber - 8) >= 0) {
								echo 'block';
							} else {
								echo 'none';
							}
							?>;">
								<label for="drenching8">Antiparasitario #8</label>
								<select id="drenching8" name="drenching8" class="form-control" <?php
								if (isset($idconsultation) && $idconsultation > 0) {
									echo ' disabled ';
								}
								?>
									> <option value="0">Seleccione uno...</option>
									<?php createVaccineOptions($drenchingresults, $drenching8) ?>
								</select>
							</div>
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