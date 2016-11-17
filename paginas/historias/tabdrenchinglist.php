<div class="tab-pane" id="tab_2">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Desparasitaciones</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="desparasitaciones.php" method="post" role="form">
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
					<table id="tableData2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha</th>
								<th style="text-align:center; width: 10%">Peso(Kg)</th>
								<th style="text-align:center; width: 30%">Producto</th>
								<th style="text-align:center; width: 10%">Dosis</th>
								<th style="text-align:center; width: 30%">V&iacute;a de administraci&oacute;n</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $medxdrenchingtable -> select($idpet);
							while ($rows = mysqli_fetch_array($results)) {
								$external = $rows['drenchingdate'];
								$format = "Y-m-d h:i:s";
								$dateobj = DateTime::createFromFormat($format, $external);
								$drenchingdate = $dateobj -> format("d/m/Y");
								echo "<tr>";
								echo '<td>' . $drenchingdate . '</td>';
								echo '<td>' . $rows["weight"] . '</td>';
								echo '<td>' . $rows["name"] . '</td>';
								echo '<td>' . $rows["dose"] . '</td>';
								echo '<td>' . $rows["administration"] . '</td>';
								echo '<td style="text-align:center"><form action="desparasitaciones.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idmeddrenching" name="idmeddrenching" value="' . $rows["idmeddrenching"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idmeddrenching" name="idmeddrenching" value="' . $rows["idmeddrenching"] . '" /><button type="submit" id="deletemeddrenching" name="deletemeddrenching" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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