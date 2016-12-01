<div class="tab-pane active" id="tab_1">
	<div class="row">
		<form action="procedimientos.php" method="post" role="form" onsubmit="return validatePreEvaluation()">
			<div class="col-xs-12">
				<div class="box">
					<?php
					if (isset($preevaluationgeneraldatasaved) && isset($preevaluationsaved)) {
						if ($preevaluationsaved) {
							echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La valoraci&oacute;n ha sido guardada exitosamente.
</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
						}
					} else if (isset($preevaluationgeneraldatasaved) || isset($preevaluationsaved)) {
						echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
					}
					?>
					<div class="box-header">
						<h3 class="box-title">Valoraci&oacute;n pre-quir&uacute;rgica</h3>
					</div>
					<div class="box-body">
						<button type="submit" id="savepreevaluation" name="savepreevaluation" class="btn btn-primary">
							<i class="fa fa-save"></i>
						</button>
						<br />
						<br />
						<?php if (isset($_POST['idclinichistory'])) {
						?>
						<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $_POST['idclinichistory']; ?>" />
						<?php } ?>
						<input type="hidden" id="idpreevaluation" name="idpreevaluation" value="<?php
						if (isset($idpreevaluation)) {
							echo $idpreevaluation;
						} else {
							0;
						}
						?>"/>
						<input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php
						if (isset($idgeneraldatapreevaluation)) {
							echo $idgeneraldatapreevaluation;
						} else {
							0;
						}
						?>">
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="name">Nombre del procedimiento</label>
									<input type="text" class="form-control" id="name" name="name" value="<?php
									if (isset($namepreevaluation)) {
										echo $namepreevaluation;
									}
									?>" required />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div id="divgeneraldatadatepreevaluation" class="form-group">
									<label for="generaldatadate">Fecha</label>
									<input type="text" class="form-control" id="generaldatadatepreevaluation" name="generaldatadatepreevaluation" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
									if (isset($generaldatadatepreevaluation)) {
										echo $generaldatadatepreevaluation;
									}
									?>" required data-mask />
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="weight">Peso de la mascota (Kg)</label>
									<input type="text" class="form-control" id="weight" name="weight" placeholder="KG" maxlength="5" autocomplete="off" value="<?php
									if (isset($weightpreevaluation)) {
										echo $weightpreevaluation;
									}
									?>" required />
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="corporalcondition">Condici&oacute;n corporal</label>
									<input type="text" class="form-control" id="corporalcondition" name="corporalcondition" placeholder="Condici&oacute;n corporal" maxlength="30" value="<?php
									if (isset($corporalconditionpreevaluation)) {
										echo $corporalconditionpreevaluation;
									}
									?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="heartrate">Frecuencia cardiaca (ppm)</label>
									<input type="text" class="form-control" id="heartrate" name="heartrate" placeholder="PPM" maxlength="3" autocomplete="off" value="<?php
									if (isset($heartratepreevaluation)) {
										echo $heartratepreevaluation;
									}
									?>" required />
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="breathingfrequency">Frecuencia respiratoria</label>
									<input type="text" class="form-control" id="breathingfrequency" name="breathingfrequency" placeholder="Frecuencia" maxlength="3" autocomplete="off" value="<?php
									if (isset($breathingfrequencypreevaluation)) {
										echo $breathingfrequencypreevaluation;
									}
									?>" required />
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="temperature">Temperatura (&#8728;C)</label>
									<input type="text" class="form-control" id="temperature" name="temperature" placeholder="Temperatura" maxlength="4" autocomplete="off" value="<?php
									if (isset($temperaturepreevaluation)) {
										echo $temperaturepreevaluation;
									}
									?>" required />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="heartbeat">Pulso</label>
									<input type="text" class="form-control" id="heartbeat" name="heartbeat" placeholder="Pulso" maxlength="40" value="<?php
									if (isset($heartbeatpreevaluation)) {
										echo $heartbeatpreevaluation;
									}
									?>" required>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="linfonodulos">Linfon&oacute;dulos</label>
									<input type="text" class="form-control" id="linfonodulos" name="linfonodulos" placeholder="Linfon&oacute;dulos" maxlength="60" value="<?php
									if (isset($linfonodulospreevaluation)) {
										echo $linfonodulospreevaluation;
									}
									?>" required>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="mucous">Mucosas</label>
									<input type="text" class="form-control" id="mucous" name="mucous" placeholder="Mucosas" maxlength="60" value="<?php
									if (isset($mucouspreevaluation)) {
										echo $mucouspreevaluation;
									}
									?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="trc">Tiempo de relleno capilar</label>
									<input type="text" class="form-control" id="trc" name="trc" placeholder="Segundos" maxlength="3" autocomplete="off" value="<?php
									if (isset($trcpreevaluation)) {
										echo $trcpreevaluation;
									}
									?>" required />
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="dh">DH %</label>
									<input type="text" class="form-control" id="dh" name="dh" placeholder="DH %" maxlength="3" autocomplete="off" value="<?php
									if (isset($dhpreevaluation)) {
										echo $dhpreevaluation;
									}
									?>" required />
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="mood">Estado de &aacute;nimo</label>
									<input type="text" class="form-control" id="mood" name="mood" placeholder="Estado de &aacute;nimo" maxlength="60" value="<?php
									if (isset($moodpreevaluation)) {
										echo $moodpreevaluation;
									}
									?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="tusigo">Reflejo tusigeno</label>
									<input type="text" class="form-control" id="tusigo" name="tusigo" placeholder="Reflejo tusigeno" maxlength="60" value="<?php
									if (isset($tusigopreevaluation)) {
										echo $tusigopreevaluation;
									}
									?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="anamnesis">Anamnesis</label>
									<textarea class="form-control" id="anamnesis" name="anamnesis" rows="5" maxlength="400" required><?php
									if (isset($anamnesispreevaluation)) { echo $anamnesispreevaluation;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="findings">Hallazgos</label>
									<textarea class="form-control" id="findings" name="findings" rows="5" maxlength="400" required><?php
									if (isset($findingspreevaluation)) { echo $findingspreevaluation;
									}
												?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="presumptivediagnosis">Diagn&oacute;stico presuntivo</label>
									<textarea class="form-control" id="presumptivediagnosis" name="presumptivediagnosis" rows="4" maxlength="100" required><?php
									if (isset($presumptivediagnosispreevaluation)) { echo $presumptivediagnosispreevaluation;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="differentialdiagnosis">Diagn&oacute;stico diferencial</label>
									<textarea class="form-control" id="differentialdiagnosis" name="differentialdiagnosis" rows="4" maxlength="100" required><?php
									if (isset($differentialdiagnosispreevaluation)) { echo $differentialdiagnosispreevaluation;
									}
												?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="diagnosisrecomendations">Recomendaciones (Ayuda diagn&oacute;stico)</label>
									<textarea class="form-control" id="diagnosisrecomendations" name="diagnosisrecomendations" rows="4" maxlength="100"><?php
									if (isset($diagnosisrecomendationspreevaluation)) { echo $diagnosisrecomendationspreevaluation;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="diagnosissamples">Muestras tomadas (Ayuda diagn&oacute;stico)</label>
									<textarea class="form-control" id="diagnosissamples" name="diagnosissamples" rows="4" maxlength="100"><?php
									if (isset($diagnosissamplespreevaluation)) { echo $diagnosissamplespreevaluation;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="diagnosisexams">Examenes a practicar (Ayuda diagn&oacute;stico)</label>
									<textarea class="form-control" id="diagnosisexams" name="diagnosisexams" rows="4" maxlength="100"><?php
									if (isset($diagnosisexamspreevaluation)) { echo $diagnosisexamspreevaluation;
									}
												?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="clinicaltreatment">Tratamiento cl&iacute;nica</label>
									<textarea class="form-control" id="clinicaltreatment" name="clinicaltreatment" rows="8" maxlength="400"><?php
									if (isset($clinicaltreatmentpreevaluation)) { echo $clinicaltreatmentpreevaluation;
									}
			?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="formulanumber">N&uacute;mero de f&oacute;rmula</label>
									<input type="text" class="form-control" id="formulanumber" name="formulanumber" placeholder="N&uacute;mero de f&oacute;rmula" maxlength="5" autocomplete="off" value="<?php
									if (isset($formulanumberpreevaluation)) {
										echo $formulanumberpreevaluation;
									} else {
										echo '0';
									}
									?>" />
								</div>
								<div class="form-group">
									<label for="formula">F&oacute;rmula</label>
									<textarea class="form-control" id="formula" name="formula" rows="4" maxlength="400"><?php
									if (isset($formulapreevaluation)) { echo $formulapreevaluation;
									}
			?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="recomendations">Recomendaciones</label>
									<textarea class="form-control" id="recomendations" name="recomendations" rows="5" maxlength="400"><?php
									if (isset($recomendationspreevaluation)) { echo $recomendationspreevaluation;
									}
			?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="observations">Observaciones</label>
									<textarea class="form-control" id="observations" name="observations" rows="5" maxlength="400"><?php
									if (isset($observationspreevaluation)) { echo $observationspreevaluation;
									}
			?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="definitivediagnosis">Diagn&oacute;stico definitivo</label>
									<textarea class="form-control" id="definitivediagnosis" name="definitivediagnosis" rows="4" maxlength="100"><?php
									if (isset($definitivediagnosispreevaluation)) { echo $definitivediagnosispreevaluation;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="forecast">Pron&oacute;stico</label>
									<textarea class="form-control" id="forecast" name="forecast" rows="4" maxlength="100"><?php
									if (isset($forecastpreevaluation)) { echo $forecastpreevaluation;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="checkbox">
									<label> &iquest;Apto para procedimiento?
										<input type="checkbox" id="surgeryapplication" name="surgeryapplication"
										<?php
										if (isset($surgeryapplicationpreevaluation) && ($surgeryapplicationpreevaluation || $surgeryapplicationpreevaluation === TRUE)) {
											echo "checked";
										}
										?>
										/>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>