<?php

include_once '../../php/reproduction.php';
$reproduction = new ReproductionTable();
$results = $reproduction->select($companyId);
while ($rows = mysqli_fetch_array($results)) {
    if (isset($id_reproduction) && $id_reproduction == $rows["id"]) {
        $selected = "selected";
    } else {
        $selected = "";
    }
    echo '<option value="' . $rows["id"] . '" ' . $selected . '>' . $rows["name"] . '</option>';
}
?>