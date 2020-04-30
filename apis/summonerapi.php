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
	$encryptSummoner = $data_summoner['id']; 		//Encrypted SummonerId.
	
	$AccEncryptID = $data_summoner['accountId'];   //Encrypted acc id for matches.
	$profileIcon = $data_summoner['profileIconId']; //Profile Icon.
	
	fclose($requestSummoner);		//Close connection to file.
	
	if($server == 'euw1'){
		$serverAux = 'EUW';
	}
	if($server == 'na1'){
		$serverAux = 'NA';
	}
	if($server == 'la1'){
		$serverAux = 'LAN';
	}
	if($server == 'oc1'){
		$serverAux = 'OCE';
	}


	$request = fopen("https://$server.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$encryptSummoner?api_key=$apikey", "r");  //Request of Mastery.
	$json_lol = stream_get_contents($request);
	$data_lol = json_decode($json_lol, true);
	fclose($request);
	
	$requestELO = fopen("https://$server.api.riotgames.com/lol/league/v4/entries/by-summoner/$encryptSummoner?api_key=$apikey" , "r");
	$json_ELO = stream_get_contents($requestELO);
	$data_ELO = json_decode($json_ELO, true);
	fclose($requestELO);
	
	$requestMatches = fopen("https://$server.api.riotgames.com/lol/match/v4/matchlists/by-account/$AccEncryptID?api_key=$apikey" , "r"); //Matches
	$json_matches = stream_get_contents($requestMatches);
	$data_matches = json_decode($json_matches, true);  // <------
	fclose($requestMatches);
	
	$arrayMatches = [];
	$arrayChamps = [];
	$arrayLanes = [];
	for($i = 0; $i < 10; ++$i){
		array_push($arrayMatches, $data_matches['matches'][$i]['gameId']); 
		array_push($arrayChamps, $data_matches['matches'][$i]['champion']);
		array_push($arrayLanes, $data_matches['matches'][$i]['lane']);  
	}
	
	$requestMatch = [];
	$json_match = [];
	$data_match = [];
	
	for($i = 0; $i < count($arrayMatches); ++$i){
		array_push($requestMatch, fopen("https://$server.api.riotgames.com/lol/match/v4/matches/$arrayMatches[$i]?api_key=$apikey" , "r"));
		array_push($json_match, stream_get_contents($requestMatch[$i]));
		array_push($data_match, json_decode($json_match[$i], true));
		fclose($requestMatch[$i]);
	}
	
	$id = [];
	
	for($i = 0; $i < 10; ++$i){
		for($j = 0; $j < 10; ++$j){
			if($data_match[$i]['participantIdentities'][$j]['player']['summonerName'] == $summoner){
				array_push($id, $data_match[$i]['participantIdentities'][$j]['participantId']);
			}
		}
	}
