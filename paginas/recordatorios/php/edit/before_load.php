<?php

include_once '../phpfragments/validations.php';
$notification = new NotificationTable();
$success_saved = NULL;
$notification_date = date('d/m/Y');
if (is_creating_new_object() || is_updating_object()) {
    $id = filter_input(INPUT_POST, 'id_record');
    $id_pet = filter_input(INPUT_POST, 'id_pet');
    $pet_name = filter_input(INPUT_POST, 'pet_name');
    $owner_full_name = filter_input(INPUT_POST, 'owner_full_name');
    $title = filter_input(INPUT_POST, 'title');
    $message = filter_input(INPUT_POST, 'message');
    $notification_date = filter_input(INPUT_POST, 'notification_date');
    $complete_notification_date = $notification_date . "00:00:00";
    try {
        $dateobj = DateTime::createFromFormat("d/m/Y H:i:s", $complete_notification_date);
        $notificationdateToSQL = $dateobj->format("Y-m-d");
        if (is_creating_new_object()) {
            $success_saved = $notification->insert($title, $message, $notificationdateToSQL, $id_pet);
            $saved = $success_saved;
            if ($saved === TRUE) {
                $id = $notification->selectLastInsertId();
            }
        } else {
            $success_saved = $notification->update($id, $title, $message, $notificationdateToSQL);
            $updated = $success_saved;
        }
    } catch (Exception $ex) {
        $saved = FALSE;
    }
}
if ($success_saved !== NULL && $success_saved === FALSE) {
    $errorLog = new ErrorLogTable();
    $errorLog->insert($notification->getError());
}