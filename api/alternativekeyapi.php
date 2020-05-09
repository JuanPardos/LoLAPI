<?php
session_start();
if ($_POST['api'] != null) {
	$_SESSION['sapikey'] = $_POST['api'];
	$_SESSION['save'] = true;
}


header("location:../");  //Only is executed if calls from Form Action (Index).
