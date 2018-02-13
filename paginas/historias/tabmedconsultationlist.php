<div class="tab-pane active" id="tab_1">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Consultas</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="consulta.php" method="post" role="form">
								<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
								if (isset($idclinichistory)) {
									echo $idclinichistory;
								}
								?>" />
								<input type="hidden" id="idconsultation" name="idconsultation" value="0" />
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
								<th style="text-align:center; width: 20%">Motivo</th>
								<th style="text-align:center; width: 20%">Diagn&oacute;stico presuntivo</th>
								<th style="text-align:center; width: 20%">Diagn&oacute;stico diferencial</th>
								<th style="text-align:center; width: 20%">Diagn&oacute;stico definitivo</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $mdconsultable -> selectByIdClinicHistory($idclinichistory);
							while ($rows = mysqli_fetch_array($results)) {
								echo "<tr>";
								echo '<td>' . format_string_date($rows['generaldatadate'], "d/m/Y") . '</td>';
								echo '<td>' . $rows["motive"] . '</td>';
								echo '<td>' . $rows["presumptivediagnosis"] . '</td>';
								echo '<td>' . $rows["differentialdiagnosis"] . '</td>';
								echo '<td>' . $rows["definitivediagnosis"] . '</td>';
								echo '<td style="text-align:center"><form action="consulta.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["idclinichistory"] . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $rows["idconsultation"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["idclinichistory"] . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $rows["idconsultation"] . '" /><button type="submit" id="deleteconsultation" name="deleteconsultation" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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