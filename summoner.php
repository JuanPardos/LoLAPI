<?php
ob_start("ob_gzhandler");
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link id="favicon" rel="shortcut icon" type="image/png" href="resources/icon.png">
	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/iziToast.min.css">
	<link rel="stylesheet" href="css/styles.min.css">
	<!-- JS -->
	<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
	<script src="js/iziToast.min.js" type="text/javascript"></script>
	<script>
		$(function() {
			$("[rel='tooltip']").tooltip(); //Enables tooltips
		});
	</script>
	<title>LOL Search</title>
</head>

<body class="summoner" id="bd">
	<?php error_reporting(0); ?>
	<div class="container-fluid">
		<?php
		require_once 'key.php';  			//Get the API Key from a .gitignored file (Hide from public).
		if ($apikey != $_SESSION['sapikey'] && $_SESSION['sapikey'] != null) {
			$apikey = $_SESSION['sapikey'];
		}
		require_once 'api/summonerapi.php';
		require_once 'api/champapi.php';

		print '
					<script type="text/javascript">
						$("#favicon").attr("href","http://ddragon.leagueoflegends.com/cdn/10.8.1/img/profileicon/' . $profileIcon . '.png");
						document.title = "' . $summonerDecoded . ' - ' . $serverAux . '";
					</script>
				';

		if ($data_lol == null) {
			print '
					<script type="text/javascript">
						window.stop();
						iziToast.warning({
						    title: "ERROR",
						    message: "Returning to main page",
						    timeout: 5000,
						    position: "topCenter",
						    onClosed: function () {window.location.href = "index.php";}
						});
						document.getElementById("bd").className="error";
					</script>
				';
		}

		print '<hr><h1 style="text-align:center; color:white">' . $summonerDecoded . '<img src="http://ddragon.leagueoflegends.com/cdn/10.8.1/img/profileicon/' . $profileIcon . '.png" heigth="64px" width="64px"></h1><hr>';

		print
			'
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1">
						<div class="table-responsive">
							<table class="table table-borderless table-sm table-striped" id="masteryTable">
								<thead class="thead-dark">
									<tr>
										<th colspan="5" class="center"><u>Champion Mastery</u></th>
									</tr>
			    					<tr>
			      						<th scope="col" class="center">#</th>
			     						<th scope="col" class="center">Champion</th>
			      						<th scope="col" class="center">Mastery Level</th>
			      						<th scope="col" class="center">Mastery Points</th>
			      						<th scope="col" class="center">Chest</th>
			    					</tr>
		  						</thead>
		  						<tbody>
			';

		for ($i = 0; $i < 20; ++$i) {
			print '<tr><td scope="row"  class="center">' . ($i + 1) . '</td>';
			print '<td class="center"><img src="resources/champion_icons/' . ucfirst($arrayID[$data_lol[$i]["championId"]]) . '.png" rel="tooltip" title="" width="40px" heigth="40px"><br>' . $array[$data_lol[$i]["championId"]] . '</td>';
			print '<td class="center"><img src="resources/mastery_emblems/' . $data_lol[$i]['championLevel'] . '.png" rel="tooltip" title="' . $data_lol[$i]['championLevel'] . '" width="60px" heigth="60px"></td>';
			print '<td class="center" style="vertical-align: middle">' . $data_lol[$i]['championPoints'] . '</td>';
			if ($data_lol[$i]['chestGranted'] == 1) {
				print '<td class="center" style="vertical-align: middle"><img src="resources/chest.png" width="50px" heigth="50px"></td></tr>';
			} else {
				print '<td class="center"></td></tr>';
			}
		}

		$win_rate = array((($data_ELO['0']['wins']) / ($data_ELO['0']['wins'] + $data_ELO['0']['losses']) * 100),
			(($data_ELO['1']['wins']) / ($data_ELO['1']['wins'] + $data_ELO['1']['losses']) * 100)
		);

		$win_rated = array(
			number_format((float) $win_rate['0'], 1, '.', ''),
			number_format((float) $win_rate['1'], 1, '.', '')
		);    //Shows only 2 decimal


		print '
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2">
						<div class="row">
							<div class="col-12">
								<div class="table-responsive">
									<table class="table table-sm table-striped table-borderless" id="eloTable">
										<thead class="thead-dark">
											<tr>
												<th colspan="7" class="center"><u>Ranked Stats</u></th>
											</tr>
											<tr>
												<th scope="col" class="center">Queue</th>
					      						<th scope="col" class="center">Tier</th>
					     						<th scope="col" class="center">Rank</th>
					      						<th scope="col" class="center">League Points</th>
					      						<th scope="col" class="center">Wins</th>
					      						<th scope="col" class="center">Loses</th>
												<th scope="col" class="center">Win Ratio</th>
					    					</tr>
										</thead>
										<tbody>
			';

		if ($data_ELO == null) {
			print '
					<tr><td colspan="7" class="center">--NOT ENOUGH RANKED GAMES--</td></tr>
				';
		}

		for ($i = 0; $i < count($data_ELO); ++$i) {
			if ($data_ELO[$i]['queueType'] == 'RANKED_SOLO_5x5') {
				print '
						<tr id="elotr">
							<td class="center">Solo Queue</td>
					';
			} else {
				print '
						<tr id="elotr">
							<td class="center">Flex</td>
					';
			}
			print '
						<td class="center">
							<img src="resources/ranked_emblems/' . $data_ELO[$i]['tier'] . '.png" width="60" heigth="60"><b>' . $data_ELO[$i]['tier'] . '</b>
						</td>
						<td class="center"><b>' . $data_ELO[$i]['rank'] . '</b></td>
						<td class="center"><b>' . $data_ELO[$i]['leaguePoints'] . '</b></td>
						<td class="center" style="color:green">' . $data_ELO[$i]['wins'] . '</td>
						<td class="center" style="color:red">' . $data_ELO[$i]['losses'] . '</td>
						<td class="center" style="color:blue">' . $win_rated[$i] . '%</td>
					<tr>
				';
		}

		print '						
										</tbody>
									</table>
								</div>
							</div> 
						</div> 
						<div class="col-12">
							<div class="table-responsive">
									<table class="table table-sm table-borderless" id="matchesTable">
										<thead class="thead-dark">
											<tr>
												<th colspan="5" class="center"><u>Match History</u></th>
											</tr>
											<tr>
												<th scope="col" class="center">Result</th>
												<th scope="col" class="center">K/D/A</th>
												<th scope="col" class="center">Duration</th>
												<th scope="col" class="center">Champion</th>	
												<th scope="col" class="center">Position</th>			 					    
											</tr>
										</thead>
										<tbody>
			';

		if ($data_match == null) {
			print '
					<tr><td colspan="7" class="center">--NOT ENOUGH GAMES--</td></tr>
				';
		}

		for ($i = 0; $i < count($arrayMatches); ++$i) {
			$duration = $data_match[$i]['gameDuration'] / 60;
			$duration¡ = number_format((float) $duration, 0, '.', '');
			if ($data_match[$i]['gameDuration'] < 360) {  //If game length <6 min probably its a remake. Riot API classifies remake as victory.
				print '
						<tr id="matchtr" style="background-color:grey">
							<td class="center"><a href="match.php?matchId=' . $arrayMatches[$i] . '"><b> REMAKE </b></a></td>
					';
			} else {
				if ($data_match[$i]['participants'][$id[$i]]['stats']['win'] == 'true') {
					print '
						<tr id="matchtr" style="background-color:#4eef21">
							<td class="center"><a href="match.php?matchId=' . $arrayMatches[$i] . '"><b> VICTORY </b></a></td>
					';
				} else {
					print '
						<tr id="matchtr" style="background-color:#FF3535">
							<td class="center"><a href="match.php?matchId=' . $arrayMatches[$i] . '"><b> DEFEAT </b></a></td>
					';
				}
			}
			print '	
							<td class="center">' . $data_match[$i]['participants'][$id[$i]]['stats']['kills'] . '/' . $data_match[$i]['participants'][$id[$i]]['stats']['deaths'] . '/' . $data_match[$i]['participants'][$id[$i]]['stats']['assists'] . '</td>
							<td class="center">' . $duration¡ . '&apos;</td>
							<td class="center">' . $array[$arrayChamps[$i]] . '</td>
							<td class="center">' . $arrayLanes[$i] . '</td>
						<tr>
					';
		}

		print '						
										</tbody>
									</table>
								</div>
						</div>
			';
		if ($server == 'euw1') {
			print '
					<div id="opgg" class="col-12">					
						<a href="https://euw.op.gg/summoner/userName=' . $summonerDecoded . '" target="_blank"><img src="resources/opgg.png" rel="tooltip" data-placement="bottom" title="Search summoner on OPGG"></a> 
					</div>
				';
		}
		if ($server == 'na1') {
			print '
					<div id="opgg" class="col-12">					
						<a href="https://na.op.gg/summoner/userName=' . $summonerDecoded . '" target="_blank"><img src="resources/opgg.png" rel="tooltip" data-placement="bottom" title="Search summoner on OPGG"></a> 
					</div>
				';
		}
		if ($server == 'la1') {
			print '
					<div id="opgg" class="col-12">					
						<a href="https://lan.op.gg/summoner/userName=' . $summonerDecoded . '" target="_blank"><img src="resources/opgg.png" rel="tooltip" data-placement="bottom" title="Search summoner on OPGG"></a> 
					</div>
				';
		}
		if ($server == 'oc1') {
			print '
					<div id="opgg" class="col-12">					
						<a href="https://oce.op.gg/summoner/userName=' . $summonerDecoded . '" target="_blank"><img src="resources/opgg.png" rel="tooltip" data-placement="bottom" title="Search summoner on OPGG"></a>
					</div>
				';
		}
		print '
					</div>
				</div>

				<br><a href="../..">Return to main menu</a>
			';
		?>
	</div>
</body>

</html>
<?php
ob_end_flush();
?>