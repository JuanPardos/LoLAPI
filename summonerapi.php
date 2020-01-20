<?php
	$summoner = $_GET['summoner']; 			//Get summoner name from index.
	$server = $_GET['server'];				//Get server name.
	
	$requestSummoner = fopen("https://$server.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summoner?api_key=$apikey", "r");		//Request to get encrypted summonerID.			
	$json_summoner = stream_get_contents($requestSummoner); 
	$data_summoner = json_decode($json_summoner, true); 		//Formats the Json for PHP.
	$encryptSummoner = $data_summoner['id']; 		//Encrypted SummonerId
	fclose($requestSummoner);		//Close connection to file.
	
	$request = fopen("https://$server.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$encryptSummoner?api_key=$apikey", "r");  //Request of Mastery.
	$json_lol = stream_get_contents($request);
	$data_lol = json_decode($json_lol, true);
	fclose($request);
	
?>