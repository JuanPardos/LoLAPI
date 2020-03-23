<?php
	$champs = fopen("resources/champions.json", "r");
	$json_champ = stream_get_contents($champs);
	$data_champ = json_decode($json_champ, true);
	fclose($champs);
?>