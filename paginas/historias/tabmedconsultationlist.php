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
							<form action="historia.php" method="post" role="form">
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
								<th style="text-align:center; width: 25%">Motivo</th>
								<th style="text-align:center; width: 30%">Diagn&oacute;stico</th>
								<th style="text-align:center; width: 30%">Enfermedad</th>
								<th style="text-align:center; width: 5%">Ver</th>
							</tr>
						</thead>
						<tbody>
							<?php $mdconsultable = new MedicalConsultationTable();
							$results = $mdconsultable -> selectByIdClinicHistory($idclinichistory);
							while ($rows = mysqli_fetch_array($results)) {
								$external = $rows['consultationdate'];
								$format = "Y-m-d h:i:s";
								$dateobj = DateTime::createFromFormat($format, $external);
								$consultationdate = $dateobj -> format("d/m/Y");
								echo "<tr>";
								echo '<td>' . $consultationdate . '</td>';
								echo '<td>' . $rows["motive"] . '</td>';
								echo '<td>' . $rows["diagnosis"] . '</td>';
								echo '<td>' . $rows["illness"] . '</td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["idclinichistory"] . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $rows["id"] . '" /><button type="submit" id="history" name="history" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
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