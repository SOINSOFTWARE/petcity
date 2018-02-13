<?php
function format_string_date($date_as_string, $to_format) {
    if ($date_as_string != null && $date_as_string != '') {
        $dateobj = DateTime::createFromFormat("Y-m-d H:i:s", $date_as_string);
        return $dateobj->format($to_format);
    } else {
        return '';
    }
}