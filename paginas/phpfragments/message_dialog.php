<?php

function show_success_message($message) {
    show_message('Datos guardados!', $message, 'fa fa-check');
}
function show_error_message($message) {
    show_message('Error!', $message, 'fa fa-times');
}
function show_message($title, $message, $button_img) {
    echo '<div class="alert alert-success alert-dismissable">';
    echo '<i class="';
    echo $button_img;
    echo '"></i>';
    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>';
    echo '<b>';
    echo $title;
    echo '</b> ';
    echo $message;
    echo '</div>';
}
function load_prompt_dialog($div_id, $title, $message) {
    echo '<div id="';
    echo $div_id;
    echo '" title="';
    echo $title;
    echo '" style="display: none">';
    echo '<p>';
    echo '<span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>';
    echo $message;
    echo '</p>';
    echo '</div>';
}