<?php
$server = $_SESSION['Server'];

$matchID = $_GET['matchId'];
$data_matchi = fopen("https://$server.api.riotgames.com/lol/match/v4/matches/$matchID?api_key=$apikey", "r");
$json_data = stream_get_contents($data_matchi);
$data_match2 = json_decode($json_data, true);
fclose($data_matchi);
