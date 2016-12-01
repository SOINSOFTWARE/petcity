<div class="tab-pane" id="tab_2">
	<div class="row">
		<form action="procedimientos.php" method="post" role="form" onsubmit="return validate()">
			<div class="col-xs-12">
				<div class="box">
					<?php
					if (isset($generaldatasaved) && isset($saved)) {
						if ($saved) {
							echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> El procedimientos quir&uacute;rgicos ha sido guardado exitosamente.
</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
						}
					} else if (isset($generaldatasaved) || isset($saved)) {
						echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
					}
					if (isset($controldeleted)) {
						if ($controldeleted) {
							echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> El control ha sido eliminado exitosamente.
</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
						}
					}
					if (isset($examdeleted)) {
						if ($examdeleted) {
							echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos eliminados!</b> El ex&aacute;men ha sido eliminado exitosamente.
</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
						}
					}
					?>
					<div class="box-header">
						<h3 class="box-title">Procedimiento</h3>
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
						?>"/>
						<input type="hidden" id="idpreevaluation" name="idpreevaluation" value="<?php
						if (isset($idpreevaluation)) {
							echo $idpreevaluation;
						} else {
							0;
						}
						?>"/>
						<input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php
						if (isset($idgeneraldata)) {
							echo $idgeneraldata;
						} else {
							0;
						}
						?>">
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="name">Nombre del procedimiento</label>
									<input type="text" class="form-control" id="name" name="name" value="<?php
									if (isset($name)) {
										echo $name;
									}
									?>" required />
								</div>
							</div>
						</div>
						<?php
						include_once '../phpfragments/generaldata.php';
						?>
						<div class="row">
							<div class="col-xs-4">
								<div class="checkbox">
									<label> &iquest;Apto para procedimiento?
										<input type="checkbox" id="surgeryapplication" name="surgeryapplication"
										<?php
										if (isset($surgeryapplication) && ($surgeryapplication || $surgeryapplication === TRUE)) {
											echo "checked";
										}
										?>
										/>
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="anamnesis">Anamnesis</label>
									<textarea class="form-control" id="anamnesis" name="anamnesis" rows="5" maxlength="400" required><?php
									if (isset($anamnesis)) { echo $anamnesis;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="findings">Hallazgos</label>
									<textarea class="form-control" id="findings" name="findings" rows="5" maxlength="400" required><?php
									if (isset($findings)) { echo $findings;
									}
												?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="anestheticprotocol">Protocolo anest&eacute;sico</label>
									<textarea class="form-control" id="anestheticprotocol" name="anestheticprotocol" rows="4" maxlength="300"><?php
									if (isset($anestheticprotocol)) { echo $anestheticprotocol;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="premedication">Premedicaci&oacute;n</label>
									<textarea class="form-control" id="premedication" name="premedication" rows="4" maxlength="300"><?php
									if (isset($premedication)) { echo $premedication;
									}
												?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="presumptivediagnosis">Diagn&oacute;stico presuntivo</label>
									<textarea class="form-control" id="presumptivediagnosis" name="presumptivediagnosis" rows="4" maxlength="100" required><?php
									if (isset($presumptivediagnosis)) { echo $presumptivediagnosis;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="differentialdiagnosis">Diagn&oacute;stico diferencial</label>
									<textarea class="form-control" id="differentialdiagnosis" name="differentialdiagnosis" rows="4" maxlength="100" required><?php
									if (isset($differentialdiagnosis)) { echo $differentialdiagnosis;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="checkbox">
									<label> &iquest;Hospitalizaci&oacute;n?
										<input type="checkbox" id="hospitalizationapplication" name="hospitalizationapplication"
										<?php
										if (isset($hospitalizationapplication) && ($hospitalizationapplication || $hospitalizationapplication === TRUE)) {
											echo "checked";
										}
										?>
										/>
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="diagnosisrecomendations">Recomendaciones (Ayuda diagn&oacute;stico)</label>
									<textarea class="form-control" id="diagnosisrecomendations" name="diagnosisrecomendations" rows="4" maxlength="100"><?php
									if (isset($diagnosisrecomendations)) { echo $diagnosisrecomendations;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="diagnosissamples">Muestras tomadas (Ayuda diagn&oacute;stico)</label>
									<textarea class="form-control" id="diagnosissamples" name="diagnosissamples" rows="4" maxlength="100"><?php
									if (isset($diagnosissamples)) { echo $diagnosissamples;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="diagnosisexams">Examenes a practicar (Ayuda diagn&oacute;stico)</label>
									<textarea class="form-control" id="diagnosisexams" name="diagnosisexams" rows="4" maxlength="100"><?php
									if (isset($diagnosisexams)) { echo $diagnosisexams;
									}
												?></textarea>
								</div>
							</div>
						</div>
						<?php
						include_once '../phpfragments/generaldatatreatment.php';
						?>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label for="definitivediagnosis">Diagn&oacute;stico definitivo</label>
									<textarea class="form-control" id="definitivediagnosis" name="definitivediagnosis" rows="4" maxlength="100"><?php
									if (isset($definitivediagnosis)) { echo $definitivediagnosis;
									}
												?></textarea>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label for="forecast">Pron&oacute;stico</label>
									<textarea class="form-control" id="forecast" name="forecast" rows="4" maxlength="100"><?php
									if (isset($forecast)) { echo $forecast;
									}
												?></textarea>
								</div>
							</div>
							<div id="divnextdate" class="col-xs-4">
								<div class="form-group">
									<label for="nextdate">Pr&oacute;ximo control</label>
									<input type="text" class="form-control" id="nextdate" name="nextdate" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
									if (isset($nextdate)) {
										echo $nextdate;
									}
									?>" data-mask />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php if (isset($id) && intval($id) > 0) {
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab_3" data-toggle="tab">Controles</a>
					</li>
					<li>
						<a href="#tab_4" data-toggle="tab">Ex&aacute;menes</a>
					</li>
					<li class="pull-right">
						<a href="#" class="text-muted"><i class="fa fa-table"></i></a>
					</li>
				</ul>
				<div class="tab-content">
					<?php
					include_once 'tabsurgerycontrollist.php';
					include_once 'tabsurgeryexamlist.php';
					?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>