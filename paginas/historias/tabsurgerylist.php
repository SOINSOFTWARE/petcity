<div class="tab-pane" id="tab_6">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Procedimientos quir&uacute;rgicos o que conllevan anestesia</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="procedimientos.php" method="post" role="form">
								<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
								if (isset($idclinichistory)) {
									echo $idclinichistory;
								}
								?>" />
								<button type="submit" id="submit" name="submit" class="btn btn-primary">
									<i class="fa fa-plus"></i>
								</button>
							</form>
						</div>
					</div>
					<table id="tableData6" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha</th>
								<th style="text-align:center; width: 20%">Apto para el Procedimiento</th>
								<th style="text-align:center; width: 20%">Diagn&oacute;stico presuntivo</th>
								<th style="text-align:center; width: 20%">Diagn&oacute;stico diferencial</th>
								<th style="text-align:center; width: 20%">Diagn&oacute;stico definitivo</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $surgerytable -> selectByIdClinicHistory($idclinichistory);
							while ($rows = mysqli_fetch_array($results)) {
								$external = $rows['generaldatadate'];
								$format = "Y-m-d h:i:s";
								$dateobj = DateTime::createFromFormat($format, $external);
								$consultationdate = $dateobj -> format("d/m/Y");
								$havesurgery = ($rows["havesurgery"] || $rows["havesurgery"] == 1) ? 'Si' : 'No';
								echo "<tr>";
								echo '<td>' . $consultationdate . '</td>';
								echo '<td>' . $havesurgery  . '</td>';
								echo '<td>' . $rows["presumptivediagnosis"] . '</td>';
								echo '<td>' . $rows["differentialdiagnosis"] . '</td>';
								echo '<td>' . $rows["definitivediagnosis"] . '</td>';
								echo '<td style="text-align:center"><form action="procedimientos.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["idclinichistory"] . '" /><input type="hidden" id="idpreevaluation" name="idpreevaluation" value="' . $rows["idpreevaluation"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["idclinichistory"] . '" /><input type="hidden" id="idpreevaluation" name="idpreevaluation" value="' . $rows["idpreevaluation"] . '" /><button type="submit" id="deletesurgery" name="deletesurgery" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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