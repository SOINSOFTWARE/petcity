<?php
function createVaccineOptions($results, $idvaccine) {
	foreach ($results as $rows) {
		if (isset($idvaccine) && $idvaccine == $rows["id"]) {
			$selected = "selected";
		} else {
			$selected = "";
		}
		echo '<option value="' . $rows["id"] . '" ' . $selected . '>' . $rows["name"] . '</option>';
	}
}
?>