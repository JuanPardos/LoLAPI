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
  <body class="mainMenu">
  <?php	error_reporting(0);?>  <!-- Disable PHP Debug messages -->
	  <div class="container-fluid">
      	<div class="row">
        	<div class="col-10 offset-1 min-vh-25" id="header">
        		<p class="col-10" style="text-align:left; margin-top:5px"><b>LEAGUE OF LEGENDS API SEARCH</b><br> <a class="d-none d-sm-block" style="font-style:italic">©Juan Pardos Zarate</a></p> 
        		<form action="apis/alternativekeyapi.php" class="d-none d-md-block d-lg-block d-xl-block order-sm-12" method="post">
        			<p style="text-align:right; margin-top:-50px">
        				<input type="text" name="api" id="api" value="" title="Set an alternative API KEY if default expired" placeholder="Alternative API KEY" onmouseover="this.tooltip()">
        				<input type="submit" value="Save">
        			</p>
        		</form>
        	</div>
      	</div>
	  	<div class="row">
	  		<div class="col-8 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-2 offset-2" id="search">
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
				      			<img src="https://icons-for-free.com/iconfiles/png/512/mark+opinion+rating+star+icon-1320191205647153700.png" id="starimg" onclick="changeImg()" title="Mark as favorite" width="22px" height="22px" style="margin-bottom:7px">
				      			<input class="col-md-auto" type="text" name="summoner" id="summoner" value="" placeholder="Summoner name">
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
				      	<div class="table-responsive">
					      	<table class="table table-borderless table-sm">
					      		<tbody>
					      			<tr>
					      				<th scope="row">
									      	<?php
												require_once 'key.php'; 
												require_once 'apis/freechampapi.php';
												require_once 'apis/champapi.php';
												include ("apis/alternativekeyapi");
												
												$array = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'icon'));
												$arrayNames = array_combine(array_column($data_champ, 'key'), array_column($data_champ, 'name'));
											
												for($i = 0; $i < count($data_freeChamps['freeChampionIds']); ++$i) {
													print '<td style="text-align:center"><img src="'.$array[$data_freeChamps['freeChampionIds'][$i]].'" width="48" height="48" title="'.$arrayNames[$data_freeChamps['freeChampionIds'][$i]].'"></td>';
												}
											?>
										</th>
									</tr>
									<tr>
										<th scope="row">
											<?php
												for($i = 0; $i < count($data_freeChamps['freeChampionIds']); ++$i) {
													print '<td style="text-align:center"><a style="font-size: 13px">'.$arrayNames[$data_freeChamps['freeChampionIds'][$i]].'</td>';
												}
											?>
										</th>
									</tr>
								</tbody>
							</table>
						</div>
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
				      	<div class="table-responsive">
					      	<table class="table table-borderless table-sm">
					      		<tr> 
						      		<?php
						      			require_once 'key.php'; 
										require_once 'apis/statusapi.php';
										include ("apis/alternativekeyapi");
											
										//YEP, I KNOW I CAN DO THIS ONE BETTER								
										
						      			$online1 = array_column($data_status1['services'], 'status')['0'];  	//Online/offline
						      			$incidents1 = array_column($data_status1['services'], 'incidents')['0']; 	//Incidents
						      			$online2 = array_column($data_status2['services'], 'status')['0'];  	
						      			$incidents2 = array_column($data_status2['services'], 'incidents')['0'];
						      			$online3 = array_column($data_status3['services'], 'status')['0'];  	
						      			$incidents3 = array_column($data_status3['services'], 'incidents')['0'];
						      			$online4 = array_column($data_status4['services'], 'status')['0'];  
						      			$incidents4 = array_column($data_status4['services'], 'incidents')['0'];
										
										$auxon = array($online1, $online2, $online3, $online4);
										$auxst = array($incidents1, $incidents2, $incidents3, $incidents4);
										
						      			for($i = 0; $i < count($auxon); ++$i){
							      		  	if($auxon[$i] == 'online'){
							      		  		if($auxst[$i] == null){
							      		  			print'<td>'.$serverNames[$i].': PERFECT'.$perfect.'</td>';
							      		  		}else
							      		  			print'<td>'.$serverNames[$i].': OK'.$ok.'</td>';
							      		  	}else
							      		  		print'<td>'.$serverNames[$i].': OFFLINE'.$offline.'</td>';
										}	 
										 	  					      				
						      		?>
					      		</tr>
					      	</table>
						</div>
				  </div>
				</div>			
			</div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6 offset-xl-0 offset-lg-0 offset-md-0 offset-sm-4 offset-3 mt-4 d-none d-sm-block d-md-block d-lg-block d-xl-block d-inline-block" id="fav" onmouseover="fadeInFav()" onmouseout="fadeOutFav()" style="text-align:center; visibility:hidden">
	        <a>---FAVORITES---</a><br>
	        NOT IMPLEMENTED YET
        </div>
      </div>   
    </div>
    <div class="col-10 offset-1 fixed-bottom d-none d-sm-block" id="footer">
    	<span class="d-none d-sm-none d-md-block d-lg-block d-xl-block" style="color:black">
    		This Website isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games
			or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are
			trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
		</span>
		<span class="d-block d-sm-block d-md-none d-lg-none d-xl-none" style="color:black; font-size:10px">
    		This Website isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games
			or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are
			trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
		</span>
      </div>
    
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>