<?php
	session_start();
	require '../includes/DB.php';
	
	$id = $_GET['id'];
	$db = new DB();
	$question = $db->getQuestion($id);
	$q = $question['question'];
	$a = $question['answer'];

	require '../header.php';

	require '../nav.php';
?>
<body>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<form method="post" action="/~mneborn/web4010project/questions/update.php">
						<div class="form-group">
							<label for="question">Question</label>
							<input type="hidden" name="exam_id" value=<?= $question['exam_id'] ?> >
							<input type="hidden" name="id" value=<?= $question['id'] ?> >
							<textarea id="question_input" name="question" rows="5" class="form-control"><?= $q ?></textarea>
						</div>
						<div class="form-group">
							<label for="answer">Answer</label>
							<textarea id="answer_input" name="answer" rows="5" class="form-control"><?= $a ?></textarea>
						</div>
						
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>
<?php
	require '../footer.php';
?>

<?php
	unset($_SESSION['error']);
?>
</html>