<?php
session_start();
$summoner = rawurlencode($_GET['summoner']);  //Get summoner from Index. Encode fix special characters in name.
$summonerDecoded = rawurldecode($summoner);  //Some requests still need decoded name.

if ($_GET['server'] != null) {
	$server = $_GET['server'];
	$_SESSION['Server'] = $server;
}

if ($_GET['summoner'] != null) {
	$_SESSION['Summoner'] = $summoner;
	$_SESSION['SummonerDecoded'] = $summonerDecoded;
}

if (is_array($_SESSION['favs']) == false) {  //Creates the fav session array if empty
	$_SESSION['favs'] = [];
}

if (is_array($_SESSION['ArrayServers']) == false) {  //Same for servers
	$_SESSION['ArrayServers'] = [];
}

$requestSummoner = fopen("https://$server.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summoner?api_key=$apikey", "r");		//Request to get encrypted summonerID.			
$json_summoner = stream_get_contents($requestSummoner);
$data_summoner = json_decode($json_summoner, true); 		//Formats the Json for PHP.
$encryptSummoner = $data_summoner['id']; 		//Encrypted SummonerId.

$AccEncryptID = $data_summoner['accountId'];   //Encrypted acc id, used in matches requests.
$profileIcon = $data_summoner['profileIconId']; 	//Profile Icon.

fclose($requestSummoner);		//Close connection to file.


$request = fopen("https://$server.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$encryptSummoner?api_key=$apikey", "r");  //Mastery points request.
$json_lol = stream_get_contents($request);
$data_lol = json_decode($json_lol, true);
fclose($request);

$requestELO = fopen("https://$server.api.riotgames.com/lol/league/v4/entries/by-summoner/$encryptSummoner?api_key=$apikey", "r");  //Elo request
$json_ELO = stream_get_contents($requestELO);
$data_ELO = json_decode($json_ELO, true);
fclose($requestELO);

$requestMatches = fopen("https://$server.api.riotgames.com/lol/match/v4/matchlists/by-account/$AccEncryptID?api_key=$apikey", "r"); //Matches
$json_matches = stream_get_contents($requestMatches);
$data_matches = json_decode($json_matches, true);  // <------
fclose($requestMatches);

$arrayMatches = [];
$arrayChamps = [];
$arrayLanes = [];

for ($i = 0; $i < 8; ++$i) { //Search for last 8 matches. Page loading times heavily depends of that number.
	array_push($arrayMatches, $data_matches['matches'][$i]['gameId']);   //Push into the array of matches the gameID.
	array_push($arrayChamps, $data_matches['matches'][$i]['champion']);		//Same with champion...
	array_push($arrayLanes, $data_matches['matches'][$i]['lane']);
}

$requestMatch = [];
$json_match = [];
$data_match = [];
 
for ($i = 0; $i < count($arrayMatches); ++$i) {    //Request data for every match. 
	array_push($requestMatch, fopen("https://$server.api.riotgames.com/lol/match/v4/matches/$arrayMatches[$i]?api_key=$apikey", "r"));
	array_push($json_match, stream_get_contents($requestMatch[$i]));
	array_push($data_match, json_decode($json_match[$i], true));
	fclose($requestMatch[$i]);
}

$id = [];

for ($i = 0; $i < count($arrayMatches); ++$i) {
	for ($j = 0; $j < 10; ++$j) {
		if ($data_match[$i]['participantIdentities'][$j]['player']['summonerName'] == $summonerDecoded) {  //Player id (different in each game from 0 to 9).
			array_push($id, $j);
		}
	}
}

if ($server == 'euw1') {   //Technical names to typical.
	$serverAux = 'EUW';
}
if ($server == 'na1') {
	$serverAux = 'NA';
}
if ($server == 'la1') {
	$serverAux = 'LAN';
}
if ($server == 'oc1') {
	$serverAux = 'OCE';
}
