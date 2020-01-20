<?php
	session_start();
	$postApi = $_POST['api'];				//Used to set alternative API Key, if default expired.
	$_SESSION['sapikey'] = $postApi;
	
	if($_SESSION['sapikey'] != $apikey && $_SESSION['sapikey'] != null){
		$apikey = $_SESSION['sapikey'];
	}
	
	header("location:../index.php");  //Only is executed if calls from Form Action (Index).
?>
