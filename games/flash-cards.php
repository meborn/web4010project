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
					<div id="card">
						<div class="front">
							<h3>Front</h3>
						</div>
						<div class="back">
							<h3>Back</h3>
						</div>
					</div>
					
					<div class="btn_container">
						<button id="correct" class="btn btn-default">
							I got it <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
						</button>
						<button id="incorrect" class="btn btn-default">
							Try again <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
						</button>
					</div>
					<button id="show_answer" class="btn btn-default">Show Answer</button>
					<button id="start_over" class="btn btn-default">Start Over</button>
				</div>
			</div>
		</div>
	</section>
</body>

<?php
	require '../footer.php';
?>
<script src="/~mneborn/web4010project/js/flash-cards.js"></script>
<script src="/~mneborn/web4010project/js/flip.js"></script>
<script>
	$(document).ready(function() {
		$('#card').flip({
			trigger: 'manual'
		});
		var questions = <?= json_encode($questions) ?>;
		init(questions);
		$("#show_answer").click(function() {
			var c = cards[card_index];
			showAnswer(c);
		});
		$("#correct").click(function() {
			hideAnswer();
			correctCard();
		});
		$("#incorrect").click(function() {
			hideAnswer();
			incorrectCard();
		});
		$("#start_over").click(function() {
			init(questions);
			getProgress();
			$("#start_over").toggle();
			$("#show_answer").toggle();
		});
	});
</script>