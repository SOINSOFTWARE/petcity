<?php
$results = $notification->selectByIdCompany($companyId, $notification_date_SQL);
while ($rows = mysqli_fetch_array($results)) {
    $title = $rows['title'];
    $message = $rows['message'];
    $user_email = $rows['email'];
    $owner_full_name = $rows["ownername"] . ' ' . $rows["lastname"];
    $pet_name = $rows["petname"];
    echo "<tr>";
    echo '<td>' . $title . '</td>';
    echo '<td>' . $message . '</td>';
    echo '<td>' . $pet_name . '</td>';
    echo '<td>' . $owner_full_name . '</td>';
    echo '<td>' . $rows["phone2"] . '</td>';    
    echo '<td style="text-align:center"><form action="editar.php" method="post" role="form"><input type="hidden" id="id_record" name="id_record" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
    echo '<td style="text-align:center"><form action="listado.php" method="post" role="form"><input type="hidden" id="id_record" name="id_record" value="' . $rows["id"] . '" /><button type="submit" id="send" name="send" class="btn btn-success"><i class="fa fa-envelope"></i></button></form></td>';
    echo '<td style="text-align:center"><form action="listado.php" method="post" role="form"><input type="hidden" id="id_record" name="id_record" value="' . $rows["id"] . '" /><button type="submit" id="delete" name="delete" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
    echo "</tr>";
    if (filter_input(INPUT_POST, 'send-all') !== NULL) {
        $notification_date_to_send = format_string_date($rows['notificationdate'], "d/m/Y");
        $notification->sendMail($user_email, $company, $owner_full_name, $pet_name, $title, $message, $notification_date_to_send);
    }
}