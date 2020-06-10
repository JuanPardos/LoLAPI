<?php
session_start();
if ($_POST['api'] != null) {
	$_SESSION['sapikey'] = $_POST['api'];  //Stores the user input api key in session variable.
	$_SESSION['save'] = true;  
}


header("location:../");  //Redirect to index.
