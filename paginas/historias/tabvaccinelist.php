<div class="tab-pane" id="tab_3">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Vacunaciones</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="vacunaciones.php" method="post" role="form">
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
									<i class="fa fa-plus"></i>
								</button>
							</form>
						</div>
					</div>
					<table id="tableData3" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha</th>
								<th style="text-align:center; width: 10%">Peso(Kg)</th>
								<th style="text-align:center; width: 10%">Frecuencia cardiaca</th>
								<th style="text-align:center; width: 10%">Frecuencia respiratoria</th>
								<th style="text-align:center; width: 30%">Producto</th>
								<th style="text-align:center; width: 10%">Lote</th>
								<th style="text-align:center; width: 10%">Expiraci&oacute;n</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $vacConsultationtable -> select($idpet);
							while ($rows = mysqli_fetch_array($results)) {
								$external = $rows['generaldatadate'];
								$format = "Y-m-d h:i:s";
								$dateobj = DateTime::createFromFormat($format, $external);
								$generaldatadate = $dateobj -> format("d/m/Y");
								echo "<tr>";
								echo '<td>' . $generaldatadate . '</td>';
								echo '<td>' . $rows["weight"] . '</td>';
								echo '<td>' . $rows["heartrate"] . '</td>';
								echo '<td>' . $rows["breathingfrequency"] . '</td>';
								echo '<td>' . $rows["name"] . '</td>';
								echo '<td>' . $rows["batch"] . '</td>';
								echo '<td>' . $rows["expiration"] . '</td>';
								echo '<td style="text-align:center"><form action="vacunaciones.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idvaccineconsultation" name="idvaccineconsultation" value="' . $rows["idvaccineconsultation"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="consultas.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idvaccineconsultation" name="idvaccineconsultation" value="' . $rows["idvaccineconsultation"] . '" /><button type="submit" id="deletevacconsultation" name="deletevacconsultation" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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