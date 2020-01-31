<?php
	session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap, IziToast and CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/iziToast.min.css">
    
    <!-- Javascript -->
    <script src="js/iziToast.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
    <title>LOL Search</title>
  </head>
  <body class="summoner" id="modal">
  <?php	error_reporting(0);?>
  	<div class="container-fluid">		<!-- TODO: Player Ranked, Match History -->
			    <?php
			    	require_once 'key.php';  			//Get the API Key from a .gitignored file (Hide from public).
			    	if($apikey != $_SESSION['sapikey'] && $_SESSION['sapikey'] != null){
						$apikey = $_SESSION['sapikey'];
					}
			    	require_once 'apis/summonerapi.php';
			    	require_once 'apis/champapi.php';
			    	
					$array = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'name'));  //Used to get ID => Name of champ
					$icons = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'icon'));

					if($data_lol == null){
						print '
							<script type="text/javascript">
								window.stop();
								iziToast.error({
								    title: "ERROR",
								    message: "Invalid summoner name or API key",
								    timeout: 3000,
								    position: "topCenter",
								    onClosed: function () {window.location.href = "index.php";}
								});
							</script>
						';
					}
					
					print'<hr><h1 style="text-align:center">'.$summoner.'</h1><hr>';			
					
					print 
					'
						<div class="row">
							<div class="col-6">
								<div class="table-responsive">
									<table class="table table-borderless table-sm table-striped" id="masteryTable" style="border: 1px solid black">
										<thead class="thead-dark">
					    					<tr>
					      						<th scope="col" class="center">#</th>
					     						<th scope="col" class="center">Champion</th>
					      						<th scope="col" class="center">Mastery Level</th>
					      						<th scope="col" class="center">Mastery Points</th>
					    					</tr>
				  						</thead>
				  						<tbody>
  					';	
  						
					for($i = 0; $i < 20; ++$i) {
						print '<tr id="mtr"><th scope="row"  class="center">' .($i + 1). '</th>';
			    		print '<td class="center"><img src="'.$icons[$data_lol[$i]["championId"]].'" width="40px" heigth="40px"><br>' .$array[$data_lol[$i]["championId"]]. '</td>';
			    		print '<td class="center">' .$data_lol[$i]['championLevel']. '</td>';
			    		print '<td class="center">' .$data_lol[$i]['championPoints']. '</td></tr>';
					}
					
						$win_rate = array((($data_ELO['0']['wins']) / ($data_ELO['0']['wins'] + $data_ELO['0']['losses'])*100),
							(($data_ELO['1']['wins']) / ($data_ELO['1']['wins'] + $data_ELO['1']['losses'])*100));
							
						$win_rated = array(number_format((float)$win_rate['0'], 1, '.', ''), 
							number_format((float)$win_rate['1'], 1, '.', ''));    //Shows only 2 decimal
						
					
					print '
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-12">
										<div class="table-responsive">
											<table class="table table-sm table-striped" id="eloTable" style="border: 1px solid black">
												<thead class="thead-dark">
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
					
					if($data_ELO == null){
						print'
							<tr><td colspan="7" class="center">--NOT ENOUGH RANKED GAMES--</td></tr>
						';
					}
					
					for($i = 0; $i < count($data_ELO); ++$i){
						print'
							<tr id="elotr">
								<td class="center">' .$data_ELO[$i]['queueType']. '</td>
								<td class="center">
									<img src="resources/ranked_emblems/'.$data_ELO[$i]['tier'].'.png" width="50" heigth="50">' .$data_ELO[$i]['tier']. '
								</td>
								<td class="center">' .$data_ELO[$i]['rank']. '</td>
								<td class="center">' .$data_ELO[$i]['leaguePoints']. '</td>
								<td class="center">' .$data_ELO[$i]['wins']. '</td>
								<td class="center">' .$data_ELO[$i]['losses']. '</td>
								<td class="center">' .$win_rated[$i]. '%</td>
							<tr>
						';
					}
								    		
					print'						
												</tbody>
											</table>
										</div>
									</div> 
								</div> 
								<div class="col-12">
									<div><a>PLACEHOLDER FOR MATCHES</a></div>
								</div>
							</div>
						</div>

						<br><a href="index.php">Return to main menu</a>
					';	
				?>
			</div>	
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
