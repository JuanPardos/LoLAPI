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
        		<p style="text-align:left; margin-top:5px"><b>LEAGUE OF LEGENDS SEARCH</b><br> ©Juan Pardos Zarate</p> 
        		<p style="text-align:right; margin-top:-40px"><a href="" style="color:red">Login</a></p>
        	</div>
      	</div>
	  	<div class="row">
	  		<div class="col-8 offset-1" id="search">
	  			<div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Champion Mastery
				        </button>
				      </h2>
				    </div>
				    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				      	<div class="card-body">
				      		<form name="form" action="mastery.php" method="get" style="text-align:center">
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
				          Player ELO
				        </button>
				      </h2>
				    </div>
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				      <div class="card-body">
				      	NOT IMPLEMENTED YET
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingThree">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Match History
				        </button>
				      </h2>
				    </div>
				    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				      <div class="card-body">
				      	NOT IMPLEMENTED YET
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingFour">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				          Free champion rotation
				        </button>
				      </h2>
				    </div>
				    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
				      <div class="card-body">
				      	NOT IMPLEMENTED YET
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingFive">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
				          Server Status
				        </button>
				      </h2>
				    </div>
				    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
				      <div class="card-body">
				      	NOT IMPLEMENTED YET
				      </div>
				    </div>
				  </div>
				</div>			
			</div>
        <div class="col-2 offset-1 mt-4" id="fav">
          <p>FAV MENU<br> NOT IMPLEMENTED YET</p>
        </div>
      </div>   
    </div>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>