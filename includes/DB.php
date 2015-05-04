<?php
session_start();

class DB {

	private $connection;

	function __construct() {
		//set up database connection
		$this->connection = new PDO("mysql:host=127.0.0.1;dbname=web4010", "root", "");
	}

	function getClasses() {
		//get all classes
		$sql = "SELECT * FROM classes";
		$stmt = $this->connection->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getClass($id) {
		//get class
		$sql = "SELECT * FROM classes WHERE id = :id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function createClass($class) {
		//create class
		$sql = "INSERT INTO classes (name) VALUES (:name)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('name', $class['name']);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count == 1) {
			$_SESSION['success'] = "New class created!";
			$lastId = $this->connection->lastInsertId();
			
			header("Location: show.php?id=$lastId");
		}
		else {
			$_SESSION['error'] = "Error!";
			header("Location: new.php");
		}
	}

	function getExams($class_id) {
		//get all exams
		$sql = "SELECT * FROM exams WHERE class_id = :class_id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('class_id', $class_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getExam($id) {
		//get exam
		$sql = "SELECT * FROM exams WHERE id = :id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function createExam($exam) {
		//create exam
		$sql = "INSERT INTO exams (class_id, name) VALUES (:class_id, :name)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('class_id', $exam['class_id']);
		$stmt->bindParam('name', $exam['name']);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count == 1) {
			$_SESSION['success'] = "New Exam created!";
			$lastId = $this->connection->lastInsertId();
			header("Location: show.php?id=$lastId");
		}
		else {
			$class_id = $exam['class_id'];
			$_SESSION['error'] = "Error!";
			header("Location: new.php?class_id=$class_id");
		}
	}

	function getQuestions($exam_id) {
		//get questions
		$sql = "SELECT * FROM questions WHERE exam_id = :exam_id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('exam_id', $exam_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function createQuestion($question) {
		//create question
		$sql = "INSERT INTO questions (exam_id, question, answer) VALUES (:exam_id, :question, :answer)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam('exam_id', $question['exam_id']);
		$stmt->bindParam('question', $question['question']);
		$stmt->bindParam('answer', $question['answer']);
		$stmt->execute();

		$count = $stmt->rowCount();
		$exam_id = $question['exam_id'];
		if($count == 1) {
			$_SESSION['success'] = "New Question Created!";
			$lastId = $this->connection->lastInsertId();
			header("Location: ../exams/show.php?id=$exam_id");
		}
		else {
			
			$_SESSION['error'] = "Error!";
			header("Location: new.php?exam_id=$exam_id");
		}
	}

}

?>