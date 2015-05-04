<?php
	session_start();
	require '../includes/DB.php';
	$name = $_POST['name'];
	$class_id = $_POST['class_id'];

	$db = new DB();
	if($name && $class_id) {
		$exam = array("class_id"=>$class_id,"name"=>$name);
		$db->createExam($exam);
	}
	elseif(!$name) {
		$_SESSION['error'] = "Error: Exam needs a name!";
		header("Location: new.php?class_id=$class_id");
	}
	else{
		$_SESSION['error'] = "Error!";
		header("Location: ../classes/index.php");
	}
?>