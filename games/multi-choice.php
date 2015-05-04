<?php
	session_start();
	
	require '../includes/DB.php';

	$id = $_GET['id'];
	$db = new DB();
	$exam = $db->getExam($id);

	$exam_id = $exam['id'];

	$back_url = "/~mneborn/web4010project/exams/show.php?id=$exam_id";

	$questions = $db->getQuestions($exam_id);

	require '../header.php';
	require '../nav.php';
?>
<body>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<a href=<?= $back_url ?> class="btn btn-default">
						<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Back
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 text-center">
					<p>Progress <span id="progress_fraction"></span></p>
					<div id="progress_bar">
						<div id="progress">

						</div>
					</div>
				</div>
			</div>
			<div id="questions_row" class="row">
				<div class="col-xs-12 text-center">
					<h4 id="question"></h4>
					<form>
						<div class="radio">
							<label>
								<input type="radio" name="answer" id="input_0">
								<p id="choice_0">Answer</p>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="answer" id="input_1">
								<p id="choice_1">Answer</p>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="answer" id="input_2">
								<p id="choice_2">Answer</p>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="answer" id="input_3">
								<p id="choice_3">Answer</p>
							</label>
						</div>
					</form>
					<button id="check_answer" class="btn btn-default">
						Check Answer
					</button>
				</div>
			</div>
			<div id="congrats_row" class="row">
				<div class="col-xs-12 text-center">
					<h1>Nice Work!</h1>
					<button id="multi_start_over" class="btn btn-default">
						Start Over
					</button>
				</div>
			</div>
		</div>
	</section>
</body>

<?php
	require '../footer.php';
?>
<script src="/~mneborn/web4010project/js/multi-choice.js"></script>
<script>
	$(document).ready(function() {
		
		var questions = <?= json_encode($questions) ?>;
		init(questions);
		$('#check_answer').click(function() {
			var answer = $('input[name=answer]:checked').val();
			$('input[name=answer]:checked').prop('checked', false);
			console.log(answer);
			checkAnswer(answer);
		});
		$('#multi_start_over').click(function() {
			$('#questions_row').toggle();
			$('#congrats_row').toggle();
			init(questions);
		});
	});
</script>