<?php if (isset($id) && intval($id) > 0) { ?>
<div class="tab-pane active" id="tab_1">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Controles post-consulta</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="control.php" method="post" role="form">
								<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
								if (isset($idclinichistory)) {
									echo $idclinichistory;
								}
								?>" />
								<input type="hidden" id="idconsultation" name="idconsultation" value="<?php
								if (isset($id)) {
									echo $id;
								}
								?>" />
								<input type="hidden" id="idmedicalcontrol" name="idmedicalcontrol" value="0" />
								<button type="submit" id="submit" name="submit" class="btn btn-primary">
									<i class="fa fa-plus"></i>
								</button>
							</form>
						</div>
					</div>
					<table id="tableData" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha</th>
								<th style="text-align:center; width: 20%">Evoluci&oacute;n</th>
								<th style="text-align:center; width: 20%">Recomendaciones (Ayuda diagn&oacute;stico)</th>
								<th style="text-align:center; width: 20%">Muestras tomadas (Ayuda diagn&oacute;stico)</th>
								<th style="text-align:center; width: 20%">Examenes a practicar (Ayuda diagn&oacute;stico)</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $mdcontroltable -> select($id);
							while ($rows = mysqli_fetch_array($results)) {
								echo "<tr>";
								echo '<td>' . format_string_date($rows['generaldatadate'], "d/m/Y") . '</td>';
								echo '<td>' . $rows["evolution"] . '</td>';
								echo '<td>' . $rows["diagnosisrecomendations"] . '</td>';
								echo '<td>' . $rows["diagnosissamples"] . '</td>';
								echo '<td>' . $rows["diagnosisexams"] . '</td>';
								echo '<td style="text-align:center"><form action="control.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $_POST['idclinichistory'] . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $rows["idmedicalconsultation"] . '" /><input type="hidden" id="idmedicalcontrol" name="idmedicalcontrol" value="' . $rows["idmedicalcontrol"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="consulta.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $_POST['idclinichistory'] . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $rows["idmedicalconsultation"] . '" /><input type="hidden" id="idmedicalcontrol" name="idmedicalcontrol" value="' . $rows["idmedicalcontrol"] . '" /><button type="submit" id="deletecontrol" name="deletecontrol" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>