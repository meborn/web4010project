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
				<div class="col-xs-6">
					<ul class="list-group">
						<li class="list-group-item">
							<p>Question 1</p>
							<div class="answer_slot">

							</div>
						</li>
						<li class="list-group-item">
							<p>Question 2</p>
							<div class="answer_slot">

							</div>
						</li>
						<li class="list-group-item">
							<p>Question 3</p>
							<div class="answer_slot">

							</div>
						</li>
					</ul>
				</div>
				<div class="col-xs-6">
					<ul class="list-group">
						<li class="list-group-item">
							<div class="answer">
								Answer 1
							</div>
						</li>
						<li class="list-group-item">
							<div class="answer">
								Answer 2
							</div>
						</li>
						<li class="list-group-item">
							<div class="answer">
								Answer 3
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</body>

<?php
	require '../footer.php';
?>
<script>
	$(document).ready(function() {
		var handleCardDrop = function(event, ui) {
			ui.draggable.draggable('disable');
			$(this).droppable('disable');
			ui.draggable.draggable('option', 'revert', false);
		}
		$('.answer').draggable({
			revert: true
		});
		$('.answer_slot').droppable({
			accept: ".answer",
			drop: handleCardDrop
		});
	});
</script>