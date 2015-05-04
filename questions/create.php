<?php
	session_start();
	require '../includes/DB.php';
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$exam_id = $_POST['exam_id'];

	$db = new DB();
	if($question && $answer && $exam_id) {
		$q = array("exam_id"=>$exam_id,"question"=>$question, "answer"=>$answer);
		$db->createQuestion($q);
	}
	elseif(!$question || !$answer) {
		$_SESSION['error'] = "Error: please provide a question and answer.";
		header("Location: new.php?exam_id=$exam_id");
	}
	elseif(!$exam_id) {
		$_SESSION['error'] = "Error! No exam id!";
		header("Location: ../exams/show.php?id=$exam_id");
	}
?>