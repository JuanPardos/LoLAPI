<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    
    <!-- Javascript -->
	<script type="text/javascript" src="script.js"></script>
    <title>LOL Search</title>
  </head>
  <body>
  <?php	error_reporting(0);?>
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-6">
			    <?php
			    	require_once 'apikey.php';  //Used to mask the API Key in a .gitignored file. 
					$summoner = $_GET['summoner'];
															
					$requestSummoner = fopen("https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summoner?api_key=$apikey", "r");					
					$json_summoner = stream_get_contents($requestSummoner);
					$data_summoner = json_decode($json_summoner, true);
					$encryptSummoner = $data_summoner['id'];
					
					$request = fopen("https://euw1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$encryptSummoner?api_key=$apikey", "r");
					$champs = fopen("https://ddragon.leagueoflegends.com/cdn/10.1.1/data/en_US/champion.json","r");
					
					
					$json_lol = stream_get_contents($request);
					$json_champs = stream_get_contents($champs);
					
					fclose($requestSummoner);
					fclose($request);
					fclose($champs);
				

					$data_lol = json_decode($json_lol, true);
					$data_champs = json_decode($json_champs, true);
						
					print'<h1>Mastery levels of '.$summoner.'</h1>';					
		
					print 
					'
						<table class="table" style="border: 1px solid black">
							<thead class="thead-dark">
		    					<tr>
		      						<th scope="col" style="text-align:center">#</th>
		     						<th scope="col" style="text-align:center">Champion ID</th>
		      						<th scope="col" style="text-align:center">Mastery Level</th>
		      						<th scope="col" style="text-align:center">Champion Points</th>
		    					</tr>
	  						</thead>
	  						<tbody>
  					';	
  						
					for($i = 0; $i < count($data_lol); ++$i) {
						print '<tr><th scope="row" style="text-align:center">' .($i + 1). '</th>';
			    		print '<td style="text-align:center">' .$data_lol[$i]['championId']. '</td>';
			    		print '<td style="text-align:center">' .$data_lol[$i]['championLevel']. '</td>';
			    		print '<td style="text-align:center">' .$data_lol[$i]['championPoints']. '</td></tr>';
					}
					print '</tbody></table>';	
				?>
			</div>
		</div>
	</div>
	
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
