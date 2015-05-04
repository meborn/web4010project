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
			<div id="matching_row" class="row">
				<div class="col-xs-6">
					<ul id="question_list" class="list-group">
						
					</ul>
				</div>
				<div class="col-xs-6">
					<ul id="answer_list" class="list-group">
						
					</ul>
				</div>
			</div>
			<div id="done_row" class="row">
				<div class="col-xs-12 text-center">
					<h1>Good Work!</h1>
					<button id="matching_start_over" class="btn btn-default">
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
<script src="/~mneborn/web4010project/js/match.js"></script>
<script>
	$(document).ready(function() {
		var questions = <?= json_encode($questions) ?>;
		
		init(questions);
		$('#matching_start_over').click(function() {
			var questions = <?= json_encode($questions) ?>;
			$('#question_list').empty();
			$('#answer_list').empty();
			init(questions);
			$('#done_row').toggle();
			$('#matching_row').toggle();
		});
	});
</script>