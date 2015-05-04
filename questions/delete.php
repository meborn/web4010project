<?php
	session_start();
	require '../includes/DB.php';
	$id = $_POST['id'];

	$db = new DB();
	$question = $db->getQuestion($id);
	$exam_id = $question['exam_id'];
	$db->deleteQuestion($id);
	$_SESSION["success"] = "Question Deleted!";
	header("Location: /~mneborn/web4010project/exams/show.php?id=$exam_id");
?>