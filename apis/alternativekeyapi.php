<?php
	session_start();
	
	if($_POST['api'] != null){
		$_SESSION['sapikey'] = $_POST['api'];
	}	
	
	header("location:../index.php");  //Only is executed if calls from Form Action (Index).
?>
