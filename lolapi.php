<?php
$apikey = 'RGAPI-7277cd71-fd36-42a1-8fab-ff8b5076a812';

$summonerID = fopen("https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/Juan99vh?api_key=RGAPI-7277cd71-fd36-42a1-8fab-ff8b5076a812", "r");
$json_lol = stream_get_contents($summonerID);
fclose($summonerID);

print $json_lol;
?>