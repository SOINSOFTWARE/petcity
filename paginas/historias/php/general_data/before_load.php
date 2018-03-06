<?php

$idgeneraldata = filter_input(INPUT_POST, 'idgeneraldata');
$idpet = filter_input(INPUT_POST, 'idpet');
$generaldatadate = filter_input(INPUT_POST, 'generaldatadate');
$weight = filter_input(INPUT_POST, 'weight');
$corporalcondition = filter_input(INPUT_POST, 'corporalcondition');
$heartrate = filter_input(INPUT_POST, 'heartrate');
$breathingfrequency = filter_input(INPUT_POST, 'breathingfrequency');
$temperature = filter_input(INPUT_POST, 'temperature');
$heartbeat = filter_input(INPUT_POST, 'heartbeat');
$linfonodulos = filter_input(INPUT_POST, 'linfonodulos');
$mucous = filter_input(INPUT_POST, 'mucous');
$trc = filter_input(INPUT_POST, 'trc');
$dh = filter_input(INPUT_POST, 'dh');
$mood = filter_input(INPUT_POST, 'mood');
$tusigo = filter_input(INPUT_POST, 'tusigo');
$anamnesis = filter_input(INPUT_POST, 'anamnesis');
$findings = filter_input(INPUT_POST, 'findings');
$clinicaltreatment = filter_input(INPUT_POST, 'clinicaltreatment');
$formulanumber = (filter_input(INPUT_POST, 'formulanumber') !== NULL && filter_input(INPUT_POST, 'formulanumber') !== '') ? filter_input(INPUT_POST, 'formulanumber') : 0;
$formula = filter_input(INPUT_POST, 'formula');
$recomendations = filter_input(INPUT_POST, 'recomendations');
$observations = filter_input(INPUT_POST, 'observations');

