<?php
	$requestFreeChamp = fopen("https://euw1.api.riotgames.com/lol/platform/v3/champion-rotations?api_key=$apikey", "r");			
	$json_freeChamps = stream_get_contents($requestFreeChamp); 
	$data_freeChamps = json_decode($json_freeChamps, true);
	fclose($requestFreeChamp);
?>