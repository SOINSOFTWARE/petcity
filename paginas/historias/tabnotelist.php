<div class="tab-pane" id="tab_7">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Notas</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="notas.php" method="post" role="form">
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
					<table id="tableData1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha</th>
								<th style="text-align:center; width: 30%">T&iacute;tulo</th>
								<th style="text-align:center; width: 45%">Mensaje</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Enviar</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $notification -> select($idpet);
							while ($rows = mysqli_fetch_array($results)) {
								echo "<tr>";
								echo '<td>' . format_string_date($rows['notificationdate'], "d/m/Y") . '</td>';
								echo '<td>' . $rows["title"] . '</td>';
								echo '<td>' . $rows["message"] . '</td>';
								echo '<td style="text-align:center"><form action="notas.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idnotification" name="idnotification" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idnotification" name="idnotification" value="' . $rows["id"] . '" /><button type="submit" id="send" name="send" class="btn btn-success"><i class="fa fa-envelope"></i></button></form></td>';
								echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idnotification" name="idnotification" value="' . $rows["id"] . '" /><button type="submit" id="deletenote" name="deletenote" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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