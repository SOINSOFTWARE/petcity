<?php
$results = $notification->selectByIdCompany($companyId);
while ($rows = mysqli_fetch_array($results)) {
    echo "<tr>";
    echo '<td>' . $rows["title"] . '</td>';
    echo '<td>' . $rows["message"] . '</td>';
    echo '<td>' . $rows["petname"] . '</td>';
    echo '<td>' . $rows["ownername"] . ' ' . $rows["lastname"] . '</td>';
    echo '<td>' . $rows["phone2"] . '</td>';    
    echo '<td style="text-align:center"><form action="editar.php" method="post" role="form"><input type="hidden" id="id_record" name="id_record" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
    echo '<td style="text-align:center"><form action="listado.php" method="post" role="form"><input type="hidden" id="id_record" name="id_record" value="' . $rows["id"] . '" /><button type="submit" id="send" name="send" class="btn btn-success"><i class="fa fa-envelope"></i></button></form></td>';
    echo '<td style="text-align:center"><form action="listado.php" method="post" role="form"><input type="hidden" id="id_record" name="id_record" value="' . $rows["id"] . '" /><button type="submit" id="delete" name="delete" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
    echo "</tr>";
}