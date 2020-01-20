<?php
	session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap and CSS -->
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
  			<div class="col-6">    		<!-- TODO: Player Ranked, Match History -->
			    <?php
			    	require_once 'key.php';  			//Get the API Key from a .gitignored file (Hide from public).
			    	require_once 'summonerapi.php';
			    	require_once 'champapi.php';
			    	include ("alternativekeyapi");
			    	
			    	if($_SESSION['sapikey'] != $apikey && $_SESSION['sapikey'] != null){
						$apikey = $_SESSION['sapikey'];
					}
			    	
					$array = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'name'));  //Used to get ID => Name of champ

					if($data_lol == null){
						print '
							<script type="text/javascript">
								alert("Invalid summoner name or API Key");
							</script>
						';
					}
					
					print'<h1>Champion mastery of '.$summoner.'</h1>';			
						
					print 
					'
						<table class="table" id="masteryTable" style="border: 1px solid black">
							<thead class="thead-dark">
		    					<tr>
		      						<th scope="col" style="text-align:center">#</th>
		     						<th scope="col" style="text-align:center">Champion</th>
		      						<th scope="col" style="text-align:center">Mastery Level</th>
		      						<th scope="col" style="text-align:center">Mastery Points</th>
		    					</tr>
	  						</thead>
	  						<tbody>
  					';	
  						
					for($i = 0; $i < count($data_lol); ++$i) {
						print '<tr><th scope="row" style="text-align:center">' .($i + 1). '</th>';
			    		print '<td style="text-align:center">' .$array[$data_lol[$i]["championId"]]. '</td>';
			    		print '<td style="text-align:center">' .$data_lol[$i]['championLevel']. '</td>';
			    		print '<td style="text-align:center">' .$data_lol[$i]['championPoints']. '</td></tr>';
					}
					print '</tbody></table><br><a href="index.php">Return to main menu</a>';	
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
