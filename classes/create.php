<?php
	session_start();
	require '../includes/DB.php';

	$db = new DB();
	if($_POST['name']) {
		$class = array("name"=>$_POST['name']);
		$db->createClass($class);
	}
	else{
		$_SESSION['error'] = "Error: Class needs a name!";
		header("Location: new.php");
	}
?>