<?php

if (isset($id_clinic_history) && $id_clinic_history > 0) {
    echo '<form action="historia.php" method="post" role="form">';
    echo '<input type="hidden" id="idclinichistory" name="idclinichistory" value="';
    echo get_numeric_value($id_clinic_history);
    echo '" />';
    echo '<button type="submit" id="backward" name="backward" class="btn btn-success">';
    echo '<i class="fa fa-reply"></i> Historia';
    echo '</button>';
    echo '</form>';
}