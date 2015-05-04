<?php
	session_start();
	
	require '../includes/DB.php';

	$id = $_GET['id'];
	$db = new DB();
	$exam = $db->getExam($id);

	$class_id = $exam['class_id'];
	$class = $db->getClass($class_id);
	$class_url = "/~mneborn/web4010project/classes/show.php?id=$class_id";
	$exam_id = $exam['id'];
	$new_question_url = "/~mneborn/web4010project/questions/new.php?exam_id=$exam_id";

	$flash_cards_url = "/~mneborn/web4010project/games/flash-cards.php?id=$exam_id";
	$multi_choice_url = "/~mneborn/web4010project/games/multi-choice.php?id=$exam_id";
	$matching_url = "/~mneborn/web4010project/games/matching.php?id=$exam_id";
	$questions = $db->getQuestions($exam_id);

	require '../header.php';
	require '../nav.php';
?>

<body>
	<section id="show_exam_section_1">
		<div class="container">
			<!-- display success -->
			<?php if($_SESSION['success']):?>
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-success">
							<?= $_SESSION['success'] ?>
						</div>
					</div>
				</div>
			<?php endif ?>
			<!-- display success -->
			<div class="row">
				<div class="col-xs-12 col-md-10">
					<a href=<?= $class_url ?> ><?= $class['name'] ?></a>
				</div>
				<div class="col-xs-12 col-md-10">
					<p><?= $exam['name'] ?></p>
					<a href=<?= $new_question_url ?> >New Question</a>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<a href=<?= $flash_cards_url ?>>
						<div class="game">
							<h1>Flash Cards</h1>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-md-4">
					<a href=<?= $multi_choice_url ?>>
						<div class="game">
							<h1>Multiple Choice</h1>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-md-4">
					<a href=<?= $matching_url ?>>
						<div class="game">
							<h1>Matching</h1>
						</div>
					</a>
				</div>   
			</div>
		</div>
	</section>
	<!-- <section>
		<div class="container">
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
	</section> -->
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
<?php
	unset($_SESSION['success']);
?>