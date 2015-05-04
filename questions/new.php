<?php
	session_start();
	require '../includes/DB.php';
	
	$exam_id = $_GET['exam_id'];
	$db = new DB();
	$exam = $db->getExam($exam_id);

	require '../header.php';

	require '../nav.php';
?>

<body>
	<section>
		<div class="container">
			<!-- display errors -->
			<?php if($_SESSION['error']): ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-danger">
							<?= $_SESSION['error'] ?>
						</div>
					</div>
				</div>
			<?php endif ?>
			<!-- display errors -->
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<form method="post" action="/~mneborn/web4010project/questions/create.php">
						<div class="form-group">
							<label for="question">Question</label>
							<input type="hidden" name="exam_id" value=<?= $exam_id ?> >
							<textarea name="question" rows="5" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="answer">Answer</label>
							<textarea name="answer" rows="5" class="form-control"></textarea>
						</div>
						
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>

</body>

<?php
	unset($_SESSION['error']);
?>