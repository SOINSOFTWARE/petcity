<?php

$idgeneraldata = filter_input(INPUT_POST, 'idgeneraldata');
$generaldatadate = filter_input(INPUT_POST, 'generaldatadate');
$heartrate = filter_input(INPUT_POST, 'heartrate');
$breathingfrequency = filter_input(INPUT_POST, 'breathingfrequency');
$temperature = filter_input(INPUT_POST, 'temperature');
$heartbeat = filter_input(INPUT_POST, 'heartbeat');
$corporalcondition = filter_input(INPUT_POST, 'corporalcondition');
$linfonodulos = filter_input(INPUT_POST, 'linfonodulos');
$mucous = filter_input(INPUT_POST, 'mucous');
$trc = filter_input(INPUT_POST, 'trc');
$dh = filter_input(INPUT_POST, 'dh');
$weight = filter_input(INPUT_POST, 'weight');
$mood = filter_input(INPUT_POST, 'mood');
$tusigo = filter_input(INPUT_POST, 'tusigo');
$anamnesis = filter_input(INPUT_POST, 'anamnesis');
$findings = filter_input(INPUT_POST, 'findings');
$clinicaltreatment = filter_input(INPUT_POST, 'clinicaltreatment');
$formulanumber = (filter_input(INPUT_POST, 'formulanumber') !== NULL && filter_input(INPUT_POST, 'formulanumber') !== '') ? filter_input(INPUT_POST, 'formulanumber') : 0;
$formula = filter_input(INPUT_POST, 'formula');
$recomendations = filter_input(INPUT_POST, 'recomendations');
$observations = filter_input(INPUT_POST, 'observations');

$general_data = new GeneralData($idgeneraldata, $generaldatadate, $heartrate, $breathingfrequency, $temperature, $heartbeat, $corporalcondition, $linfonodulos, $mucous, $trc, $dh, $weight, $mood, $tusigo, $anamnesis, $findings, $clinicaltreatment, $formulanumber, $formula, $recomendations, $observations, $companyId);

function saveGeneralData($general_data, $general_data_table) {
    if ($general_data->id === 0) {
        $saved = $general_data_table->insertObject($general_data);
        if ($saved) {
            $id_general_data = $general_data_table->selectLastInsertId();
            $general_data->id = $id_general_data;
        }
    } else {
        $saved = $general_data_table->updateObject($general_data);
    }
    if (!$saved) {
        throw new Exception();
    }
    return $general_data;
}
