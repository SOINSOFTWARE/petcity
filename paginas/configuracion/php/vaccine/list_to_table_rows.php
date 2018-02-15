<?php

$results = $vaccine->select($companyId);
while ($rows = mysqli_fetch_array($results)) {
    echo "<tr>";
    if (is_null($rows["idcompany"])) {
        echo "<td></td><td></td>";
    } else {
        echo '<td>';
        echo '<form action="vacuna.php" method="post" role="form">';
        echo '<input type="hidden" id="idrecord" name="idrecord" value="' . $rows["id"] . '" />';
        echo '<div class="input-group input-group-sm">';
        echo '<input type="text" class="form-control" id="updatedname" name="updatedname" maxlength="60" value="' . $rows["name"] . '" required />';
        echo '<span class="input-group-btn">';
        echo '<button type="submit" id="update" name="update" class="btn btn-success">';
        echo '<i class="fa fa-edit"></i>';
        echo '</button>';
        echo '</span>';
        echo '</div>';
        echo '</form>';
        echo '</td>';
        echo '<td style="text-align:center">';
        echo '<form action="vacuna.php" method="post" role="form">';
        echo '<input type="hidden" id="idrecord" name="idrecord" value="' . $rows["id"] . '" />';
        echo '<button type="submit" id="delete" name="delete" class="btn btn-danger">';
        echo '<i class="fa fa-times"></i>';
        echo '</button>';
        echo '</form>';
        echo '</td>';
    }
    echo "</tr>";
}