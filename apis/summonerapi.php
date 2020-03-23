<?php
	session_start();
	$summoner = $_GET['summoner']; 			//Get summoner name from index.
	$_SESSION['Summoner'] = $summoner;
	$server = $_GET['server'];				//Get server name.
	$_SESSION['Server'] = $server;
	
	$aux = $_POST['aux'];
	$_SESSION['Fav'] = $aux;
	
	if(is_array($_SESSION['favs']) == false){
		$_SESSION['favs'] = [];
	}
	
	if(is_array($_SESSION['ArrayServers']) == false){
		$_SESSION['ArrayServers'] = [];
	}

	$requestSummoner = fopen("https://$server.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summoner?api_key=$apikey", "r");		//Request to get encrypted summonerID.			
	$json_summoner = stream_get_contents($requestSummoner); 
	$data_summoner = json_decode($json_summoner, true); 		//Formats the Json for PHP.
	$encryptSummoner = $data_summoner['id']; 		//Encrypted SummonerId
	fclose($requestSummoner);		//Close connection to file.
	
	$request = fopen("https://$server.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$encryptSummoner?api_key=$apikey", "r");  //Request of Mastery.
	$json_lol = stream_get_contents($request);
	$data_lol = json_decode($json_lol, true);
	fclose($request);
	
	$requestELO = fopen("https://$server.api.riotgames.com/lol/league/v4/entries/by-summoner/$encryptSummoner?api_key=$apikey" , "r");
	$json_ELO = stream_get_contents($requestELO);
	$data_ELO = json_decode($json_ELO, true);
	fclose($requestELO);
	
?>