<div id="pettype-dialog" title="Tipos y razas de mascotas" style="display: none">
	<table id="tableData" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th style="text-align:center; width: 40%">Tipo</th>
				<th style="text-align:center; width: 40%">Raza</th>
				<th style="text-align:center; width: 20%">Seleccionar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once '../../php/breed.php';
			$breed = new BreedTable();
			$results = $breed -> select($companyId);
			while ($rows = mysqli_fetch_array($results)) {
				echo "<tr>";
				echo '<td>' . $rows["pettype"] . '</td>';
				echo '<td>' . $rows["breed"] . '</td>';
				echo '<td style="text-align:center"><button type="button" id="select" name="select" class="btn btn-info" onclick="selectPetType(' . $rows["idpettype"] . ',' . $rows["id"] . ',\'' . $rows["pettype"] . '\',\'' . $rows["breed"] . '\');"><i class="fa fa-check"></i></button></td>';
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	function showPetType() {
		showPetTypeDialog($("#pettype-dialog"));
	}
	
	function selectPetType(idPetType, idBreed, petType, breed) {
		$("#pettype").val(idPetType);
		$("#pettypename").val(petType);
		$("#petbreed").val(idBreed);
		$("#petbreedname").val(breed);
		$("#pettype-dialog").dialog("close");
	}

	function showPetTypeDialog(divDialog) {
		divDialog.dialog({
			autoOpen : false,
			width : 800,
			modal : true,
			resizable : false,
			buttons : [{
				text : "Volver",
				click : function() {
					$(this).dialog("close");
				}
			}]
		});
		divDialog.dialog("open");
	}
</script>