<?php if (isset($id) && intval($id) > 0) { ?>
<div class="tab-pane" id="tab_4">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Resultados de ex&aacute;menes</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-xs-4">
							<form action="examenprocedimiento.php" method="post" role="form">
								<input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
								if (isset($idclinichistory)) {
									echo $idclinichistory;
								}
								?>" />
								<input type="hidden" id="idsurgery" name="idsurgery" value="<?php
								if (isset($id)) {
									echo $id;
								}
								?>" />
								<input type="hidden" id="idpreevaluation" name="idpreevaluation" value="<?php
								if (isset($idpreevaluation)) {
									echo $idpreevaluation;
								}
								?>" />
								<button type="submit" id="submit" name="submit" class="btn btn-primary">
									<i class="fa fa-plus"></i> Nuevo
								</button>
							</form>
						</div>
					</div>
					<table id="tableData1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align:center; width: 10%">Fecha</th>
								<th style="text-align:center; width: 25%">Nombre</th>
								<th style="text-align:center; width: 50%">Resultados</th>
								<th style="text-align:center; width: 5%">Ver</th>
								<th style="text-align:center; width: 5%">Ex&aacute;men</th>
								<th style="text-align:center; width: 5%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$results = $surgeryexamtable -> select($id);
							while ($rows = mysqli_fetch_array($results)) {
								echo "<tr>";
								echo '<td>' . format_string_date($rows['examdate'], "d/m/Y") . '</td>';
								echo '<td>' . $rows["name"] . '</td>';
								echo '<td>' . $rows["results"] . '</td>';
								echo '<td style="text-align:center"><form action="examenprocedimiento.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $_POST['idclinichistory'] . '" /><input type="hidden" id="idsurgery" name="idsurgery" value="' . $id . '" /><input type="hidden" id="idsurgeryexam" name="idsurgeryexam" value="' . $rows["id"] . '" /><input type="hidden" id="idpreevaluation" name="idpreevaluation" value="' . $idpreevaluation . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
								echo '<td style="text-align:center"><a href="' . $rows["filepath"] . '" class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a></td>';
								echo '<td style="text-align:center"><form action="procedimientos.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $_POST['idclinichistory'] . '" /><input type="hidden" id="idsurgery" name="idsurgery" value="' . $id . '" /><input type="hidden" id="idsurgeryexam" name="idsurgeryexam" value="' . $rows["id"] . '" /><input type="hidden" id="idpreevaluation" name="idpreevaluation" value="' . $idpreevaluation . '" /><button type="submit" id="deleteexam" name="deleteexam" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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