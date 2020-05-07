<?php
$champs = fopen("resources/champions.min.json", "r");
$json_champ = stream_get_contents($champs);
$data_champ = json_decode($json_champ, true);
fclose($champs);

$array = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'name'));  //Used to get ID => Name of champ
$arrayID = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'id'));
$icons = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'icon'));
