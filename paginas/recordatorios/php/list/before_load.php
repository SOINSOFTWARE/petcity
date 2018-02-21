<?php

include_once '../phpfragments/validations.php';
$notification = new NotificationTable();
$success_saved = NULL;
if (is_deleting_object()) {
    $id = filter_input(INPUT_POST, 'id_record');
    $success_saved = $notification->delete($id);
    $deleted = $success_saved;
} else if (filter_input(INPUT_POST, 'send') !== NULL) {
    $id = filter_input(INPUT_POST, 'id_record');
    $results = $notification->selectById($id);
    $rows = mysqli_fetch_array($results);
    if ($rows !== NULL) {
        $title = $rows['title'];
        $message = $rows['message'];
        $user_email = $rows['email'];
        $owner_full_name = $rows["ownername"] . ' ' . $rows["lastname"];
        $pet_name = $rows["petname"];
        $notification_date = format_string_date($rows['notificationdate'], "d/m/Y");
        $notification->sendMail($user_email, $company, $owner_full_name, $pet_name, $title, $message, $notification_date);
        $send = TRUE;
    }
}
if ($success_saved !== NULL && $success_saved === FALSE) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($notification->getError());
}