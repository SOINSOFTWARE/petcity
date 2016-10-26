<?php
include_once '../../php/pettype.php';

$petType = new PetTypeTable();
$results = $petType -> select($companyId);
while ($rows = mysqli_fetch_array($results)) {
	echo '<option value="' . $rows["id"] . '">' . $rows["name"] . '</option>';
}
?>