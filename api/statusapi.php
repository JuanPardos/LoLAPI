<?php
$server = array("euw1", "na1", "la1", "oc1");

$serverNames = array("EUW", "NA", "LAN", "OCE");
$perfect = '<a href="https://status.riotgames.com/?locale=en_GB&product=leagueoflegends"><img src="../resources/green-circle.png" rel="tooltip" data-placement="right" title="0 issues" width="20px" height="20px"></a>';
$ok = '<a href="https://status.riotgames.com/?locale=en_GB&product=leagueoflegends"><img src="../resources/orange-circle.png" rel="tooltip" data-placement="right" title="Atleast 1 issue" width="20px" height="20px"></a>';
$offline = '<a href="https://status.riotgames.com/?locale=en_GB&product=leagueoflegends"><img src="../resources/red-circle.png" rel="tooltip" data-placement="right" title="Server OFFLINE" width="20px" height="20px"></a>';

//YEP, HAS TO BE A WAY TO REDUCE ALL THAT CODE ;(

$status1 = fopen("https://euw1.api.riotgames.com/lol/status/v3/shard-data?api_key=$apikey", "r");
$status2 = fopen("https://na1.api.riotgames.com/lol/status/v3/shard-data?api_key=$apikey", "r");
$status3 = fopen("https://la1.api.riotgames.com/lol/status/v3/shard-data?api_key=$apikey", "r");
$status4 = fopen("https://oc1.api.riotgames.com/lol/status/v3/shard-data?api_key=$apikey", "r");

$json_status1 = stream_get_contents($status1);
$json_status2 = stream_get_contents($status2);
$json_status3 = stream_get_contents($status3);
$json_status4 = stream_get_contents($status4);

$data_status1 = json_decode($json_status1, true);
$data_status2 = json_decode($json_status2, true);
$data_status3 = json_decode($json_status3, true);
$data_status4 = json_decode($json_status4, true);

fclose($status1);
fclose($status2);
fclose($status3);
fclose($status4);

//YEP, I KNOW I CAN DO THIS ONE BETTER								

$online1 = array_column($data_status1['services'], 'status')['0'];      //Online/offline
$incidents1 = array_column($data_status1['services'], 'incidents')['0'];     //Incidents
$online2 = array_column($data_status2['services'], 'status')['0'];
$incidents2 = array_column($data_status2['services'], 'incidents')['0'];
$online3 = array_column($data_status3['services'], 'status')['0'];
$incidents3 = array_column($data_status3['services'], 'incidents')['0'];
$online4 = array_column($data_status4['services'], 'status')['0'];
$incidents4 = array_column($data_status4['services'], 'incidents')['0'];

$auxon = array($online1, $online2, $online3, $online4);
$auxst = array($incidents1, $incidents2, $incidents3, $incidents4);
