<?php
include_once '../../php/foodbrand.php';

$foodbrandtable = new FoodBrandTable();
$results = $foodbrandtable -> select($companyId);
while ($rows = mysqli_fetch_array($results)) {
	if (isset($idfoodbrand) && $idfoodbrand == $rows["id"]) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	echo '<option value="' . $rows["id"] . '" ' . $selected . '>' . $rows["name"] . '</option>';
}
?>