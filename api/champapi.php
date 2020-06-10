<?php
$champs = fopen("resources/champions.min.json", "r"); //Champion data (Local, may be outdated)
$json_champ = stream_get_contents($champs);
$data_champ = json_decode($json_champ, true);
fclose($champs);

$array = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'name'));  //Creates an array with Key => Name
$arrayID = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'id'));    // ID ~= Name
$icons = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'icon'));
