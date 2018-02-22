<?php

include_once '../phpfragments/validations.php';
$notification = new NotificationTable();
$success_saved = NULL;
$notification_date = date('d/m/Y');
$id_pet = 0;
$id = 0;
if (is_creating_new_object() || is_updating_object()) {
    $id = filter_input(INPUT_POST, 'id_record');
    $id_pet = filter_input(INPUT_POST, 'id_pet');
    $pet_name = filter_input(INPUT_POST, 'pet_name');
    $owner_full_name = filter_input(INPUT_POST, 'owner_full_name');
    $title = filter_input(INPUT_POST, 'title');
    $message = filter_input(INPUT_POST, 'message');
    if ($id_pet !== 0 && $title != '' && $message != '') {
        try {
            $notification_date = filter_input(INPUT_POST, 'notification_date');
            $complete_notification_date = $notification_date . " 00:00:00";
            $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $complete_notification_date);
            $notification_date_SQL = $dateobj->format("Y-m-d");
            if (is_creating_new_object()) {
                $success_saved = $notification->insert($title, $message, $notification_date_SQL, $id_pet);
                $saved = $success_saved;
                if ($saved === TRUE) {
                    $id = $notification->selectLastInsertId();
                }
            } else {
                $success_saved = $notification->update($id, $title, $message, $notification_date_SQL);
                $updated = $success_saved;
            }
        } catch (Exception $ex) {
            $saved = FALSE;
        }
    }
} else if (filter_input(INPUT_POST, 'view') !== NULL) {
    $id = filter_input(INPUT_POST, 'id_record');
    $results = $notification->selectById($id);
    $rows = mysqli_fetch_array($results);
    if ($rows !== NULL) {
        $id_pet = $rows['idpet'];
        $pet_name = $rows["petname"];
        $owner_full_name = $rows["ownername"] . ' ' . $rows["lastname"];
        $title = $rows['title'];
        $message = $rows['message'];
        $notification_date = format_string_date($rows['notificationdate'], "d/m/Y");
    }
}
if ($success_saved !== NULL && $success_saved === FALSE) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($notification->getError());
}