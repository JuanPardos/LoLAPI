<?php
ob_start("ob_gzhandler");
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icon.png" type="image/ico">
	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/iziToast.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<!-- JS -->
	<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
	<script src="js/iziToast.min.js" type="text/javascript"></script>
	<script>
		$(function() {
			$("[rel='tooltip']").tooltip(); //Enables tooltips
		});
	</script>
	<title>LOL API</title>
</head>

<body class="mainMenu">
	<?php error_reporting(0); ?>
	<!-- Disable PHP Debug messages -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-10 col-lg-10 col-xl-10 offset-md-1 offset-lg-1 offset-xl-1 min-vh-25" id="header">
				<img class="offset-sm-11 offset-11 mt-2 mr-sm-2 mr-3 d-block d-sm-block d-md-none d-lg-none d-xl-none" src="resources/menuicon.png" id="menubutton" data-toggle="modal" data-target="#modalApi" rel="tooltip" title="Api Key Menu">
				<p class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 mt-xl-2 mt-lg-2 mt-md-2" style="text-align:left; margin-top:-50px; position:absolute"><b>LEAGUE OF LEGENDS API SEARCH</b><br> <a class="d-none d-sm-block" style="font-style:italic">©Juan Pardos Zarate</a></p>
				<form action="api/alternativekeyapi.php" class=" mt-xl-3 mt-lg-3 mt-md-3 d-none d-md-block d-lg-block d-xl-block order-sm-12" method="post" style="text-align:right; margin-top:-50px">
					<img src="resources/help.png" id="helpbutton" data-toggle="modal" data-target="#exampleModalLong" rel="tooltip" width="30px" height="30px" title="Open API Key help">
					<input type="text" name="api" id="api" value="" placeholder="API KEY">
					<input type="submit" value="Save">
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-10 col-md-8 col-lg-8 col-xl-8 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-1" id="search">
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
									<input class="col-md-auto" type="text" name="summoner" id="summoner" value="" placeholder="Summoner name">
									<select name="server" id="server">
										<option value="euw1">EUW</option>
										<option value="na1">NA</option>
										<option value="la1">LAN</option>
										<option value="oc1">OCE</option>
										<option value="kr">KR</option>
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
													include_once 'key.php';
													if ($apikey != $_SESSION['sapikey'] && $_SESSION['sapikey'] != null) {
														$apikey = $_SESSION['sapikey'];
													}
													require_once 'api/freechampapi.php';
													require_once 'api/champapi.php';

													$subject = $_POST['subject'];
													$email = $_POST['email'];
													$message = $_POST['message'];
													$header = 'From: ' . $email . '';

													if ($message != null && $subject != null && $email != null) {
														print '
															<script type="text/javascript">
																iziToast.success({
																    title: "Success",
																    message: "Successfully sent email",
																    timeout: 3000,
																    position: "topCenter",
																});
															</script>
														';
														mail($personalMail, $subject, $message, $header); //Sends email. Might not work without key.php.
													}

													if ($_SESSION['save'] == true) {
														print '
															<script type="text/javascript">
																iziToast.success({
																    title: "Success",
																    message: "API Key added/updated",
																    timeout: 3000,
																    position: "topCenter",
																});
															</script>
														';
													}

													$_SESSION['save'] = false;

													if ($data_freeChamps == null) {
														print '
														<div class="col-8 offset-2" style="background-color:red; text-align:center"><a>API ERROR</a></div>
													';
													}
													for ($i = 0; $i < count($data_freeChamps['freeChampionIds']); ++$i) {
														print '<td style="text-align:center"><a href="https://na.leagueoflegends.com/en-us/champions/' . $arrayID[$data_freeChamps['freeChampionIds'][$i]] . '/"><img src="resources/champion_icons/' . ucfirst($arrayID[$data_freeChamps['freeChampionIds'][$i]]) . '.png" width="48" height="48" rel="tooltip" title="View champion info"></a></td>';
													}
													?>
												</th>
											</tr>
											<tr>
												<th scope="row">
													<?php
													for ($i = 0; $i < count($data_freeChamps['freeChampionIds']); ++$i) {
														print '<td style="text-align:center"><a style="font-size: 13px">' . $array[$data_freeChamps['freeChampionIds'][$i]] . '</td>';
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
											include_once 'key.php';
											if ($apikey != $_SESSION['sapikey'] && $_SESSION['sapikey'] != null) {
												$apikey = $_SESSION['sapikey'];
											}
											require_once 'api/statusapi.php';

											if ($auxon['1'] == null) {
												print '
												<div class="col-8 offset-2" style="background-color:red; text-align:center"><a><b>API ERROR</b></a></div>
											';
											} else {
												for ($i = 0; $i < count($auxon); ++$i) {
													if ($auxon[$i] == 'online') {
														if ($auxst[$i] == null) {
															print '<td>' . $serverNames[$i] . ': PERFECT' . $perfect . '</td>';
														} else
															print '<td>' . $serverNames[$i] . ': OK' . $ok . '</td>';
													} else
														print '<td>' . $serverNames[$i] . ': OFFLINE' . $offline . '</td>';
												}
											}

											?>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mt-xl-2 mt-lg-2 mt-md-2 mt-sm-2 mt-4 offset-xl-0 offset-lg-0 offset-md-0 offset-sm-3 offset-3" id="fav">
				<a><b>FAVORITES</b>
					<hr></a>
				<div id="favs">
					<?php
					session_start();
					include_once 'key.php';

					if ($apikey != $_SESSION['sapikey'] && $_SESSION['sapikey'] != null) {
						$apikey = $_SESSION['sapikey'];
					}

					if (in_array($_SESSION['Summoner'], $_SESSION['favs']) == false) {   //Checks if summoner name already exist, if not add it.
						array_push($_SESSION['favs'], $_SESSION['Summoner']);
						array_push($_SESSION['ArrayServers'], $_SESSION['Server']);
					}

					for ($i = 0; $i < count($_SESSION['favs']); ++$i) {
						print '
							<a href="/summoner.php?summoner=' . $_SESSION["favs"][$i] . '&server=' . $_SESSION["ArrayServers"][$i] . '">' . rawurldecode($_SESSION['favs'][$i]) . ' </a><br>
						';
					}

					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-10 offset-1 fixed-bottom d-none d-sm-block" id="footer">
		<span class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
			This Website isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games
			or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are
			trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
		</span>
		<span class="d-block d-sm-block d-md-none d-lg-none d-xl-none" style="font-size:10px">
			This Website isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games
			or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are
			trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
		</span>
	</div>
</body>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:gold">
				<h5 class="modal-title" id="exampleModalLongTitle">API KEY Help</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				If you are not the developer you may need a new API Key.<br>
				In order to get a new one visit <a href="https://developer.riotgames.com/" target="_blank">https://developer.riotgames.com/</a> and sign in with your Riot Account.<br>
				The key is stored throughout the session.
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalApi" tabindex="-1" role="dialog" aria-labelledby="modalApiTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:gold">
				<h5 class="modal-title" id="modalApiTitle">API KEY Help</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				If you are not the developer you may need a new API Key.<br>
				In order to get a new one visit <a href="https://developer.riotgames.com/" target="_blank">https://developer.riotgames.com/</a> and sign in with your Riot Account.<br>
				The key is stored throughout the session.<br><br>
				<form action="api/alternativekeyapi.php" method="post" style="text-align:center">
					<input type="text" name="api" id="apimobile" value="" placeholder="API KEY">
					<input type="submit" value="Save">
				</form>
			</div>
		</div>
	</div>
</div>
<div class="d-none d-xl-block" id="supportButton">
	<button class="support" data-toggle="modal" data-target="#supportModal">Support</button>
</div>
<div class="modal fade" id="supportModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="modalApiTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#0099CC">
				<h5 class="modal-title" id="modalApiTitle">Email Support</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Ask for help or give Feedback<br><br>
				<form action="" method="post">
					<input type="email" name="email" id="email" value="" required placeholder="Your email"><br>
					<input type="text" name="subject" id="subject" value="" required placeholder="Subject"><br>
					<textarea name="message" id="message" rows="4" cols="45" required placeholder="Write a message..."></textarea><br><br>
					<input type="submit" value="Send">
				</form>
			</div>
		</div>
	</div>
</div>

</html>
<?php
ob_end_flush();
?>