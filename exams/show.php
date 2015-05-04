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
				<div class="col-xs-12">
					<a href=<?= $class_url ?> class="class_name_link" ><h1 class="inline_header"><?= $class['name'] ?></h1></a>
					<h3 class="blue_text inline_header"><?= $exam['name'] ?></h3>
					<a href=<?= $new_question_url ?> class="right_link btn btn-default" >New Question</a>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<?php if(count($questions) > 5): ?>
					<div class="col-xs-12 col-md-4">
						<a href=<?= $flash_cards_url ?>>
							<div class="game">
								<span class="blue_text">Flash Cards</span>
							</div>
						</a>
					</div>
					<div class="col-xs-12 col-md-4">
						<a href=<?= $multi_choice_url ?>>
							<div class="game">
								<span class="blue_text">Multiple Choice</span>
							</div>
						</a>
					</div>
					<div class="col-xs-12 col-md-4">
						<a href=<?= $matching_url ?>>
							<div class="game">
								<span class="blue_text">Matching</span>
							</div>
						</a>
					</div>
				<?php else: ?>
					<div class="col-xs-12">
						<h3 class="blue_text">Add more questions to play studying games.</h3>
					</div>
				<?php endif ?>   
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<?php if(count($questions) == 0): ?>
						<p>No questions yet.</p>
					<?php else: ?>
						<table class="table">
							<thead>
								<tr>
									<th class="text-center">Question</th>
									<th class="text-center">Answer</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($questions as $q): ?>
									<?php
										$question_id = $q['id'];
										$edit_question_url = "/~mneborn/web4010project/questions/edit.php?id=$question_id";
									?>
									<tr>
										<td><?= $q['question'] ?></td>
										<td><?= $q['answer'] ?></td>
										<td>
											<a href=<?= $edit_question_url ?> class="btn btn-default">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
										</td>
										<td>
											<form method="post" action="/~mneborn/web4010project/questions/delete.php">
												<input type="hidden" name="id" value=<?= $question_id ?>>
												<button type="submit" class="btn btn-default">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</button>
											</form>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					<?php endif ?>
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
<?php
	unset($_SESSION['success']);
?>