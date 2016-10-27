<?php
function createDrenchingOptions($results, $iddrenching) {
	foreach ($results as $rows) {
		if (isset($iddrenching) && $iddrenching == $rows["id"]) {
			$selected = "selected";
		} else {
			$selected = "";
		}
		echo '<option value="' . $rows["id"] . '" ' . $selected . '>' . $rows["name"] . '</option>';
	}
}
?>