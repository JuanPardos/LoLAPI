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
  <body class="mainMenu">
  <?php	error_reporting(0);?>  <!-- Disable PHP Debug messages -->
	  <div class="container-fluid">
      	<div class="row">
        	<div class="col-10 offset-1 min-vh-25" id="header">
        		<p class="col-10" style="text-align:left; margin-top:5px"><b>LEAGUE OF LEGENDS SEARCH</b><br> <a class="d-none d-sm-block">©Juan Pardos Zarate</a></p> 
        		<form action="altapikey.php" class="d-none d-md-block d-lg-block d-xl-block" method="post">
        			<p style="text-align:right; margin-top:-50px">
        				<input type="text" name="api" id="api" value="" data-toggle="tooltip" data-placement="bottom" title="Set an alternative API KEY if default expired" placeholder="Alternative API KEY" onmouseover="this.tooltip()">
        				<input type="submit" value="Save">
        			</p>
        		</form>
        	</div>
      	</div>
	  	<div class="row">
	  		<div class="col-8 offset-1" id="search">
	  			<div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Summoner Lookup
				        </button>
				      </h2>
				    </div>
				    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				      	<div class="card-body">
				      		<form name="form" action="summoner.php" method="get" style="text-align:center">
				      			<img src="https://image.flaticon.com/icons/png/512/130/130188.png" id="starimg" onclick="changeImg()" data-toggle="tooltip" data-placement="bottom" title="Mark as favorite" width="22px" height="22px" style="margin-bottom:7px">
				      			<input type="text" name="summoner" id="summoner" value="" placeholder="Summoner name">
				      			<select name="server" id="server">
				      				<option value="euw1">EUW</option>
				      				<option value="na1">NA</option>
				      				<option value="la1">LAN</option>
				      				<option value="oc1">OCE</option>
				      			</select>
				      			<input type="submit" value="Search">
				      		</form>
				    	</div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingTwo">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          Free champion rotation
				        </button>
				      </h2>
				    </div>
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				      <div class="card-body">
				      	<table>
				      		<tr>
				      		
				      	<?php

							require_once 'apikey.php'; 
							include ("altapikey");

							$requestFreeChamp = fopen("https://euw1.api.riotgames.com/lol/platform/v3/champion-rotations?api_key=$apikey", "r");			
							$json_freeChamps = stream_get_contents($requestFreeChamp); 
							$data_freeChamps = json_decode($json_freeChamps, true);

							$champs = fopen("champions.json", "r");
							$json_champ = stream_get_contents($champs);
							$data_champ = json_decode($json_champ, true);
							
							fclose($champs);
							fclose($requestFreeChamp);

							$array = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'name'));  
						
							for($i = 0; $i < count($data_freeChamps['freeChampionIds']); ++$i) {
								print '<td style="text-align:center"><img src="http://ddragon.leagueoflegends.com/cdn/10.1.1/img/champion/'.$array[$data_freeChamps['freeChampionIds'][$i]].'.png" width="56" height="56"></td>';
							}
							
						?>
							</tr>
						</table>
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingThree">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Server Status
				        </button>
				      </h2>
				    </div>
				    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				      <div class="card-body">
				      	NOT IMPLEMENTED YET
				      </div>
				    </div>
				  </div>
				</div>			
			</div>
        <div class="col-2 offset-1 mt-4 w-25" id="fav" style="text-align:center">
	        <a>---FAVORITES---</a><br>
	        NOT IMPLEMENTED YET
        </div>
      </div>   
      <div class="col-10 offset-1" id="footer">
    	<span>JLAJDSLKAJ</span>
      </div>
    </div>
    

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>