<?php
	session_start();
	$postApi = $_POST['api'];				//Used to set alternative API Key, if default expired.
	$_SESSION['sapikey'] = $postApi;
	header("location:index.php");
?>