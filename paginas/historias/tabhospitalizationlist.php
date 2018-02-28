<div class="tab-pane" id="tab_5">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Hospitalizaciones</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="hospitalizacion.php" method="post" role="form">
								<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
								if (isset($idclinichistory)) {
									echo $idclinichistory;
								}
								?>" />
								<input type="hidden" id="idpet" name="idpet" value="<?php
								if (isset($idpet)) {
									echo $idpet;
								}
								?>" />
								<button type="submit" id="submit" name="submit" class="btn btn-primary">
									<i class="fa fa-plus"></i> Nueva
								</button>
							</form>
						</div>
					</div>
					<table id="tableData5" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha inicio</th>
								<th style="text-align:center; width: 10%">Fecha final</th>
								<th style="text-align:center; width: 30%">Comentarios</th>
								<th style="text-align:center; width: 30%">Recomendaciones</th>
								<th style="text-align:center; width: 10%">Recibido por</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $hospitalizationTable -> select($idpet);
							while ($rows = mysqli_fetch_array($results)) {
								echo "<tr>";
								echo '<td>' . format_string_date($rows['initialdate'], "d/m/Y") . '</td>';
								echo '<td>' . format_string_date($rows['finaldate'], "d/m/Y") . '</td>';
								echo '<td>' . $rows["comments"] . '</td>';
								echo '<td>' . $rows["recomendations"] . '</td>';
								echo '<td>' . $rows["receivedby"] . '</td>';
								echo '<td style="text-align:center"><form action="hospitalizacion.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idhospitalization" name="idhospitalization" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idhospitalization" name="idhospitalization" value="' . $rows["id"] . '" /><button type="submit" id="deletehospitalization" name="deletehospitalization" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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